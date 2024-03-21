<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\all_students;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class all_students_attendance extends Controller
{
    public function getAllStudentsAttendance(Request $request)   {
        // $supervisorId = auth()->user()->u_id;
        // $supervisorMajorsIdList = MajorSupervisor::where('ms_super_id', $supervisorId)->pluck('ms_major_id');
        // $studentsIdList = User::where('u_role_id', 2)->whereIn('u_major_id', $supervisorMajorsIdList)->pluck('u_id');
        $studentsIdList = User::where('u_role_id', 2)->pluck('u_id');
        $allStudentsAttendance = StudentAttendance::whereIn('sa_student_id', $studentsIdList)
            ->with('user')->with('training.company')
            ->orderBy('created_at', 'desc')->get();

        $perPage = 8;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $allStudentsAttendance->forPage($currentPage, $perPage);
        $paginatedAllStudentsAttendance = new LengthAwarePaginator(
            $currentPageItems->values(),
            $allStudentsAttendance->count(),
            $perPage,
            $currentPage
        );

        return response()->json([
            'pagination' => [
                'current_page' => $paginatedAllStudentsAttendance->currentPage(),
                'last_page' => $paginatedAllStudentsAttendance->lastPage(),
                'per_page' => $paginatedAllStudentsAttendance->perPage(),
                'total_items' => $paginatedAllStudentsAttendance->total(),
            ],
            'students_attendance' => $paginatedAllStudentsAttendance->items(),

        ], 200);
    }
}
