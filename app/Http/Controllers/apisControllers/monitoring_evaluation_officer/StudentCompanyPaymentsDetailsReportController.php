<?php

namespace App\Http\Controllers\apisControllers\monitoring_evaluation_officer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Payment;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentCompanyPaymentsDetailsReportController extends Controller
{
    public function getTrainingPaymentsDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_company_id' => 'required|exists:students_companies,sc_id',
        ], [
            'student_company_id.required' => 'يجب ارسال رقم التدريب',
            'student_company_id.exists' => 'رقم التدريب غير موجود',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $student_company_id = $request->input('student_company_id');

        $student_company = StudentCompany::where('sc_id', $student_company_id)->first();
        $student_name = User::where('u_id', $student_company->sc_student_id)->pluck('name')->first();
        $company_name = Company::where('c_id', $student_company->sc_company_id)->pluck('c_name')->first();

        $training_payments_with_currency = Payment::where('p_student_company_id', $student_company_id)
            ->with(['currency' => function ($query) {
                $query->select('c_id', 'c_symbol');
            }])
            ->get();


        return response()->json([
            'status' => true,
            'student_name' => $student_name,
            'company_name' => $company_name,
            'training_payments' => $training_payments_with_currency
        ]);
    }
}
