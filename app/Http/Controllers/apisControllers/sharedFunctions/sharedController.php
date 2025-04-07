<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Course;
use App\Models\GizEvaluationModel;
use App\Models\Major;
use App\Models\SemesterCourse;
use App\Models\SystemSetting;
use App\Models\User;
use App\Services\MessageService;
use App\Services\NotificationsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class sharedController extends Controller
{
    protected $messageService;
    protected $notificationsService;


    public function __construct(MessageService $messageService, NotificationsService $notificationsService)
    {
        $this->messageService = $messageService;
        $this->notificationsService = $notificationsService;
    }

    // used for testing purposes (when deploying)
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => trans('messages.login_error_message'),
            ], 200);
        }

        // is testing in SystemSetting model
        $system_settings = SystemSetting::first();
        if ($system_settings->ss_is_testing == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Testing is disabled',
            ]);
        }

        $credentials = $validator->validated();

        if (Auth::attempt($credentials)) {

            $role_id = $request->user()->u_role_id;
            $exists = SystemSetting::whereJsonContains('ss_mobile_active_users', (string)$role_id)->exists();
            if ($exists) {
                $token = $request->user()->createToken('api-token')->plainTextToken;
                return response([
                    'status' => true,
                    'message' => trans('messages.login_successfully'),
                    'user' => auth()->user(),
                    'token' => $token,
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => trans('messages.login_no_actor'),
                ]);
            }
        } else {
            return response([
                'status' => false,
                'message' => trans('messages.login_error_message'),
            ], 403);
        }
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        };

        $otp = $request->input('otp');

        $http = new \GuzzleHttp\Client();

        try {
            $response = $http->post('https://my.ppu.edu/connect/token', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'password',
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                    'client_id' => env('MOBILE_CLIENT_ID'),
                    'client_secret' => env('MOBILE_CLIENT_SECRET'),
                    'scopes' => 'OpenId Profile role userno ExternalApis.api',
                    'auth_type' => 'sms',
                    'two_factor_code' => $otp,
                ],
            ]);

            // If the request is successful (OTP is valid)
            $data = json_decode((string) $response->getBody(), true);
            Log::info('OTP verification response: ' . json_encode($data));
            // data: access_token, expires_in, token_type, and refresh_token
            // login to the system using username

            $user = User::where('u_username', $request->input('username'))->first();

            Log::info('User: ' . json_encode($user));
            if ($user) {
                $role_id = $user->u_role_id;
                Log::info('Role ID: ' . $role_id);
                $exists = SystemSetting::whereJsonContains('ss_mobile_active_users', (string)$role_id)->exists();
                Log::info('Role exists: ' . $exists);
                if ($exists) {
                    Log::info('User exists and role is active');
                    Auth::login($user);
                    Log::info('User logged in');
                    $token = $request->user()->createToken('api-token')->plainTextToken;
                    return response([
                        'status' => true,
                        'message' => trans('messages.login_successfully'),
                        'user' => auth()->user(),
                        'token' => $token,
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => trans('messages.login_no_actor'),
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }
        } catch (ClientException $e) {
            // Handle 400 Bad Request (Invalid OTP)
            $responseBody = json_decode((string) $e->getResponse()->getBody(), true);

            return response()->json([
                'status' => false,
                'message' => $responseBody['error_description'] ?? 'Invalid OTP or other error',
            ], 400);
        } catch (RequestException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Request failed. Please try again later.',
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    // user logout
    public function logout(Request $request)
    {
        // Auth::user()->tokens->delete();
        $request->user()->currentAccessToken()->delete();
        // $user = Auth::user()->token();
        // $user->revoke();

        return response([
            'message' => trans('messages.logout_successfully'),
        ], 200);
    }

    public function getUserInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_id' => 'required',
        ], [
            'u_id.required' => trans('messages.user_id_required'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        };

        $user_id = $request->input('u_id');
        $user = User::where('u_id', $user_id)->with('userCity:id,city_name_ar,city_name_en')->first();

        if ($user->u_role_id == 2) {
            // student
            $user->major_name  = Major::where('m_id', $user->u_major_id)->pluck('m_name')->first();
        } else if ($user->u_role_id == 6) {
            // manager
            $user->company = Company::where('c_manager_id', $user_id)->first();

            // for later, when we depend on branch manager, not company manager:
            // $user->branches = CompanyBranch::where('b_manager_id', $user_id)->with('companies')->get();0
        }

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user,], 200);
    }


    public function getHomeSharedData()
    {
        $system_settings = SystemSetting::first();
        $is_giz_evaluation_active = $system_settings->ss_giz_evaluations_status == 'active' ? true : false;

        $current_user_id = auth()->user()->u_id;
        $current_user_role_id = auth()->user()->u_role_id;
        $unseen_conversations_count = $this->messageService->unseenConversationsCount($current_user_id);
        $unseen_notifications_count = $this->notificationsService->unseenNotificationsCount($current_user_id);
        if ($is_giz_evaluation_active) {
            $giz_evaluations = GizEvaluationModel::where('e_role_id', $current_user_role_id)->first();
        }

        return response()->json([
            'status' => true,
            'unseen_notifications_count' => $unseen_notifications_count,
            'unseen_conversations_count' => $unseen_conversations_count,
            'giz_evaluations_link' => $giz_evaluations ? $giz_evaluations->e_link : null
        ]);
    }


    public function getFacebookLink()
    {
        $facebook = SystemSetting::select('ss_facebook_link')->first();

        return response()->json([
            'facebook' => $facebook->ss_facebook_link
        ]);
    }

    public function getInstagramLink()
    {
        $instagram = SystemSetting::select('ss_instagram_link')->first();

        return response()->json([
            'instagram' => $instagram->ss_instagram_link
        ]);
    }

    // available courses depend on semester and year
    public function availableCourses()
    {
        $system_settings = SystemSetting::first();

        $current_year = $system_settings->ss_year;
        $current_semester = $system_settings->ss_semester_type;

        $semester_courses_id = SemesterCourse::where('sc_semester', $current_semester)
            ->where('sc_year', $current_year)
            ->pluck('sc_course_id');

        $available_courses = Course::whereIn('c_id', $semester_courses_id)->get();

        if ($available_courses->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => trans('messages.no_trainings_this_semester'),
            ]);
        }

        return response()->json([
            'status' => true,
            'available_courses' => $available_courses
        ]);
    }

    public function fileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $folderPath = 'student_reports';
            // $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $request->file('file')->storeAs($folderPath, $fileName, 'public');

            return response()->json([
                'file' => $fileName
            ], 200);
        }
    }
}
