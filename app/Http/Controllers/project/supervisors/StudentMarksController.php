<?php

namespace App\Http\Controllers\project\supervisors;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\MajorSupervisor;
use App\Models\Registration;
use App\Models\StudentCompany;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class StudentMarksController extends Controller
{
    public function index(){
        return view('project.supervisor.studnet_marks.index');
    }

    public function list_student_mark_ajax(Request $request){
        $user = User::find(auth()->user()->u_id);
        // $ms_majors_id = MajorSupervisor::where('ms_super_id' , $user->u_id)
        //                             ->pluck('ms_major_id')
        //                             ->toArray();
        $students = User::query();
        $students = $students->where('u_role_id' , 2)
        ->whereIn('u_major_id' , function($query){
            $query->select('ms_major_id')->from('major_supervisors')->where('ms_super_id',auth()->user()->u_id);
        });
        if($request->filled('student_name')){
            $student_search = $request->input('student_name');
            $students = $students->where('name' , 'like' , '%'.$student_search.'%');
        }
        if($request->filled('company_name')){
            $company_search = $request->input('company_name');
            $students = $students->whereIn('u_id' , function($query) use ($company_search){
                $query->select('sc_student_id')->from('students_companies')->whereIn('sc_company_id',function($query2) use ($company_search){
                    $query2->select('c_id')->from('companies')->where('c_name','like','%'.$company_search.'%');
                });
            });
        }
        // $students = MajorSupervisor::where('ms_super_id' , $user->u_id)->get();
        // $majors = Major::whereIn('m_id' , $ms_majors_id)
        //                 ->whereNot('m_id' , $ms_majors_id)
        //                 ->get();
        // $major = Major::find($ms_majors_id);
        $students = $students->get();
        foreach($students as $student){
            $student->training_supervisor_marks = Registration::where('r_student_id' , $student->u_id)->where('r_semester' , SystemSetting::first()->ss_semester_type)->where('r_year',SystemSetting::first()->ss_year)->first()->university_score ?? '0';
            $student->company_marks = Registration::where('r_student_id' , $student->u_id)->where('r_semester' , SystemSetting::first()->ss_semester_type)->where('r_year',SystemSetting::first()->ss_year)->first()->company_score ?? '0';
            $student->company = StudentCompany::where('sc_student_id' , $student->u_id)->first()->company()->first()->c_name ?? '0';
            $student->training_supervisor = Registration::where('r_student_id' , $student->u_id)->where('r_semester' , SystemSetting::first()->ss_semester_type)->where('r_year',SystemSetting::first()->ss_year)->first()->supervisor()->first()->name ?? '0';
        }
        return response()->json([
            'success'=>'true',
            'view'=>view('project.supervisor.studnet_marks.ajax.students_mark',['data'=>$students])->render()
        ]);
    }
}
