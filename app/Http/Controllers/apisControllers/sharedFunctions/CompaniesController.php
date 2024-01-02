<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function getAllCompanies(){
        $companies = Company::paginate(10);
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
