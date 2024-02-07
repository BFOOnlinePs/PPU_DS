<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\add_edit_company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class editCompanyController extends Controller
{
    public function getCompanyAndManagerInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
        ], [
            'company_id.required' => 'الرجاء إرسال رقم الشركة',
            'company_id.exists' => 'رقم الشركة غير موجود',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $company_id = $request->input('company_id');
        $company_info = Company::where('c_id', $company_id)->first();

        $manager_id = $company_info->c_manager_id;
        $manager_info = User::where('u_id', $manager_id)->first();


        return response()->json([
            'status' => true,
            'company' => $company_info,
            'manager' => $manager_info,
        ]);
    }


    public function updateCompanyAndManagerInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
            'manager_id' => 'required|exists:users,u_id',
            'company_name' => ['required', Rule::unique('companies', 'c_name')->ignore($request->input('company_id'), 'c_id')],
            'manager_name' => 'required',
            'manager_email' => ['email', Rule::unique('users', 'email')->ignore($request->input('manager_id'), 'u_id')],
            // 'manager_password' => 'required',
            'phone' => 'required', // main branch phone + manager phone
            'address' => 'required', // main branch phone + manager phone
            'company_type' => 'in:1,2',
            'category_id' => 'exists:companies_categories,cc_id',
        ], [
            'company_id.required' => 'الرجاء إرسال رقم الشركة',
            'company_id.exists' => 'رقم الشركة غير موجود',
            'company_id.required' => 'الرجاء إرسال رقم المدير',
            'company_id.exists' => 'رقم المدير غير موجود',
            'company_name.required' => 'الرجاء ارسال اسم الشركة',
            'company_name.unique' => 'يوجد شركة بنفس الاسم الذي قمت بادخاله',
            'manager_name.required' => 'الرجاء ارسال اسم مدير الشركة',
            'manager_email.required' => 'الرجاء ارسال ايميل مدير الشركة',
            'manager_email.email' => 'يجب ان تكون صيغة البريد الإلكتروني صحيحة',
            'manager_email.unique' => 'البريد الإلكتروني موجود بالفعل',
            // 'manager_password.required' => 'الرجاء ارسال كلمة سر حساب مدير الشركة',
            'phone.required' => 'الرجاء ارسال رقم هاتف الشركة',
            'address.required' => 'الرجاء ارسال عنوان الشركة',
            'company_type.required' => 'الرجاء تحديد نوع الشركة',
            'company_type.in' => 'يجب أن يكون نوع الشركة من الأنواع المحددة',
            'category_id.required' => 'الرجاء إرسال رقم التصنيف',
            'category_id.exists' => 'التصنيف غير موجود',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $company_info = Company::where('c_id', $request->input('company_id'))->first();

        $company_info->update([
            'c_name' => $request->input('company_name'),
            'c_type' => $request->input('company_type'),
            'c_category_id' => $request->input('category_id'),
            'c_description' => $request->input('company_description'),
            'c_website' => $request->input('company_website')
        ]);


        // when update the user update the main branch (phone1, phone2 and address)
        $manager_info = User::where('u_id', $request->input('manager_id'))->first();
        $manager_info->update([
            'u_username' => $request->input('manager_email'),
            'name' => $request->input('manager_name'),
            'email' => $request->input('manager_email'),
            'u_phone1' => $request->input('phone'),
            'u_address' => $request->input('address'),
        ]);

        if ($request->has('manager_password')) {
            $manager_info->update([
                'password' => bcrypt($request->input('manager_password')),
            ]);
        }

        $main_branch = CompanyBranch::where('b_manager_id', $request->input('manager_id'))->where('b_main_branch', 1)->first();

        // it should be exists
        if ($main_branch) {
            $main_branch->update([
                'b_phone1' => $request->input('phone'),
                'b_address' => $request->input('address'),
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث الشركة و/او الفرع الرئيسي و/او المدير بنجاح',
            'company' => $company_info,
            'manager' => $manager_info,
        ]);
    }
}
