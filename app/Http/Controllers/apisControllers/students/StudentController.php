<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // the companies that student registered in
    public function index()
    {
        $companies = StudentCompany::where('sc_student_id', auth()->user()->u_id)
            ->with('companyBranch.companies')
            ->get();

        if($companies->isEmpty()){
            return response()->json([
                'message' => 'the user has no companies'
            ]);
        }
        $userCompanies = $companies->pluck('companyBranch.companies');

        $selectedCompanyInfo = $userCompanies->map(function ($company) {
            return [
                'c_id' => $company['c_id'],
                'c_name' => $company['c_name'],
                'c_website' => $company['c_website'],
            ];
        });
        return response()->json(['companies' => $selectedCompanyInfo]);
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


