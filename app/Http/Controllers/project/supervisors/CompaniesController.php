<?php

namespace App\Http\Controllers\project\supervisors;

use App\Http\Controllers\Controller;
use App\Models\MajorSupervisor;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;


class CompaniesController extends Controller
{
    public function index()
    {
        return view('project.supervisor.companies.index');
    }
    public function students($id)
    {
        $major_supervisor = MajorSupervisor::where('ms_super_id' , auth()->user()->u_id)
                            ->pluck('ms_major_id')
                            ->toArray();
        $user = User::whereIn('u_major_id' , $major_supervisor)
                ->where('u_role_id' , 2)
                ->pluck('u_id')
                ->toArray();
        $students_company = StudentCompany::whereIn('sc_student_id', $user)
                            ->where('sc_status', 1)
                            ->where('sc_company_id' , $id)
                            ->select('sc_student_id')
                            ->groupBy('sc_student_id')
                            ->get();

        return view('project.supervisor.companies.students' , ['students_company' => $students_company]);
    }

    public function list_companies(Request $request){
        $major_supervisor = MajorSupervisor::where('ms_super_id' , auth()->user()->u_id)
                            ->pluck('ms_major_id')
                            ->toArray();
        $user = User::whereIn('u_major_id' , $major_supervisor)
                ->where('u_role_id' , 2)
                ->pluck('u_id')
                ->toArray();
        $students_companies = StudentCompany::query();
        $students_companies = $students_companies->whereIn('sc_student_id', $user)
        ->where('sc_status', 1)
        ->select('sc_company_id')
        ->groupBy('sc_company_id');
        if($request->filled('student_name')){
            $students_companies = $students_companies->whereHas('users',function ($query) use ($request){
                $query->where('name' , 'like' , '%'.$request->student_name.'%');
            });
        }
        if($request->filled('company_name')){
            $students_companies = $students_companies->whereHas('company',function ($query) use ($request){
                $query->where('c_name' , 'like' , '%'.$request->company_name.'%');
            });
        }
        $students_companies = $students_companies->get();

        foreach ($students_companies as $key){
            $key->user = User::whereIn('u_id',function ($query) use ($key){
                $query->select('sc_student_id')->from('students_companies')->where('sc_status', 1)->where('sc_company_id' , $key->sc_company_id)->groupBy('sc_student_id');
            })->get();
//                StudentCompany::whereIn('sc_student_id', $user)
//                ->where('sc_status', 1)
//                ->where('sc_company_id' , $key->sc_company_id)
//                ->select('sc_student_id')
//                ->groupBy('sc_student_id')
//                ->get();
        }
        return response()->json([
            'success' => 'true',
            'view' => view('project.supervisor.companies.ajax.list_companies',['students_companies' => $students_companies])->render()
        ]);
    }
}
