<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // the companies that student registered in for trainings / current student
    public function index()
    {
        $student_id = auth()->user()->u_id;


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


        return response()->json(['student_companies' => $trainings], 200);
    }
}




// $companies = StudentCompany::where('sc_student_id', auth()->user()->u_id)
//     ->with('companyBranch')->get();
//
// same as:
//
// foreach($companies as $key){
//     $key->bb = CompanyBranch::where('b_id',$key->sc_branch_id)->first();
// }
