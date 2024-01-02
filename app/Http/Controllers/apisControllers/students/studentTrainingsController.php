<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\companyBranchDepartments;
use App\Models\CompanyDepartment;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentTrainingsController extends Controller
{
    public function getStudentTrainings(Request $request)
    {
        $student_id = $request->input('student_id');

        $user = User::where('u_id', $student_id)->where('u_role_id', 2)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الطالب غير موجود',
            ]);
        }

        $trainings = StudentCompany::where('sc_student_id', $student_id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($trainings->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'لا يوجد تسجيل للطالب في اي شركة حاليا'
            ], 200);
        }

        // add company name, branch address, mentor name, and assistant name for each training object
        $trainings = $trainings->map(function ($training) {
            $training->company_name = Company::where('c_id', $training->sc_company_id)->pluck('c_name')->first();
            $training->branch_name = CompanyBranch::where('b_id', $training->sc_branch_id)->pluck('b_address')->first();
            $training->mentor_trainer_name = User::where('u_id', $training->sc_mentor_trainer_id)->pluck('name')->first();
            $training->assistant_name = User::where('u_id', $training->sc_assistant_id)->pluck('name')->first();
            return $training;
        });

        return response()->json(['status' => true, 'student_companies' => $trainings], 200);
    }

    public function registerStudentInTraining(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'student_id' => 'required',
                'company_id' => 'required',
                'branch_id' => 'required',
                'agreement_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,csv,xlsx',
            ],
            [
                'student_id.required' => 'الرجاء ارسال رقم الطالب',
                'company_id.required' => 'الرجاء ارسال رقم الشركة',
                'branch_id.required' => 'الرجاء ارسال رقم الفرع',
                'agreement_file.mimes' => 'يجب ان تكون صيغة الملف من احدى الصيغ التالية: jpg,jpeg,png,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,csv,xlsx'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                "message" => $validator->errors()->first(),
            ]);
        }

        $student_id = $request->input('student_id');
        $company_id = $request->input('company_id');
        $branch_id = $request->input('branch_id');
        $department_id = $request->input('department_id');
        $mentor_id = $request->input('mentor_id');
        $assistant_id = $request->input('assistant_id');


        $user = User::where('u_id', $student_id)->where('u_role_id', 2)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الطالب غير موجود',
            ]);
        }

        $company = Company::where('c_id', $company_id)->first();

        if (!$company) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الشركة غير موجود',
            ]);
        }


        if ($request->hasFile('agreement_file')) {
            $file = $request->file('agreement_file');
            $folderPath = 'uploads';
            // $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $file->storeAs($folderPath, $fileName, 'public');
        }

        $student_company = StudentCompany::create([
            'sc_student_id' => $student_id,
            'sc_company_id' => $company_id,
            'sc_branch_id' => $branch_id,
            'sc_department_id' => $department_id,
            'sc_status' => 1,
            'sc_mentor_trainer_id' => $mentor_id,
            'sc_assistant_id' => $assistant_id,
            'sc_agreement_file' => $fileName ?? null

        ]);

        return response()->json([
            'status' => true,
            "message" => 'تم تسجيل الطالب بنجاح',
            'student_company' => $student_company
        ]);
    }

    public function updateStudentRegistrationInTraining(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sc_id' => 'required',
                'branch_id' => 'required',
                'agreement_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,csv,xlsx',
            ],
            [
                'sc_id.required' => 'الرجاء ارسال رقم التدريب',
                'branch_id.required' => 'الرجاء ارسال رقم الفرع',
                'agreement_file.mimes' => 'يجب ان تكون صيغة الملف من احدى الصيغ التالية: jpg,jpeg,png,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,csv,xlsx'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                "message" => $validator->errors()->first(),
            ]);
        }
        $sc_id = $request->input('sc_id');
        $student_company = StudentCompany::where('sc_id', $sc_id)->first();
        if (!$student_company) {
            return response()->json([
                'status' => false,
                "message" => 'التدريب غير موجود',
            ]);
        }


        $student_company->update([
            'sc_branch_id' => $request->input('branch_id'),
            'sc_department_id' => $request->input('department_id'),
            'sc_mentor_id' => $request->input('mentor_id'),
            'sc_assistant_id' => $request->input('assistant_id'),
            'sc_status' => $request->input('status'),
        ]);

        if ($request->hasFile('agreement_file')) {
            $file = $request->file('agreement_file');
            $folderPath = 'uploads';
            // $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $file->storeAs($folderPath, $fileName, 'public');
            $student_company->update([
                'sc_agreement_file' => $fileName
            ]);
        }

        return response()->json([
            'status' => true,
            "message" => 'تم تحديث تسجيل الطالب بنجاح',
        ]);
    }

    public function getAllCompaniesAndAssistants()
    {
        $companies = Company::get();
        $assistants = User::where('u_role_id', 4)->get();

        return response()->json([
            'status' => true,
            'companies' => $companies,
            'assistants' => $assistants,
        ]);
    }


    public function getCompanyBranchesWithEmployees(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'company_id' => 'required',
            ],
            [
                'company_id.required' => 'الرجاء ارسال رقم الشركة'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                "message" => $validator->errors()->first(),
            ]);
        }

        $company_id = $request->input('company_id');
        $company = Company::where('c_id', $company_id)->first();

        if (!$company) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الشركة غير موجود',
            ]);
        }

        $company_branches = CompanyBranch::where('b_company_id', $company_id)->get();
        $company_employees = User::where('u_company_id', $company_id)->get();

        // if($company_branches->isEmpty()){
        //     return response()->json([
        //         'status' => false,
        //         "message" => 'لا يوجد فروع للشركة',
        //     ]);
        // }

        return response()->json([
            'status' => true,
            "company_branches" => $company_branches,
            'company_employees' => $company_employees
        ]);
    }

    public function getBranchDepartments(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'branch_id' => 'required',
            ],
            [
                'branch_id.required' => 'الرجاء ارسال رقم فرع الشركة'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                "message" => $validator->errors()->first(),
            ]);
        }

        $branch_id = $request->input('branch_id');
        $branch = CompanyBranch::where('b_id', $branch_id)->first();

        if (!$branch) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الفرع غير موجود',
            ]);
        }

        $branch_departments_ids = companyBranchDepartments::where('cbd_company_branch_id', $branch_id)->pluck('cbd_d_id');
        $company_departments_with_names = CompanyDepartment::whereIn('d_id', $branch_departments_ids)->get();

        return response()->json([
            'status' => true,
            'departments' => $company_departments_with_names,
        ]);
    }
}
