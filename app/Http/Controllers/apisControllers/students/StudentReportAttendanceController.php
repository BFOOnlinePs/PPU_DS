<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentReportAttendanceController extends Controller
{
    public function index(Request $request){
        $attendance = StudentAttendance::where('sa_student_company_id', $request->input('student_company_id'))->get();

        if ($attendance->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'لم يسجل الطالب اي حضور حتى الان'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'attendance' => $attendance,
        ], 200);
    }
}
