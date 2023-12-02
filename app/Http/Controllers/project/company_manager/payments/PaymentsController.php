<?php

namespace App\Http\Controllers\Project\Company_Manager\Payments;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $company = Company::where('c_manager_id' , auth()->user()->u_id)->first();
        $payments = Payment::where('p_company_id', $company->c_id)
                            ->get();
        return view('project.company_manager.payments.index' , ['payments' => $payments]);
    }
}
