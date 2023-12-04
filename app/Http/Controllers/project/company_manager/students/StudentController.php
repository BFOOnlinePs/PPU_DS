<?php

namespace App\Http\Controllers\project\company_manager\students;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StudentCompany;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $company = Company::where('c_manager_id', '=' , auth()->user()->u_id)->first();
        $students_company = StudentCompany::where('sc_company_id', $company->c_id)
                                        ->where('sc_status' , 1)
                                        ->select('sc_student_id')
                                        ->groupBy('sc_student_id')
                                        ->get();
        return view('project.company_manager.students.index' , ['students_company' => $students_company]);
    }
}
