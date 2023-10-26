<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentReportController extends Controller
{
    // to add student report for the current student
    public function studentSubmitNewReport(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'sr_student_attendance_id' => 'required|exists:students_attendance,sa_id',
            'sr_report_text' => 'required',
            // 'sr_attached_file' => 'nullable|file|mimetypes:image/jpeg,image/png,image/svg+xml,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet,application/vnd.oasis.opendocument.presentation,audio/mpeg,video/mp4,text/plain,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'sr_attached_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,mp3,mp4,csv,xlsx', // .txt accept other things
            'sr_submit_longitude' => 'required|string',
            'sr_submit_latitude' => 'required|string',
        ],[
            'sr_student_attendance_id.required' => 'يجب ان يكون الطالب قد سجل دخوله',
            'sr_report_text.required' => 'يجب ادخال نص التقرير',
            'sr_submit_longitude.required' => 'يجب ادخال الموقع',
            'sr_submit_latitude.required' => 'يجب ادخال الموقع',
            'sr_attached_file.mimes' =>'صيغة الملف غير مدعومة، جرب ملفًا آخر',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
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
