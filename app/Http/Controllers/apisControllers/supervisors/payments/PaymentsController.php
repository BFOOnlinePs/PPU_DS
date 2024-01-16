<?php

namespace App\Http\Controllers\apisControllers\supervisors\payments;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function getStudentPayments(Request $request)
    {
        $student_id = $request->input('student_id');
        $user = User::where('u_id', $student_id)->where('u_role_id', 2)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الطالب غير موجود',
            ]);
        }

        $payments = Payment::where('p_student_id', $student_id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        // ->get();

        $payments->getCollection()->transform(function ($payment) {
            $payment->inserted_by_name = User::where('u_id', $payment->p_inserted_by_id)->pluck('name')->first();
            $payment->company_name = Company::where('c_id', $payment->p_company_id)->pluck('c_name')->first();
            $payment->currency_symbol = Currency::where('c_id', $payment->p_currency_id)->pluck('c_symbol')->first();

            $student_training = StudentCompany::where('sc_id', $payment->p_student_company_id)->first();

            $payment->training_status = $student_training->sc_status;
            $registration = Registration::where('r_id', $student_training->sc_registration_id)->first();
            $payment->semester = $registration->r_semester;
            $payment->year = $registration->r_year;
            return $payment;
        });


        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $payments->currentPage(),
                'last_page' => $payments->lastPage(),
                'per_page' => $payments->perPage(),
                'total_items' => $payments->total(),
            ],
            'payments' => $payments->items(),
        ]);
    }

    public function supervisorAddPaymentNote(Request $request){
        $payment_id = $request->input('payment_id');
        $payment = Payment::where('p_id', $payment_id)->first();
        if (!$payment) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الدفعة غير موجود',
            ]);
        }

        $payment->update([
            'p_supervisor_notes' => $request->input('supervisor_notes'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم اضافة الملاحظة بنجاح',
            'payment' => $payment
        ]);
    }
}
