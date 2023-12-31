<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SemesterCourse;
use App\Models\SystemSetting;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index(){
        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;

        $data = SemesterCourse::with('courses')->where('sc_semester',$systemSettings->ss_semester_type)->where('sc_year',$systemSettings->ss_year)->get();

        return view('project.admin.registration.index',['data'=>$data,'semester'=>$semester, 'year'=>$year]);
    }

    public function CourseStudents($id){

        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;


        $data = Registration::with('users','courses')->where('r_course_id',$id)
        ->where('r_year',$year)
        ->where('r_semester',$semester)
        ->get();

        return view('project.admin.registration.courseStudents',['data'=>$data]);

    }

    public function SemesterStudents(){

        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;


        $data = Registration::with('users','courses')
        ->where('r_year',$year)
        ->where('r_semester',$semester)
        ->get();

        return view('project.admin.registration.semesterStudents',['data'=>$data]);

    }

}
