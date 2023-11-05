<?php

namespace App\Http\Controllers\Project\Students\Attendance;

use App\Http\Controllers\Controller;
use App\Models\StudentCompany;
use App\Models\StudentAttendance;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function ajax_company_from_to(Request $request)
    {
        $student_company = null;
        if($request->sc_id == null) {
            $student_company = StudentCompany::where('sc_student_id' , auth()->user()->u_id)
                                             ->where('sc_status', 1)
                                             ->with('company')
                                             ->pluck('sc_id')
                                             ->toArray();
        }
        else {
            $student_company = StudentCompany::where('sc_id' , $request->sc_id)
                                             ->where('sc_status', 1)
                                             ->with('company')
                                             ->pluck('sc_id')
                                             ->toArray();
        }
        $student_attendances = StudentAttendance::where('sa_student_id', auth()->user()->u_id)
                                                ->whereIn('sa_student_company_id', $student_company)
                                                ->get();
        $html = view('project.student.attendance.ajax.attendanceList' , ['student_attendances' => $student_attendances])->render();
        return response()->json(['html' => $html]);
    }
    public function index($id)
    {
        $student_company = StudentCompany::where('sc_id' , $id)->with('company')->get();
        $student_attendances = StudentAttendance::where('sa_student_id', $id)->get();

        $nowInHebron = Carbon::now('Asia/Gaza');
        $dateToday = $nowInHebron->toDateString();
        $date = StudentAttendance::selectRaw('DATE(sa_in_time) as sa_date')
                                    ->where('sa_student_id', $id)
                                    ->where('sa_in_time' , 'like' , $dateToday . '%')
                                    ->first();
        $lastDate = null;
        if(isset($date)) {
            $lastDate = $date->sa_date;
        }
        return view('project.student.attendance.index' , ['sc_id' => $id , 'student_company' => $student_company , 'student_attendances' =>  $student_attendances , 'date_today' => $dateToday , 'last_date' => $lastDate]);
    }
    public function index_for_specific_student($id)
    {
        $student_company = StudentCompany::where('sc_id' , $id)->with('company')->first();
        $student_attendances = StudentAttendance::where('sa_student_id', $student_company->sc_student_id)
                                                ->where('sa_student_company_id', $student_company->sc_id)
                                                ->get();
        $nowInHebron = Carbon::now('Asia/Gaza');
        $dateToday = $nowInHebron->toDateString();
        $date = StudentAttendance::selectRaw('DATE(sa_in_time) as sa_date')
                                    ->where('sa_student_id', $student_company->sc_student_id)
                                    ->where('sa_student_company_id', $student_company->sc_id)
                                    ->where('sa_in_time' , 'like' , $dateToday . '%')
                                    ->first();
        $lastDate = null;
        if(isset($date)) {
            $lastDate = $date->sa_date;
        }
        $student_companies = StudentCompany::where('sc_student_id' , auth()->user()->u_id)
                                            ->where('sc_status' , 1)
                                            ->with('company')
                                            ->get();
        $student_companies_id = StudentCompany::where('sc_student_id' , auth()->user()->u_id)
                                              ->where('sc_status' , 1)
                                              ->pluck('sc_id')
                                              ->toArray();
        $from_to = StudentAttendance::whereIn('sa_student_company_id' , $student_companies_id)
                                 ->where('sa_student_id' , auth()->user()->u_id)
                                 ->get();
        return view('project.student.attendance.index' , ['sc_id' => $id , 'student_company' => $student_company , 'student_attendances' =>  $student_attendances , 'date_today' => $dateToday , 'last_date' => $lastDate , 'student_companies' => $student_companies , 'from_to' => $from_to]);
    }
    public function create_attendance(Request $request)
    {
        $student_attendance = new StudentAttendance;
        $student_attendance->sa_student_id = $request->sa_student_id;
        $student_attendance->sa_student_company_id = $request->sa_student_company_id;
        $student_attendance->sa_start_time_latitude = $request->sa_start_time_latitude;
        $student_attendance->sa_start_time_longitude = $request->sa_start_time_longitude;
        $time_now = Carbon::now('Asia/Gaza'); // Time now
        $student_attendance->sa_in_time = $time_now;
        if($student_attendance->save()) {
            $student_attendances = StudentAttendance::where('sa_student_id', $request->sa_student_id)
                                                    ->where('sa_student_company_id', $request->sa_student_company_id)
                                                    ->get();
            $sa_id = StudentAttendance::where('sa_student_id', $request->sa_student_id)
                                      ->where('sa_student_company_id', $request->sa_student_company_id)
                                      ->where('sa_in_time' , $time_now)
                                      ->first();
            $student_report = new StudentReport;
            $student_report->sr_student_attendance_id = $sa_id->sa_id;
            $student_report->save();

            $html = view('project.student.attendance.ajax.attendanceList' , ['student_attendances' => $student_attendances])->render();
            return response()->json(['html' => $html]);
        }
    }
}
