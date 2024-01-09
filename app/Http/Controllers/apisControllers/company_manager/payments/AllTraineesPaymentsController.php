<?php

namespace App\Http\Controllers\apisControllers\company_manager\payments;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllTraineesPaymentsController extends Controller
{
        // all trainees payment in the manager's company
        public function getAllTraineesPayments(Request $request)
        {
            $manager_id = auth()->user()->u_id;
            $company_id = Company::where('c_manager_id', $manager_id)->pluck('c_id')->first();
            $payments = Payment::where('p_company_id', $company_id)
            ->paginate(7);
            // ->get();

            $payments->getCollection()->transform(function($payment) use($manager_id){
                $payment->inserted_by_name = User::where('u_id', $manager_id)->pluck('name')->first();
                $payment->student_name = User::where('u_id', $payment->p_student_id)->pluck('name')->first();
                // $payment->student_number = User::where('u_id', $payment->p_student_id)->pluck('u_username')->first();
                $payment->student_email = User::where('u_id', $payment->p_student_id)->pluck('email')->first();
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
}
