<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use App\Models\FAQCategoryModel;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{

    public function index(){
        return view('project.admin.FAQCategory.index');
    }


    public function list_faq_category_ajax(Request $request){
        $data = FAQCategoryModel::query();
        $data = $data->get();
        return response()->json([
            'success' => 'true',
            'view' => view('project.admin.FAQCategory.ajax.list_faq_category_ajax',['data'=>$data])->render(),
        ]);
    }

    public function create(Request $request){
        $data = new FAQCategoryModel();
        $data->c_name = $request->c_name;
        if($data->save()){
           return redirect()->back();
        }
    }

    public function update(Request $request){
        $data = FAQCategoryModel::where('c_id',$request->id)->first();
        $data->c_name = $request->c_name;
        if($data->save()){
            return redirect()->back();
        }
    }
}
