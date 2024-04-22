<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\add_edit_company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\companyBranchDepartments;
use App\Models\CompanyDepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


// this edit company from the stepper
class editCompanyController extends Controller
{
    // step one
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
            'company_english_name' => ['required', Rule::unique('companies', 'c_english_name')->ignore($request->input('company_id'), 'c_id')],
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
            'company_name.required' => 'الرجاء ارسال اسم الشركة باللغة العربية',
            'company_name.unique' => 'يوجد شركة بنفس الاسم الذي قمت بادخاله باللغة العربية',
            'company_english_name.required' => 'الرجاء ارسال اسم الشركة باللغة الانجليزية',
            'company_english_name.unique' => 'يوجد شركة بنفس الاسم الذي قمت بادخاله باللغة الانجليزية',
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
            'c_english_name' => $request->input('company_english_name'),
            'c_type' => $request->input('company_type'),
            'c_category_id' => $request->input('category_id'),
            'c_description' => $request->input('company_description'),
            'c_english_description' => $request->input('company_english_description'),
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

        $main_branch = CompanyBranch::where('b_manager_id', $request->input('manager_id'))
            ->where('b_main_branch', 1)->first();

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

    // step 2
    public function getCompanyDepartments(Request $request)
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
        $company_departments = CompanyDepartment::where('d_company_id', $company_id)->get();

