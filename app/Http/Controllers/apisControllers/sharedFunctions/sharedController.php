<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
use App\Models\Role;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class sharedController extends Controller
{
    // user login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response([
                'status' => false,
                'message' => 'الرجاء التأكد من المعلومات المدخلة'
            ], 403);
        }

        $token = $request->user()->createToken('api-token')->plainTextToken;

        // Save the token in the remember_token column
        // $request->user()->update(['remember_token' => $token]);

        return response([
            'status' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => auth()->user(),
            'token' => $token,
        ], 200);
    }

    // user logout
    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function (PersonalAccessToken $token) {
            $token->delete();
        });

        return response([
            'message' => 'Logout success'
        ], 200);
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
