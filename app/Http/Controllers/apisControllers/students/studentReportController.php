<?php

namespace App\Http\Controllers\apisControllers\students;

use App\Http\Controllers\Controller;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentReportController extends Controller
{
    // to add student report for the current student
    public function add(Request $request){
        $validator  = Validator::make($request->all(), [
            'sr_student_attendance_id' => 'required|exists:students_attendance,sa_id',
            'sr_report_text' => 'required',
            'sr_attached_file' => 'required|file',
            'sr_submit_longitude' => 'required|string',
            'sr_submit_latitude' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'الرجاء التأكد من ادخال جميع المعلومات'
            ], 200);
        }

        $file = $request->file('sr_attached_file');
        // $fileName = $file->getClientOriginalName();
        // $data = file_get_contents($file);


        $folderPath = 'student_reports';

         // Generate a unique file name
         $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();

         // Store the image in the specified folder
         $request->file('sr_attached_file')->storeAs($folderPath, $fileName, 'public');

         // Build and return the URL to the saved image | path
         $reportUrl = asset('storage/' . $folderPath . '/' . $fileName);

        // DB::table('files')->insert([
        //     'name' => $file->getClientOriginalName(),
        //     'content_type' => $file->getMimeType(),
        //     'data' => $data,
        // ]);

        $studentReport = StudentReport::create([
            'sr_student_attendance_id' => $request->input('sr_student_attendance_id'),
            'sr_report_text' => $request->input('sr_report_text'),
            'sr_attached_file' => $fileName,
            'sr_student_id' => auth()->user()->u_id,
            'sr_submit_longitude' => $request->input('sr_submit_longitude'),
            'sr_submit_latitude' => $request->input('sr_submit_latitude'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تسليم التقرير بنجاح',
            'student_report' => $studentReport,
        ], 200);



    }
}
