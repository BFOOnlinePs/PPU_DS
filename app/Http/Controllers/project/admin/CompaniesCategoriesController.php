<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use App\Models\CompaniesCategory;
use Illuminate\Http\Request;

class CompaniesCategoriesController extends Controller
{
    public function index(){
        $data = CompaniesCategory::with('companies')->get();
        return view('project.admin.companies_categories.index',['data'=>$data]);
    }
}
