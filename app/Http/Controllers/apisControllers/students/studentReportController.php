<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentReportController extends Controller
{
    // to add student report for the current student
    public function add(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'sr_student_attendance_id' => 'required|exists:students_attendance,sa_id',
            'sr_report_text' => 'required',
            'sr_attached_file' => 'nullable|file',
            'sr_submit_longitude' => 'required|string',
            'sr_submit_latitude' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'الرجاء التأكد من ادخال جميع المعلومات'
            ], 200);
        }



        //  $reportUrl = asset('storage/' . $folderPath . '/' . $fileName);

        // return response()->json([
        //     'reportUrl' => $reportUrl,
        // ]);
        $studentReport = StudentReport::create([
            'sr_student_attendance_id' => $request->input('sr_student_attendance_id'),
            'sr_report_text' => $request->input('sr_report_text'),
            'sr_student_id' => auth()->user()->u_id,
            'sr_submit_longitude' => $request->input('sr_submit_longitude'),
            'sr_submit_latitude' => $request->input('sr_submit_latitude'),
        ]);

        if ($request->hasFile('sr_attached_file')) {
            $file = $request->file('sr_attached_file');
            $folderPath = 'student_reports';
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
            $request->file('sr_attached_file')->storeAs($folderPath, $fileName, 'public');

            $studentReport->update([
                'sr_attached_file' => $fileName,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم تسليم التقرير بنجاح',
            'student_report' => $studentReport,
        ], 200);
    }
}
