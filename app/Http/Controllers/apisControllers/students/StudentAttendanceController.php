<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\StudentCompany;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

// we depend on Gaza time: Asia/Gaza
class StudentAttendanceController extends Controller
{
    public function studentCheckIn(Request $request)
    {
        $student_in_company = StudentCompany::where('sc_id', $request->input('sa_student_company_id'))
            ->where('sc_student_id', auth()->user()->u_id)->first();

        if (!$student_in_company) {
            return response()->json([
                'status' => false,
                'message' => 'not authenticated',
            ]);
        }

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

            if ($lastCheckInDate === $today && $latestCheckIn->sa_out_time == null) {
                return response()->json(['message' => 'تم تسجيل الحضور اليوم من قبل']);
            }
        }

        $studentCheckIn = StudentAttendance::create([
            'sa_student_id' => auth()->user()->u_id,
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
            return response()->json(['message' => 'قم بتسجيل الدخول اولا']);
        }

        if ($latestCheckIn) {
            $lastCheckInDate = Carbon::parse($latestCheckIn->sa_in_time)->toDateString();
            $today = Carbon::now('Asia/Gaza')->toDateString();

            if ($lastCheckInDate !== $today) {
                return response()->json(['message' => 'قم بتسجيل الدخول اولا']);
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
        $student_company_id = $request->input('sa_student_company_id');
        $student_attendance = StudentAttendance::where('sa_student_id', auth()->user()->u_id)
            ->where('sa_student_company_id', $student_company_id)
            ->latest()
            ->first();

        $student_attendance_in_all_companies = StudentAttendance::where('sa_student_id', auth()->user()->u_id)
            ->latest()
            ->first();

        $today = Carbon::now('Asia/Gaza')->toDateString();

        $today_attendance = StudentAttendance::where('sa_student_company_id', $student_company_id)
            ->whereDate('sa_in_time', $today)
            // ->whereDoesntHave('report')
            ->get();

        // if last check in is today and different sc_id and did not checked out
        // then he can not checkin in different training (return true true)
        if ($student_attendance_in_all_companies) {
            $lastCheckInAllCompaniesDate = Carbon::parse($student_attendance_in_all_companies->sa_in_time)->toDateString();
            if (
                $lastCheckInAllCompaniesDate === $today
                && $student_attendance_in_all_companies->sa_out_time == null
                && $student_attendance_in_all_companies->sa_student_company_id != $request->input('sa_student_company_id')
            ) {
                return response()->json([
                    'today_checkin' => true,
                    'today_checkout' => true,
                    'sa_description' => null,
                    'today_attendance' =>$today_attendance
                ]);
            }
        }

        $today_checkin = false;
        $today_checkout = false;
        $sa_description = null;

        if ($student_attendance) {
            $lastCheckInDate = Carbon::parse($student_attendance->sa_in_time)->toDateString();

            if ($lastCheckInDate === $today) {
                $today_checkin = true;
                $sa_description = $student_attendance->sa_description;
            }

            if ($today_checkin && $student_attendance->sa_out_time != null) {
                $today_checkout = true;
            }

            if ($today_checkin && $today_checkout) {
                $today_checkin = false;
                $today_checkout = false;
                $sa_description = null;
            }
        }

        return response()->json([
            'today_checkin' => $today_checkin,
            'today_checkout' => $today_checkout,
            'sa_description' => $sa_description,
            'today_attendance' =>$today_attendance
        ]);
    }
}
