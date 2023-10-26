<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\StudentReport;
use Illuminate\Http\Request;

class StudentReportAttendanceController extends Controller
{
    public function getStudentReportsWithAttendance(Request $request)
    {
        $student_company_id = $request->input('student_company_id');
        $attendance = StudentAttendance::where('sa_student_company_id', $student_company_id)->get();

        $reports = StudentReport::whereHas('attendance', function ($query) use ($student_company_id){
            $query->where('sa_student_company_id', $student_company_id);
        })->get();

        if ($attendance->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'لم يسجل الطالب اي حضور مؤخرا'
            ], 200);
        }


        return response()->json([
            'status' => true,
            'attendance' => $attendance,
            'reports' => $reports
        ], 200);
    }
}
