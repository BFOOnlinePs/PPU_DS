<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
use App\Models\Course;
use App\Models\Major;
use App\Models\Role;
use App\Models\SemesterCourse;
use App\Models\StudentCompany;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class sharedController extends Controller
{
    // user login
    public function login(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'الرجاء التأكد من المعلومات المدخلة'
            ], 200);
        }

        $credentials = $validator->validated();

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('api-token')->plainTextToken;
            return response([
                'status' => true,
                'message' => 'تم تسجيل الدخول بنجاح',
                'user' => auth()->user(),
                'token' => $token,
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'الايميل او كلمة المرور غير صحيحة'
            ], 403);
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
            'message' => 'تم تسجيل الخروج بنجاح'
        ], 200);
    }

    public function getUserInfo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'u_id' => 'required',
        ], [
            'u_id.required' => 'الرجاء ارسال رقم المستخدم'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        };

        $user_id = $request->input('u_id');
        $user = User::where('u_id', $user_id)->first();
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
                'message' => 'لا يوجد مساقات متوفرة للفصل الحالي'
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

    // just for test
    public function test()
    {
        // $result = User::where('u_id', auth()->user()->u_id)->with('role:r_name,r_id')->get();
        // $result = Role::with('users')->get();
        // $result = StudentCompany::with('users')->get();
        // $result = User::where('u_id', auth()->user()->u_id)->with('studentCompanies')->get();
        // $result = StudentCompany::where('sc_student_id', auth()->user()->u_id)->with('companyBranch')->get();
        // $result = CompanyBranch::with('studentCompanies')->get();
        // $result = Company::with('companyBranch')->get();
        // $result = CompanyBranch::with('companies')->get();
        // $result = CompanyBranch::where('b_company_id', 1)->with('companies')->get();
        // $result = CompanyBranch::where('b_id', 1)->with('companyBranchLocation')->get();
        // $result = CompanyBranchLocation::with('companyBranch')->get();


        $result = User::with('role')->get();

        $transformedResult = $result->map(function ($user) {
            return [
                'aseel' => $user->u_id,
                'userName' => $user->name,
                'roleInfo' => [
                    'roleId' => $user->role->r_id,
                    'roleName' => $user->role->r_name,
                ],
            ];
        });

        return response()->json([
            'result' => $transformedResult
        ]);
    }
}
