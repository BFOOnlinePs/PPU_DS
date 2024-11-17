<?php

namespace App\Http\Controllers\project\supervisors;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\MajorSupervisor;
use App\Models\Registration;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class StudentMarksController extends Controller
{
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Show the list of students for the logged in supervisor.
     *
     * @return \Illuminate\Http\Response
     */
/******  4d6b1ccb-8425-4712-8a78-18e51c14a180  *******/
    public function index(){
        $user = User::find(auth()->user()->u_id);
        // $ms_majors_id = MajorSupervisor::where('ms_super_id' , $user->u_id)
        //                             ->pluck('ms_major_id')
        //                             ->toArray();
        $students = User::where('u_role_id' , 2)
                        ->whereIn('u_major_id' , function($query){
                            $query->select('ms_major_id')->from('major_supervisors')->where('ms_super_id',auth()->user()->u_id);
                        })
                        ->get();
        foreach($students as $student){
            $student->training_supervisor_marks = Registration::where('r_student_id' , $student->u_id)->where('r_semester' , SystemSetting::first()->ss_semester_type)->where('r_year',SystemSetting::first()->ss_year)->first()->university_score ?? '0';
            $student->company_marks = Registration::where('r_student_id' , $student->u_id)->where('r_semester' , SystemSetting::first()->ss_semester_type)->where('r_year',SystemSetting::first()->ss_year)->first()->company_score ?? '0';
        }
        // $students = MajorSupervisor::where('ms_super_id' , $user->u_id)->get();
        // $majors = Major::whereIn('m_id' , $ms_majors_id)
        //                 ->whereNot('m_id' , $ms_majors_id)
        //                 ->get();
        // $major = Major::find($ms_majors_id);
        return view('project.supervisor.studnet_marks.index' , ['data' => $students]);
    }
}
