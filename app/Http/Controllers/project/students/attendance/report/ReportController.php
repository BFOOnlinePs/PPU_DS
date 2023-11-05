<?php

namespace App\Http\Controllers\Project\Students\Attendance\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentReport;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function edit($sa_id)
    {
        $student_report = new StudentReport;
        $student_report->sr_student_attendance_id = $sa_id;
        $student_report = StudentReport::where('sr_student_attendance_id', $sa_id)->first();
        return view('project.student.report.edit' , ['student_report' => $student_report]);
    }
    public function submit(Request $request)
    {
        $student_report = StudentReport::find($request->sr_id);
        $student_report->sr_report_text = $request->sr_report_text;
        $student_report->sr_submit_latitude = $request->latitude;
        $student_report->sr_submit_longitude = $request->longitude;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . uniqid();
            $file->storeAs('student_reports', $filename, 'public');
            $student_report->sr_attached_file = $filename;
        }
        if($student_report->save()) {
            return redirect()->back()->with('success', 'تم تسليم التقرير بنجاح');
        }
    }
    public function upload(Request $request)
    {
        $student_report = StudentReport::find($request->input('sr_id'));
        $filename = null;
        if ($request->hasFile('input-file')) {
            $file = $request->file('input-file');
            $filename = time() . '_' . uniqid();
            $file->storeAs('student_reports', $filename, 'public');
            $student_report->sr_attached_file =  $filename;
        }
        if($student_report->save()) {
            return response()->json(['newHref' => $filename]);
        }
    }
    public function remove_file(Request $request)
    {
        $student_report = StudentReport::find($request->input('sr_id'));
        Storage::delete('public/student_reports/' . $student_report->sr_attached_file);
        $student_report->sr_attached_file = null;
        if($student_report->save()) {
            return response()->json([]);
        }
    }
}
