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

    public function create(Request $request){
        $CompaniesCategory = new CompaniesCategory();
        $CompaniesCategory->cc_name = $request->cc_name;
        if($CompaniesCategory->save()){
            $data = CompaniesCategory::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.companies_categories.ajax.companies_categoriesList',['data'=>$data])->render(),
            ]);
        }
    }

    public function update(Request $request){
        $CompaniesCategory = CompaniesCategory::where('cc_id',$request->cc_id)->first();
        $CompaniesCategory->cc_name = $request->cc_name;
        if($CompaniesCategory->save()){
            $data = CompaniesCategory::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.companies_categories.ajax.companies_categoriesList',['data'=>$data])->render(),
            ]);
        }
    }
}
