<?php

namespace App\Http\Controllers\apisControllers\company_manager\company_trainees;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\StudentReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyTrainees extends Controller
{
    // it needs pagination and order desc

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
            // ->orderBy('managerOf.studentCompanies.created_at', 'desc')
            ->get();

        // to get only the users list inside the studentCompanies
        // (remove .users if you want the studentCompanies as well)
        $trainees = $trainees->pluck('managerOf.studentCompanies.*')->flatten();


        if ($trainees->isEmpty()) {
            return response()->json([
                'message' => 'لا يوجد طلاب مسجلين حاليا'
            ], 200);
        }

        return response()->json([
            'trainees' => $trainees,
            // 'pagination' => [
            //     'current_page' => $trainees->currentPage(),
            //     'last_page' => $trainees->lastPage(),
            //     'per_page' => $trainees->perPage(),
            //     'total_items' => $trainees->total(),
            // ],
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

        $allStudentAttendanceLog = StudentAttendance::where('sa_student_id', $request->input('trainee_id'))
            ->where('sa_student_company_id', $request->input('student_company_id'))
            // ->with('training') //i may need: training.company
            ->orderBy('created_at', 'desc')
            ->paginate(6); // number of items each page

        if (!$allStudentAttendanceLog) {
            return response()->json([
                'status' => false,
                'message' => 'لم يتم تسحيل اي حضور بعد'
            ]);
        }

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $allStudentAttendanceLog->currentPage(),
                'last_page' => $allStudentAttendanceLog->lastPage(),
                'per_page' => $allStudentAttendanceLog->perPage(),
                'total_items' => $allStudentAttendanceLog->total(),
            ],
            'trainee_attendance' => $allStudentAttendanceLog->items(),

        ], 200);
    }

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

        $allStudentReportsLog = StudentReport::where('sr_student_id', $request->input('trainee_id'))
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
}
