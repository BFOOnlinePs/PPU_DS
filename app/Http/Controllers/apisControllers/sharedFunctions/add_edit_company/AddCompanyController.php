<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\add_edit_company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddCompanyController extends Controller
{
    public function createManagerAndHisCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|unique:companies,c_name',
            'manager_name' => 'required',
            'manager_email' => 'required|email|unique:users,email',
            'manager_password' => 'required',
            'phone' => 'required', // main branch phone + manager phone
            // 'phone' => ['required', 'regex:/^[0-9]{10}$/'], // main branch phone + manager phone
            'address' => 'required', // main branch phone + manager phone
        ], [
            'company_name.required' => 'الرجاء ارسال اسم الشركة',
            'company_name.unique' => 'يوجد شركة بنفس الاسم الذي قمت بادخاله',
            'manager_name.required' => 'الرجاء ارسال اسم مدير الشركة',
            'manager_email.required' => 'الرجاء ارسال ايميل مدير الشركة',
            'manager_email.email' => 'يجب ان تكون صيغة البريد الإلكتروني صحيحة',
            'manager_email.unique' => 'البريد الإلكتروني موجود بالفعل',
            'manager_password.required' => 'الرجاء ارسال كلمة سر حساب مدير الشركة',
            'phone.required' => 'الرجاء ارسال رقم هاتف الشركة',
            // 'phone.regex' => 'صيغة الهاتف غير صحيحة، ويحب ان يتكون من 10 ارقام',
            'address.required' => 'الرجاء ارسال عنوان الشركة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        // $manager_email = $request->input('manager_email');
        // $manager_username = substr(strstr($manager_email, '@', true), 0);

        $manager_user = User::create([
            'u_username' => $request->input('manager_email'),
            'name' => $request->input('manager_name'),
            'email' => $request->input('manager_email'),
            'password' => bcrypt($request->input('manager_password')),
            'u_phone1' => $request->input('phone'),
            'u_address' => $request->input('address'),
            'u_role_id' => 6, // company manager
        ]);

        // if the manager user created successfully, create the company (it is always true)
        if ($manager_user) {
            $company = Company::create([
                'c_name' => $request->input('company_name'),
                'c_manager_id' => $manager_user->u_id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'تم انشاء حساب المدير و الشركة بنجاح',
                'manager' => $manager_user,
                'company' => $company
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم إنشاء حساب المدير',
                'manager' => $manager_user,
            ]);
        }
    }

    // public function isCompanyNameUnique(){}
}
