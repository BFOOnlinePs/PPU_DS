<?php

namespace App\Http\Controllers\project\students\company;

use App\Http\Controllers\Controller;
use App\Models\StudentCompany;

class CompanyController extends Controller
{
    public function index($id)
    {
        $student_companies = StudentCompany::where('sc_student_id', $id)
                                            ->where('sc_status' , 1)
                                            ->get();
        return view('project.student.company.index' , ['student_companies' => $student_companies]);
    }
}
