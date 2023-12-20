<?php

namespace App\Http\Controllers\apisControllers\supervisors;

use App\Http\Controllers\Controller;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// for supervisor notes on student report

class SupervisorNotesController extends Controller
{
    public function supervisorAddOrEditReportNote(Request $request){
        $validator = Validator::make($request->all(), [
            'sr_id' => 'required',
            'sr_notes_supervisor' => 'required',
        ], [
            'sr_id.required' => 'يجب ارسال رقم التقرير',
            'sr_notes_supervisor.required' => 'الرجاء كتابة التقرير',
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
            'sr_notes' => $request->input('sr_notes_supervisor'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم اضافة الملاحظة بنجاح',
        ]);
    }
}
