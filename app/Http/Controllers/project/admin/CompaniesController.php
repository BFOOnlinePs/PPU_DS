<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    //
    public function index()
    {
        $data = Company::with('manager','companyCategories')->get();
        //return $data;
        return view('project.admin.companies.index',['data'=>$data]);
    }

    public function company()
    {
        //$data = Company::with('manager','companyCategories')->get();
        //return $data;
        return view('project.admin.companies.company');
    }
}
