<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // the companies that student registered in for trainings / current student
    public function index()
    {
        $companies = StudentCompany::where('sc_student_id', auth()->user()->u_id)
            ->with('company')
            // ->with('companyBranch.companies')
            // ->with('companyBranch.manager')
            ->get();

        if ($companies->isEmpty()) {
            return response()->json([
                'message' => 'لا يوجد تسجيل للطالب في اي شركة حاليا'
            ], 200);
        }

        //i will change it when we need it
        // $selectedCompanyInfo = $companies->map(function ($company) {
        //     return [
        //         'c_id' => $company['c_id'],
        //         'c_name' => $company['c_name'],
        //         'c_website' => $company['c_website'],
        //     ];
        // });
        return response()->json(['student_companies' => $companies], 200);
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
