<?php

namespace App\Http\Controllers\apisControllers\company_manager\company_trainees;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use App\Models\StudentAttendance;
use App\Models\StudentReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class CompanyTrainees extends Controller
{
    // get the trainees in the company (branch) of a manager
    public function getTrainees(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manager_id' => 'required',
        ], [
            'manager_id.required' => 'الرجاء ارسال رقم مدير الفرع'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        };

        $trainees = User::where('u_id', $request->input('manager_id'))
            ->with('managerOf.studentCompanies.users')
            ->get();

        // this works
        // ->pluck('managerOf.studentCompanies.*')
        // ->flatten()
        // ->sortByDesc('created_at')
        // ->values();

        // and this works as well
        // to get only the studentCompanies list inside the managerOf
        // (add .users if you want the users inside the studentCompanies as well)
        $trainees = $trainees->pluck('managerOf.studentCompanies.*')->flatten();

        // Filter out null values
        $trainees = $trainees->filter(function ($item) {
            return !is_null($item);
        });

        // for order
        $trainees = $trainees->sortByDesc('created_at')->values();

        // Manually paginate the collection
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentPageItems = $trainees->forPage($currentPage, $perPage);
        $paginatedTrainees = new LengthAwarePaginator(
            $currentPageItems->values(),
            $trainees->count(),
            $perPage,
            $currentPage
        );

        return response()->json([
            'pagination' => [
                'current_page' => $paginatedTrainees->currentPage(),
                'last_page' => $paginatedTrainees->lastPage(),
                'per_page' => $paginatedTrainees->perPage(),
                'total_items' => $paginatedTrainees->total(),
            ],
            'trainees' => $paginatedTrainees->items(),

        ], 200);
    }

    // get the student/trainee attendance in training
    public function getTraineeAttendanceLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trainee_id' => 'required',
            'student_company_id' => 'required'
        ], [
            'trainee_id.required' => 'الرجاء ارسال رقم الطالب/ المتدرب',
            'student_company_id.required' => 'الرجاء ارسال رقم التدريب'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        };

        $allTraineeAttendanceLog = StudentAttendance::where('sa_student_id', $request->input('trainee_id'))
            ->where('sa_student_company_id', $request->input('student_company_id'))
            // ->with('training') //i may need: training.company
            ->orderBy('created_at', 'desc')
            ->paginate(6); // number of items each page

        if (!$allTraineeAttendanceLog) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم تسحيل اي حضور بعد'
            ]);
        }

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $allTraineeAttendanceLog->currentPage(),
                'last_page' => $allTraineeAttendanceLog->lastPage(),
                'per_page' => $allTraineeAttendanceLog->perPage(),
                'total_items' => $allTraineeAttendanceLog->total(),
            ],
            'trainee_attendance' => $allTraineeAttendanceLog->items(),

        ], 200);
    }

    // get the student/trainee reports in training
    public function getTraineeReportsLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trainee_id' => 'required',
            'student_company_id' => 'required'
        ], [
            'trainee_id.required' => 'الرجاء ارسال رقم الطالب/ المتدرب',
            'student_company_id.required' => 'الرجاء ارسال رقم التدريب'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        };

        $sc_id = $request->input('student_company_id');

        $allStudentReportsLog = StudentReport::where('sr_student_id', $request->input('trainee_id'))
            ->whereHas('attendance', function ($query) use ($sc_id) {
                $query->where('.sa_student_company_id', $sc_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        if (!$allStudentReportsLog) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم تسليم اي تقرير بعد'
            ]);
        }

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $allStudentReportsLog->currentPage(),
                'last_page' => $allStudentReportsLog->lastPage(),
                'per_page' => $allStudentReportsLog->perPage(),
                'total_items' => $allStudentReportsLog->total(),
            ],
            'trainee_reports' => $allStudentReportsLog->items(),

        ], 200);
    }

    // get attendance of all trainees
    public function getAllTraineesAttendanceLog(Request $request)
    {
        $traineesAttendance = CompanyBranch::where('b_manager_id', auth()->user()->u_id)
            ->with('studentCompanies.attendance.user')
            ->get()
            ->pluck('studentCompanies.*.attendance')
            ->flatten()
            ->sortByDesc('created_at')
            ->values();

        // Manually paginate the collection
        $perPage = 8;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $traineesAttendance->forPage($currentPage, $perPage);
        $paginatedTraineesAttendance = new LengthAwarePaginator(
            $currentPageItems->values(),
            $traineesAttendance->count(),
            $perPage,
            $currentPage
        );

        return response()->json([
            'pagination' => [
                'current_page' => $paginatedTraineesAttendance->currentPage(),
                'last_page' => $paginatedTraineesAttendance->lastPage(),
                'per_page' => $paginatedTraineesAttendance->perPage(),
                'total_items' => $paginatedTraineesAttendance->total(),
            ],
            'trainees_attendance' => $paginatedTraineesAttendance->items(),

        ], 200);
    }

    // get reports of all trainees
    public function getAllTraineesReportsLog(Request $request)
    {
        $traineesReports = CompanyBranch::where('b_manager_id', auth()->user()->u_id)
            ->with('studentCompanies.attendance.report.user')
            ->get()
            ->pluck('studentCompanies.*.attendance.*.report')
            ->flatten()
            ->filter() // filter the null
            ->sortByDesc('created_at')
            ->values();

        // Manually paginate the collection
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $traineesReports->forPage($currentPage, $perPage);
        $paginatedTraineesReports = new LengthAwarePaginator(
            $currentPageItems->values(),
            $traineesReports->count(),
            $perPage,
            $currentPage
        );

        return response()->json([
            'pagination' => [
                'current_page' => $paginatedTraineesReports->currentPage(),
                'last_page' => $paginatedTraineesReports->lastPage(),
                'per_page' => $paginatedTraineesReports->perPage(),
                'total_items' => $paginatedTraineesReports->total(),
            ],
            'trainees_reports' => $paginatedTraineesReports->items(),

        ], 200);
    }
}
