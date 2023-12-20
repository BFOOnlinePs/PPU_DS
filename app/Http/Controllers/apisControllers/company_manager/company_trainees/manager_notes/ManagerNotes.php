<?php

namespace App\Http\Controllers\apisControllers\company_manager\company_trainees\manager_notes;

use App\Http\Controllers\Controller;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagerNotes extends Controller
{
    public function managerAddOrEditReportNote(Request $request){
        $validator = Validator::make($request->all(), [
            'sr_id' => 'required',
            'sr_notes_company' => 'required',
        ], [
            'sr_id.required' => 'يجب ارسال رقم التقرير',
            'sr_notes_company.required' => 'الرجاء كتابة التقرير',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $report = StudentReport::where('sr_id', $request->input('sr_id'))->first();

        if(!$report){
            return response()->json([
                'status' => false,
                'message' => 'رقم التقرير غير موجود',
            ], 200);
        }

        // update since the report row is exists
        $report->update([
            'sr_notes_company' => $request->input('sr_notes_company'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم اضافة الملاحظة بنجاح',
            // 'report' => $report
        ]);
    }


    // i may delete it
    public function managerEditNote(Request $request){
        $validator = Validator::make($request->all(), [
            'sr_id' => 'required',
            'sr_notes_company' => 'required',
        ], [
            'sr_id.required' => 'يجب ارسال رقم التقرير',
            'sr_notes_company.required' => 'الرجاء كتابة التقرير',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $report = StudentReport::where('sr_id', $request->input('sr_id'))->first();

        if(!$report){
            return response()->json([
                'status' => false,
                'message' => 'رقم التقرير غير موجود',
            ], 200);
        }

        $report->update([
            'sr_notes_company' => $request->input('sr_notes_company'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم اضافة الملاحظة بنجاح',
            'report' => $report
        ]);
    }
}
