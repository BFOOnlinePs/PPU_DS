<?php

namespace App\Http\Controllers\Project\Company_Manager\Students\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StudentAttendance;
use App\Models\StudentCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index($id)
    {
        $company = Company::where('c_manager_id' , auth()->user()->u_id)->first();
        $student_company = StudentCompany::where('sc_student_id', $id)
                                        ->where('sc_company_id', $company->c_id)
                                        ->where('sc_status', 1)
                                        ->pluck('sc_id')
                                        ->toArray();
        $student_attendances = StudentAttendance::whereIn('sa_student_company_id', $student_company)
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(5);
        return view('project.company_manager.students.attendance.index' , ['student_attendances' => $student_attendances , 'id' => $id]);
    }
    public function index_ajax(Request $request)
    {
        $company = Company::where('c_manager_id' , auth()->user()->u_id)->first();
        $student_company = StudentCompany::where('sc_student_id', $request->student_id)
        ->where('sc_company_id', $company->c_id)
        ->where('sc_status', 1)
        ->pluck('sc_id')
        ->toArray();
        $student_attendances = StudentAttendance::whereIn('sa_student_company_id', $student_company)
                                                ->orderBy('created_at', 'desc')
                                                ->whereBetween(DB::raw('DATE(sa_in_time)'), [$request->from, $request->to]) // Filter by date range (ignoring time)
                                                ->paginate(5);
        $view = view('project.company_manager.students.attendance.includes.foreachAttendanceList' , ['student_attendances' => $student_attendances])->render();
        return Response::json(['html' => $view , 'nextPageUrl' => $student_attendances->nextPageUrl()]);
    }
}
