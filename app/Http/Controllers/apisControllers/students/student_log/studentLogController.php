<?php

namespace App\Http\Controllers\apisControllers\students\student_log;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentLogController extends Controller
{
    // to get the student attendance in all trainings
    public function getAllStudentAttendanceLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sa_student_id' => 'required'
        ], [
            'sa_student_id.required' => 'الرجاء ارسال رقم الطالب'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        };


        $allStudentAttendanceLog = StudentAttendance::where('sa_student_id', $request->input('sa_student_id'))
            ->with('training.company')->get();

        if (!$allStudentAttendanceLog) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم تسحيل اي حضور بعد'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $allStudentAttendanceLog,
        ]);
    }


    public function getAllStudentReportsLog(Request $request){
        $validator = Validator::make($request->all(), [
            'sr_student_id' => 'required'
        ], [
            'sr_student_id.required' => 'الرجاء ارسال رقم الطالب'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        };


        $allStudentReportsLog = StudentReport::where('sr_student_id', $request->input('sr_student_id'))->get();

        if (!$allStudentReportsLog) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم تسليم اي تقرير بعد'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $allStudentReportsLog,
        ]);
    }
}
