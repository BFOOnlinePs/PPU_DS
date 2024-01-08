<?php

namespace App\Http\Controllers\project\communications_manager_with_companies\companies;

use App\Http\Controllers\Controller;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    public function index()
    {
        $students_id = User::where('u_role_id' , 2)
                    ->pluck('u_id')
                    ->toArray();
        $students_companies = StudentCompany::whereIn('sc_student_id', $students_id)
                ->select('sc_company_id')
                ->groupBy('sc_company_id')
                ->get();
        return view('project.communications_manager_with_companies.companies.index' , ['students_companies' => $students_companies]);
    }
    public function students($id)
    {
        $user = User::where('u_role_id' , 2)
                ->pluck('u_id')
                ->toArray();
        $students_company = StudentCompany::whereIn('sc_student_id', $user)
                            ->where('sc_company_id' , $id)
                            ->select('sc_student_id' , DB::raw('MAX(sc_status) as sc_status'))
                            ->groupBy('sc_student_id')
                            ->get();
        return view('project.communications_manager_with_companies.companies.students' , ['students_company' => $students_company]);
    }
}
