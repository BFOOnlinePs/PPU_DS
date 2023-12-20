<?php

namespace App\Http\Controllers\apisControllers\supervisors;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Major;
use App\Models\MajorSupervisor;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupervisorStudentsTrainingsController extends Controller
{
    public function getSupervisorStudentsCompanies()
    {
        $supervisorId = auth()->user()->u_id;
        $supervisorMajorsIdList = MajorSupervisor::where('ms_super_id', $supervisorId)->pluck('ms_major_id');
        $studentsIdList = User::where('u_role_id', 2)->whereIn('u_major_id', $supervisorMajorsIdList)->pluck('u_id');
        $companiesIdList = StudentCompany::whereIn('sc_student_id', $studentsIdList)->pluck('sc_company_id')->unique()->values();
        $companies = Company::whereIn('c_id', $companiesIdList)->get();

        if ($companies->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'لا يوجد شركات حاليا'
            ]);
        }

        return response()->json([
            'status' => true,
            'companies' => $companies,
        ]);
    }

    public function getSupervisorStudentsInCompany(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
        ], [
            'company_id.required' => 'يجب ارسال رقم الشركة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $companyId = $request->input('company_id');
        $supervisorId = auth()->user()->u_id;
        $supervisorMajorsIdList = MajorSupervisor::where('ms_super_id', $supervisorId)->pluck('ms_major_id');
        $supervisorStudentsIdList = User::where('u_role_id', 2)->whereIn('u_major_id', $supervisorMajorsIdList)->pluck('u_id');
        $studentInCompanyIdList = StudentCompany::where('sc_company_id', $companyId)->whereIn('sc_student_id', $supervisorStudentsIdList)->pluck('sc_student_id');
        $studentsInCompany = User::whereIn('u_id', $studentInCompanyIdList)->get();

        if ($studentsInCompany->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'لا يوجد طلاب في الشركة حاليا'
            ]);
        }

        $studentsInCompany = $studentsInCompany->map(function ($student) {
            // $student->newAttribute = 'Your New Value';
            $major_name = Major::where('m_id', $student->u_major_id)->pluck('m_name')->first();
            $student['major_name'] = $major_name;
            return $student;
        });


        return response()->json([
            'status' => true,
            'students_in_company' => $studentsInCompany,
        ]);
    }
}
