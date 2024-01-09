<?php

namespace App\Http\Controllers\apisControllers\students\payments;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentPaymentsController extends Controller
{
    // for current student
    public function getAllStudentPayments()
    {
        $student_id = auth()->user()->u_id;
        $user = User::where('u_id', $student_id)->where('u_role_id', 2)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الطالب غير موجود',
            ]);
        }

        $payments = Payment::where('p_student_id', $student_id)
            ->paginate(7);
        // ->get();

        $payments->getCollection()->transform(function ($payment) {
            $payment->inserted_by_name = User::where('u_id', $payment->p_inserted_by_id)->pluck('name')->first();
            $payment->company_name = Company::where('c_id', $payment->p_company_id)->pluck('c_name')->first();
            $payment->currency_symbol = Currency::where('c_id', $payment->p_currency_id)->pluck('c_symbol')->first();
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

    // the status should be: 0 or 1
    // 0 default
    // 1 confirmed by the student
    public function studentChangePaymentStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required',
            'payment_status' => 'required',
        ], [
            'payment_status.required' => 'الرجاء ارسال حالة الدفعة',
            'payment_id.required' => 'الرجاء ارسال رقم الدفعة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                "message" => $validator->errors()->first(),
            ]);
        }

        $payment = Payment::where('p_id', $request->input('payment_id'))->first();
        if (!$payment) {
            return response()->json([
                'status' => false,
                "message" => 'رقم الدفعة غير موجود',
            ]);
        }

        if ($payment->p_student_id != auth()->user()->u_id) {
            return response()->json([
                'status' => false,
                "message" => 'غير مصرح به، يجب ان يقوم الطالب نفسه بتأكيد الدفعة',
            ]);
        }

        $payment->update([
            'p_status' => $request->input('payment_status')
        ]);

        return response()->json([
            'status' => true,
            "message" => 'تم تأكيد الدفعة بنجاح',
            'payment' => $payment
        ]);
    }
}
