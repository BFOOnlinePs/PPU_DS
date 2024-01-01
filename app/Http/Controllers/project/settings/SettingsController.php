<?php

namespace App\Http\Controllers\project\settings;

use App\Http\Controllers\Controller;
use App\Imports\CoursesImport;
use App\Imports\MajorsImport;
use App\Imports\RegistrationsImport;
use App\Imports\UsersImport;
use App\Models\Registration;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Models\SemesterCourse;
use Maatwebsite\Excel\Facades\Excel;

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

    public function integration()
    {
        return view('project.admin.settings.integration');
    }
    public function uploadFileExcel(Request $request)
    {
        if ($request->hasFile('input-file')) {
            $file = $request->file('input-file');
            // Read the first row of the Excel file
            $firstRow = Excel::toCollection([], $file)->first()->first();
            return response()->json(['headers' => $firstRow]);
        }
    }
    public function submitForm(Request $request)
    {
        if ($request->hasFile('input-file')) {
            $file = $request->file('input-file');
            $decodedMap = explode(',', $request->input('data'));
            $result = null;
            for ($i = 0; $i < count($decodedMap) - 1; $i += 2) {
                $key = $decodedMap[$i];
                $value = $decodedMap[$i + 1];
                $result[$key] = $value;
            }
            Excel::import(new UsersImport($result), $file);
            Excel::import(new CoursesImport($result), $file);
            Excel::import(new MajorsImport($result), $file);
            Excel::import(new RegistrationsImport($result), $file);
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
