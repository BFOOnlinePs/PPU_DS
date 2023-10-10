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
        $companies = StudentCompany::where('sc_student_id', auth()->user()->id)
        ->with('companyBranch')->get();

        // foreach($companies as $key){
        //     $key->bb = CompanyBranch::where('b_id',$key->sc_branch_id)->first();
        // }


        return response([
            'message' => 'get companies successfully',
            'companies' => $companies
        ]);
    }
}
