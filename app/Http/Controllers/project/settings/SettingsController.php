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
            $extension = $file->getClientOriginalExtension();
            // Allowed Excel extensions
            $allowedExtensions = ['xlsx', 'xls'];
            if (in_array($extension, $allowedExtensions)) {
                // Read the first row of the Excel file
                $firstRow = Excel::toCollection([], $file)->first()->first();
                return response()->json(['status' => 1 ,'headers' => $firstRow]);
            }
            else {
                return response()->json(['status' => 0]);
            }
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
            $course_object = new CoursesImport($result);
            $major_object = new MajorsImport($result);
            $user_object = new UsersImport($result);
            $registration_object = new RegistrationsImport($result);
            Excel::import($course_object, $file);
            Excel::import($major_object, $file);
            Excel::import($user_object, $file);
            Excel::import($registration_object, $file);
            return response()->json([
                'registration_object' => $registration_object->getCount() ,
                'major_object' => $major_object->getCount() ,
                'user_object' => $user_object->getCount() ,
                'course_object' => $course_object->getCount() ,
                'courses_array' => $course_object->getCoursesArray(),
                'majors_array' => $major_object->getMajorsArray(),
                'students_numbers_array' => $user_object->getArrayStudentsNumbers() ,
                'students_names_array' => $user_object->getArrayStudentsNames() ,
                'registration_array' => $registration_object->getRegistrationArray()
            ]);
        }
    }
    public function validateStepOne(Request $request)
    {
        if ($request->hasFile('input-file')) {
            $file = $request->file('input-file');
            $extension = $file->getClientOriginalExtension();
            // Allowed Excel extensions
            $allowedExtensions = ['xlsx', 'xls'];
            if (in_array($extension, $allowedExtensions)) {
                return response()->json(['status' => 1]);
            }
            else {
                return response()->json(['status' => 0]);
            }
        }
    }


    public function systemSettings(){
        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;

        return view('project.admin.settings.systemSettings' , ['year' => $year, 'semester' => $semester]);
    }

    public function systemSettingsUpdate(Request $request){
        $systemSettings = SystemSetting::first();

        $year = $request->year;
        $semester = $request->semester;


        $systemSettings->ss_year = $year;
        $systemSettings->ss_semester_type = $semester;

        if($systemSettings->save()) {
            return response()->json([
                'success'=> 'true'
            ]);
        }
    }


}