        return response()->json([
            'status' => true,
            'company_departments' => $company_departments
        ]);
    }

    public function addNewCompanyDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
            'department_name' => [
                'required',
                Rule::unique('company_departments', 'd_name')->where(function ($query) use ($request) {
                    return $query->where('d_company_id', $request->input('company_id'));
                })
            ]
        ], [
            'company_id.required' => 'الرجاء إرسال رقم الشركة',
            'company_id.exists' => 'رقم الشركة غير موجود',
            'department_name.required' => 'الرجاء إرسال إسم القسم الجديد',
            'department_name.unique' => 'يوجد قسم بنفس الإسم الذي قمت بإدخاله',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $company_department = CompanyDepartment::create([
            'd_name' => $request->input('department_name'),
            'd_company_id' => $request->input('company_id'),
            'd_status' => 1 // active
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة قسم الشركة بنجاح',
            'company_department' => $company_department,
        ]);
    }

    public function editCompanyDepartmentName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
            'department_id' => [
                'required',
                Rule::exists('company_departments', 'd_id')->where(function ($query) use ($request) {
                    $query->where('d_company_id', $request->input('company_id'));
                }),
            ],
            'department_name' => [
                'required',
                Rule::unique('company_departments', 'd_name')
                    ->where('d_company_id', $request->input('company_id'))
                    ->ignore($request->input('department_id'), 'd_id')
            ]
        ], [
            'company_id.required' => 'الرجاء إرسال رقم الشركة',
            'company_id.exists' => 'رقم الشركة غير موجود',
            'department_id.required' => 'الرجاء إرسال رقم القسم',
            'department_id.exists' => 'رقم القسم غير موجود',
            'department_name.required' => 'الرجاء إرسال إسم القسم الجديد',
            'department_name.unique' => 'القسم موجود',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $company_department = CompanyDepartment::where('d_id', $request->input('department_id'))->first();
        $company_department->update([
            'd_name' => $request->input('department_name'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تعديل قسم الشركة بنجاح',
            'company_department' => $company_department,
        ]);
    }

    // step 3

    public function getCompanyBranches(Request $request)
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
        // $company_branches = CompanyBranch::where('b_company_id', $company_id)
        //     ->with('companyBranchDepartments.companyDepartment')->get();

        $company_branches = CompanyBranch::where('b_company_id', $company_id)
            ->with(['companyBranchDepartments' => function ($query) {
                $query->where('cbd_status', 1)
                    ->with('companyDepartment');
            }])
            ->get();

        return response()->json([
            'status' => true,
            'company_branches' => $company_branches
        ]);
    }

    public function addNewCompanyBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
            'manager_id' => 'required|exists:users,u_id',
            'branch_address' => 'required',
            'branch_phone1' => 'required',

        ], [
            'company_id.required' => 'الرجاء إرسال رقم الشركة',
            'company_id.exists' => 'رقم الشركة غير موجود',
            'branch_address.required' => 'الرجاء إرسال العنوان',
            'branch_phone1.required' => 'الرجاء إرسال رقم الهاتف',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $company_branch = new CompanyBranch();
        $company_branch->b_company_id = $request->input('company_id');
        $company_branch->b_manager_id = $request->input('manager_id');
        $company_branch->b_address = $request->input('branch_address');
        $company_branch->b_phone1 = $request->input('branch_phone1');
        $company_branch->b_phone2 = $request->input('branch_phone2');
        $company_branch->b_main_branch = 0; // 1:yes, 0:no

        if ($company_branch->save()) {
            $branch_departments = $request->input('branch_departments');
            if ($branch_departments) {
                foreach ($branch_departments as $branch_department) { // each one is department id
                    $company_branch_department = new companyBranchDepartments();
                    $company_branch_department->cbd_d_id = $branch_department;
                    $company_branch_department->cbd_company_branch_id = $company_branch->b_id;
                    if (!$company_branch_department->save())
                        return response()->json([
                            'status' => false,
                            'message' => 'تم إنشاء الفرع لكن لم يتم إضافة الأقسام الخاصة به'
                        ]);
                }
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم إنشاء فروع الشركة'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم إنشاء الفرع و إضافة أقسامه بنجاح'
        ]);
    }


    // the branch_departments is a list of departments id,
    // ex:
    // "branch_departments": [
    //     10,
    //     11
    // ]
    public function editCompanyBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:company_branches,b_id',
            'branch_address' => 'required',
            'branch_phone1' => 'required',
            'branch_departments' => 'nullable|array',
        ], [
            'branch_id.required' => 'الرجاء إرسال رقم الفرع',
            'branch_id.exists' => 'رقم الفرع غير موجود',
            'branch_address.required' => 'الرجاء إرسال العنوان',
            'branch_phone1.required' => 'الرجاء إرسال رقم الهاتف',
            'branch_departments.array' => 'أقسام الفرع يجب ان تكون قائمة array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $company_branch = CompanyBranch::where('b_id', $request->input('branch_id'))->first();
        $company_branch->update([
            'b_address' => $request->input('branch_address'),
            'b_phone1' => $request->input('branch_phone1'),
            'b_phone2' => $request->input('branch_phone2'),
        ]);

        // if main branch -> update the manager row in users table

        if ($company_branch->b_main_branch == 1) {
            $manager = User::where('u_role_id', 6)->where('u_id', $company_branch->b_manager_id)->first();
            $manager->update([
                'u_address' => $request->input('branch_address'),
                'u_phone1' => $request->input('branch_phone1'),
                'u_phone2' => $request->input('branch_phone2'),
            ]);
        }


        // update departments

        $branch_id = $request->input('branch_id');

        $request_departments = $request->input('branch_departments');

        foreach ($request_departments as $request_department) { // each one is an id
            $company_branch_department = companyBranchDepartments::where('cbd_d_id', $request_department)
                ->where('cbd_company_branch_id', $branch_id)->first();

            if ($company_branch_department) {
                // if exists, make sure it's status will be 1
                if ($company_branch_department->cbd_status == 2) {
                    $company_branch_department->update([
                        'cbd_status' => 1
                    ]);
                }
            } else {
                // if not exists in the database, add it
                companyBranchDepartments::create([
                    'cbd_d_id' => $request_department,
                    'cbd_company_branch_id' => $branch_id,
                    'cbd_status' => 1
                ]);
            }
        }

        // exists in database but not in request (change status to delete)
        companyBranchDepartments::where('cbd_company_branch_id', $branch_id)
            ->whereNotIn('cbd_d_id', $request_departments)->update([
                'cbd_status' => 2
            ]);


        return response()->json([
            'status' => true,
            'message' => 'تم التعديل بنجاح'
        ]);
    }
}
