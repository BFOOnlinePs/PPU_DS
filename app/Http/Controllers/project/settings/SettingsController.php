<?php

namespace App\Http\Controllers\project\settings;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Models\SemesterCourse;
use App\Models\Registration;

class SettingsController extends Controller
{
    public function index()
    {
        $system_settings = SystemSetting::first();
        $background_color = $system_settings->ss_primary_background_color;
        $text_color = $system_settings->ss_primary_font_color;
        return view('project.admin.settings.coloring' , ['background_color' => $background_color, 'text_color' => $text_color]);
    }
    public function primary_background_color(Request $request)
    {
        $system_settings = SystemSetting::first();
        $system_settings->ss_primary_background_color = $request->color_value;
        if($system_settings->save()) {
            return response()->json([]);
        }
    }
    public function primary_font_color(Request $request)
    {
        $system_settings = SystemSetting::first();
        $system_settings->ss_primary_font_color = $request->color_value;
        if($system_settings->save()) {
            return response()->json([]);
        }
    }

    public function systemSettings(){
        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;

        $studentsNum = Registration::where('r_year',$year)
        ->where('r_semester',$semester)
        ->select('r_student_id')
        ->distinct()
        ->get();

        $coursesNum = SemesterCourse::where('sc_semester',$semester)
        ->where('sc_year',$year)
        ->get();

        return view('project.admin.settings.systemSettings' , ['year' => $year, 'semester' => $semester, 'studentsNum'=>count($studentsNum), 'coursesNum'=>count($coursesNum)]);
    }

    public function systemSettingsUpdate(Request $request){
        $systemSettings = SystemSetting::first();

        $year = $request->year;
        $semester = $request->semester;


        $systemSettings->ss_year = $year;
        $systemSettings->ss_semester_type = $semester;

        $studentsNum = Registration::where('r_year',$year)
        ->where('r_semester',$semester)
        ->select('r_student_id')
        ->distinct()
        ->get();

        $coursesNum = SemesterCourse::where('sc_semester',$semester)
        ->where('sc_year',$year)
        ->get();


        if($systemSettings->save()) {
            return response()->json([
                'success'=> 'true',
                'coursesNum'=> count($coursesNum),
                'studentsNum'=> count($studentsNum)
            ]);
        }
    }

}
