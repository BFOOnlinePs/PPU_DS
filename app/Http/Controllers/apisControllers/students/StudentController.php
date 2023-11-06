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
            ->with(['userMentorTrainer' => function ($query) {
                $query->select('u_id', 'name');
            }])
            ->with(['userAssistant' => function ($query) {
                $query->select('u_id', 'name');
            }])
            ->get();

        // ->with(['companyBranch.manager' => function ($query) {
        //     $query->select('u_id', 'name');
        // }])

        if ($companies->isEmpty()) {
            return response()->json([
                'message' => 'لا يوجد تسجيل للطالب في اي شركة حاليا'
            ], 200);
        }

        // in future:
        // $companies = StudentCompany::where('sc_student_id', auth()->user()->u_id)
        //     ->with(['company', 'companyBranch.manager'])
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'sc_id' => $item->sc_id,
        //             'sc_student_id' => $item->sc_student_id,
        //             'sc_company_id' => $item->sc_company_id,
        //             'created_at' => $item->created_at,
        //             'updated_at' => $item->updated_at,
        //             'company' => [
        //                 'c_id' => $item->company->c_id,
        //                 'c_name' => $item->company->c_name,
        //                 'created_at' => $item->company->created_at,
        //                 'updated_at' => $item->company->updated_at,
        //             ],
        //             'company_branch' => [
        //                 'b_id' => $item->companyBranch->b_id,
        //                 'manager' => [
        //                     'u_id' => $item->companyBranch->manager->u_id,
        //                     'name' => $item->companyBranch->manager->name,
        //                 ],
        //             ],
        //         ];
        //     });


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
