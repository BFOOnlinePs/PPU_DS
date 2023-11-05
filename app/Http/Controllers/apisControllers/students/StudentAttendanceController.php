<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class StudentAttendanceController extends Controller
{
    public function studentCheckIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sa_student_company_id' => 'required|exists:students_companies,sc_id',
            'sa_start_time_latitude' => 'required',
            'sa_start_time_longitude' => 'required',
            'sa_description' => 'nullable',
        ], [
            'sa_start_time_latitude.required' => 'الرجاء ارسال قيمة خط العرض اثناء الدخول',
            'sa_start_time_longitude.required' => 'الرجاء ارسال قيمة خط الطول اثناء الدخول',
            'sa_student_company_id.required' => 'الرجاء ارسال رقم التدريب',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $latestCheckIn = StudentAttendance::where('sa_student_id', auth()->user()->u_id)
            ->where('sa_student_company_id', $request->input('sa_student_company_id'))
            ->latest() // descending order
            ->first();

        if ($latestCheckIn) {
            $lastCheckInDate = Carbon::parse($latestCheckIn->sa_in_time)->toDateString();
            $today = Carbon::now('Asia/Gaza')->toDateString();

            // return response()->json([
            //     '$lastCheckInDate' => $lastCheckInDate,
            //     '$today' => $today
            // ]);
            if ($lastCheckInDate === $today) {
                return response()->json(['message' => 'تم تسجيل الحضور اليوم من قبل']);
            }
        }

        $studentCheckIn = StudentAttendance::create([
            'sa_student_id' => auth()->user()->u_id, // $request->input('sa_student_id')
            'sa_student_company_id' => $request->input('sa_student_company_id'),
            'sa_start_time_latitude' => $request->input('sa_start_time_latitude'),
            'sa_start_time_longitude' => $request->input('sa_start_time_longitude'),
            'sa_description' => $request->input('sa_description'),
            'sa_in_time' => Carbon::now('Asia/Gaza'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل الحضور',
            'data' => $studentCheckIn
        ]);
    }


    public function studentCheckOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'sa_id' => 'required',
            'sa_end_time_longitude' => 'required',
            'sa_end_time_latitude' => 'required',
            'sa_description' => 'nullable',
        ], [
            'sa_id.required' => 'الرجاء ارسال رقم الحضور',
            'sa_end_time_latitude.required' => 'الرجاء ارسال قيمة خط العرض اثناء الخروج',
            'sa_end_time_longitude.required' => 'الرجاء ارسال قيمة خط الطول اثناء الخروج',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        // $studentAttendance = StudentAttendance::where('sa_id', $request->input('sa_id'))->first();
        $latestCheckIn = StudentAttendance::where('sa_student_id', auth()->user()->u_id)
            ->where('sa_student_company_id', $request->input('sa_student_company_id'))
            ->whereNull('sa_out_time')
            ->latest() // descending order
            ->first();

        if (!$latestCheckIn) {
            return response()->json(['message' => ' لم يتم تسجيل الدخول / تم تسجيل المغادرة']);
        }

        if ($latestCheckIn) {
            $lastCheckInDate = Carbon::parse($latestCheckIn->sa_in_time)->toDateString();
            $today = Carbon::now('Asia/Gaza')->toDateString();

            if ($lastCheckInDate !== $today) {
                return response()->json(['message' => 'لم يتم تسجيل الدخول لهذا التدريب اليوم / تم تسجيل المغادرة']);
            }
        }

        $latestCheckIn->update([
            'sa_end_time_longitude' => $request->input('sa_end_time_longitude'),
            'sa_end_time_latitude' => $request->input('sa_end_time_latitude'),
            'sa_description' => $request->input('sa_description') ?? $latestCheckIn->sa_description,
            'sa_out_time' => Carbon::now('Asia/Gaza'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل المغادرة',
            'data' => $latestCheckIn
        ]);
    }


    // req: sa_student_company_id
    public function checkTodayStudentAttendance(Request $request)
    {
        $student_attendance = StudentAttendance::where('sa_student_id', auth()->user()->u_id)
            ->where('sa_student_company_id', $request->input('sa_student_company_id'))
            ->latest()
            ->first();

        $today_checkin = false;
        $today_checkout = false;
        $sa_description = null;

        if ($student_attendance) {
            $lastCheckInDate = Carbon::parse($student_attendance->sa_in_time)->toDateString();
            $today = Carbon::now('Asia/Gaza')->toDateString();

            if ($lastCheckInDate === $today) {
                $today_checkin = true;
                $sa_description = $student_attendance->sa_description;
            }

            if ($today_checkin && $student_attendance->sa_out_time != null) {
                $today_checkout = true;
            }
        }


        return response()->json([
            'today_checkin' => $today_checkin,
            'today_checkout' => $today_checkout,
            'sa_description' => $sa_description,
        ]);
    }
}
