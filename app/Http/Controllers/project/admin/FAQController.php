<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use App\Models\FAQCategoryModel;
use App\Models\FAQModel;
use App\Models\Role;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(){
        return view('project.admin.FAQ.index');
    }

    public function list_faq_ajax(Request $request){
        $data = FAQModel::query();
        $data = $data->get();
        return view('project.admin.FAQ.ajax.list_faq_ajax' , ['data'=>$data]);
    }

    public function add(){
        $roles = Role::get();
        $categories = FAQCategoryModel::get();
        return view('project.admin.FAQ.add' , ['roles'=>$roles , 'categories'=>$categories]);
    }
}
