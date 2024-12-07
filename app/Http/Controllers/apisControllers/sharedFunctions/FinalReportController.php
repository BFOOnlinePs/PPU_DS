<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\FinalReportModel;
use App\Models\FinalReportsSubmissions;
use App\Models\Registration;
use App\Models\SystemSetting;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinalReportController extends Controller
{
    protected $fileUploadService;

    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
    }

    public function checkFinalReportStatus()
    {

        if (!$this->isSubmissionOpen()) {

            return response()->json(['is_open_and_valid' => false]);
        }

        $registrationId = $this->getRegistrationId();
        if (!$registrationId) {
            return response()->json(['is_open_and_valid' => false]);
        }

        return response()->json([
            'is_open_and_valid' => true,
            'registration_id' => $registrationId,
        ]);
    }

    private function isSubmissionOpen()
    {
        $systemSetting = SystemSetting::first();
        return $systemSetting->ss_report_status ?? false;
    }

    private function getRegistrationId()
    {
        $student = auth()->user();
        $systemSetting = SystemSetting::first();

        $registration = Registration::where('r_student_id', $student->u_id)
            ->where('r_semester', $systemSetting->ss_semester_type)
            ->where('r_year', $systemSetting->ss_year)
            ->first();

        return $registration?->r_id;
    }


    public function addFinalReport(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'registration_id' => 'required|exists:registration,r_id',
                'report_file' => 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
                'notes' => 'nullable',
            ],
            [
                'registration_id.required' => 'Registration ID is required.',
                'registration_id.exists' => 'Invalid Registration ID.',
                'report_file.mimes' => 'Only PDF, Word, Excel, Powerpoint documents are allowed.',
            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        if ($request->hasFile('report_file')) {
            $file = $request->file('report_file');
            $folderPath = 'final_reports';
            $new_file_name = $this->fileUploadService->uploadFile($file, $folderPath);

            $final_report = new FinalReportsSubmissions();
            $final_report->frs_registration_id = $request->input('registration_id');
            $final_report->frs_name = $new_file_name;
            $final_report->frs_real_name = $file->getClientOriginalName();
            $final_report->frs_notes = $request->input('notes');

            if ($final_report->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Final report added successfully.',
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to add final report.',
        ], 500);
    }
}
