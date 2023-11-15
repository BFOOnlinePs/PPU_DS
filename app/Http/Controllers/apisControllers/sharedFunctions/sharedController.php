<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
use App\Models\Role;
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
        $credentials = $request->validate([
            'u_id' => 'required',
        ]);

        $user = User::where('u_id', $credentials['u_id'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }


    public function getFacebookLink(){
        $facebook = SystemSetting::select('ss_facebook_link')->first();

        return response()->json([
            'facebook' => $facebook->ss_facebook_link
        ]);
    }

    public function getInstagramLink(){
        $instagram = SystemSetting::select('ss_instagram_link')->first();

        return response()->json([
            'instagram' => $instagram->ss_instagram_link
        ]);
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
