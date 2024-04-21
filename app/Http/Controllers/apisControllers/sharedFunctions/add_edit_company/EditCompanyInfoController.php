<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\add_edit_company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// this edit company to update status and capacity (not from stepper)

class EditCompanyInfoController extends Controller
{
    public function updateCompanyStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
            'company_status' => 'required|in:0,1',
        ], [
            'company_id.required' => 'you have to send the company id',
            'company_id.exists' => 'company dose not exist in database',
            'company_status.required' => 'you have to send the new company status',
            'company_status.in' => 'company status should be 0 or 1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $company = Company::where('c_id', $request->input(['company_id']))->first();

        $company->update([
            'c_status' => $request->input(['company_status']),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'company status updated successfully',
            'company' => $company,
        ]);
    }

    public function updateCompanyCapacity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,c_id',
            'company_capacity' => 'required|integer',
        ], [
            'company_id.required' => 'you have to send the company id',
            'company_id.exists' => 'company dose not exist in database',
            'company_capacity.required' => 'you have to send the new company capacity',
            'company_capacity.integer' => 'company capacity should be integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $company = Company::where('c_id', $request->input(['company_id']))->first();

        $company->update([
            'c_capacity' => $request->input(['company_capacity']),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'company capacity updated successfully',
            'company' => $company,
        ]);
    }
}
