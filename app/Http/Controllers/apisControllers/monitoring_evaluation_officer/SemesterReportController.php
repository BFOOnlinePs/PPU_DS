<?php

namespace App\Http\Controllers\apisControllers\monitoring_evaluation_officer;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\SemesterCourse;
use App\Models\StudentCompany;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class SemesterReportController extends Controller
{
    // filters as query params
    public function getSemesterReport(Request $request)
    {

        $system_settings = SystemSetting::first();

        $year = $system_settings->ss_year;
        $semester = $system_settings->ss_semester_type;

        if ($request->has('year')) {
            $year = $request->input('year');
        }

        if ($request->has('semester')) {
            $semester = $request->input('semester');
        }

        // 1. Total number of registered students
        // affected by: year, semester, gender, major

        // students ids registers in courses in specific yser and semester
        $uniqueStudentsIdsInCourses = Registration::where('r_year', $year)->where('r_semester', $semester)
            ->get()->unique('r_student_id')->values()->pluck('r_student_id');

        $studentsInCourses = User::whereIn('u_id', $uniqueStudentsIdsInCourses)->get();

        if ($request->has('gender')) {
            $studentsInCourses = $studentsInCourses->where('u_gender', $request->input('gender'))->values();
        }

        if ($request->has('major')) {
            $studentsInCourses = $studentsInCourses->where('u_major_id', $request->input('major'))->values();
        }

        $numStudentsInCourses = $studentsInCourses->count();
        // return $numStudentsInCourses; // 1

        // 2. Total number of Semester Courses
        // affected by: year, semester
        $courses = SemesterCourse::where('sc_year', $year)->where('sc_semester', $semester)->get()->count();
        // return $courses; // 2

        // 3. Total of Training Hours for all students
        // affected by: year, semester, gender, major, company, branch


        // 4. Total of Companies' Trainees
        // affected by: year, semester, gender, major, company, branch


        // 5. Total number of Companies have trainees
        // affected by: year, semester, gender, major

        $studentsCompanies = StudentCompany::whereHas('registration', function ($query) use ($year, $semester) {
            $query->where('r_year', $year)->where('r_semester', $semester);
        })->get();


        if ($request->has('gender') || $request->has('major')) {
            $studentsCompanies = $studentsCompanies->load('users');

            if ($request->has('gender')) {
                $studentsCompanies = $studentsCompanies->filter(function ($studentCompany) use ($request) {
                    return $studentCompany->users->u_gender == $request->input('gender');
                })->values();
            }

            if ($request->has('major')) {
                $studentsCompanies = $studentsCompanies->filter(function ($studentCompany) use ($request) {
                    return $studentCompany->users->u_major_id == $request->input('major');
                })->values();
            }
        }


        $studentsCompanies = $studentsCompanies->unique('sc_company_id')->values();
        // $studentsCompanies = StudentCompany::select('sc_company_id')->groupBy('sc_company_id')->get();
        return $studentsCompanies;
    }
}