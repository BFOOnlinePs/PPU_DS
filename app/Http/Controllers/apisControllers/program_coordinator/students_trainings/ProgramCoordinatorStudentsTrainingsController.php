<?php

namespace App\Http\Controllers\apisControllers\program_coordinator\students_trainings;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StudentCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramCoordinatorStudentsTrainingsController extends Controller
{
    // training places for all students, with number of student in each company
    public function getStudentsCompanies()
    {
        // to get number of students in each company
        $companies = StudentCompany::groupBy('sc_company_id')
            ->select('sc_company_id', DB::raw('count(distinct sc_student_id) as student_count'))
            ->paginate(10);

        // to get the whole Company Model instead of only the id
        $companies->getCollection()->Transform(function ($company) {
            $company_model = Company::where('c_id', $company->sc_company_id)->first();
            $company_model->student_count = $company->student_count;
            return $company_model;
        });

        if ($companies->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'لا يوجد شركات حاليا'
            ]);
        }

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $companies->currentPage(),
                'last_page' => $companies->lastPage(),
                'per_page' => $companies->perPage(),
                'total_items' => $companies->total(),
            ],
            'companies' => $companies->items(),
        ]);
    }
}
