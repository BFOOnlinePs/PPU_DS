<?php

namespace App\Http\Controllers\project\company_manager\records;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\StudentAttendance;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
    public function index()
    {
        return view('project.company_manager.records.index' , ['records' => null]);
    }
    public function search(Request $request)
    {
        $company_id = Company::where('c_manager_id', auth()->user()->u_id)
                            ->pluck('c_id')
                            ->first();
        $students_company = StudentCompany::where('sc_company_id', $company_id)
                                        ->where('sc_status', 1)
                                        ->pluck('sc_student_id')
                                        ->toArray();
        $records = StudentAttendance::whereIn('sa_student_id', $students_company)
                                    ->orderBy('created_at', 'desc')
                                    ->whereBetween(DB::raw('DATE(sa_in_time)'), [$request->from, $request->to]) // Filter by date range (ignoring time)
                                    ->paginate(5);
        if($request->searchByName !== null)
        {
            $users_id = User::where('name', 'like', '%' . $request->searchByName . '%')
                        ->pluck('u_id')
                        ->toArray();
            $records = StudentAttendance::whereIn('sa_student_id', $students_company)
                                    ->whereIn('sa_student_id' , $users_id)
                                    ->whereBetween(DB::raw('DATE(sa_in_time)'), [$request->from, $request->to]) // Filter by date range (ignoring time)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(5);
        }
        $view = view('project.company_manager.records.ajax.foreachRecordsList' , ['records' => $records])->render();
        return Response::json(['html' => $view , 'nextPageUrl' => $records->nextPageUrl()]);
    }

}
