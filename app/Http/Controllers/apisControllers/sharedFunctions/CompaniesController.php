<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\CompaniesCategory;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function getAllCompanies(){

        $companies = Company::orderBy('created_at', 'desc')->paginate(6);
        $companies->getCollection()->transform(function($company){
            $company->manager_name = User::where('u_id', $company->c_manager_id)->pluck('name')->first();
            $company->category_name = CompaniesCategory::where('cc_id', $company->c_category_id)->pluck('cc_name')->first();
            return $company;
        });

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $companies->currentPage(),
                'last_page' => $companies->lastPage(),
                'per_page' => $companies->perPage(),
                'total_items' => $companies->total(),
            ],
            'companies' => $companies->items()
        ]);
    }
}
