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
        if($request->filled('faq_question_search')){
            $data = $data->where('faq_question','like','%'.$request->faq_question_search.'%');
        }
        $data = $data->get();
        return response()->json([
            'success' => 'true',
            'view' => view('project.admin.FAQ.ajax.list_faq_ajax',['data'=>$data])->render(),
        ]);
    }

    public function add(){
        $roles = Role::get();
        $categories = FAQCategoryModel::get();
        return view('project.admin.FAQ.add' , ['roles'=>$roles , 'categories'=>$categories]);
    }

    public function create(Request $request){
        $data = new FAQModel();
        $data->faq_question = $request->faq_question;
        $data->faq_web_answer = $request->faq_web_answer;
        $data->faq_mobile_answer = $request->faq_mobile_answer;
        $data->faq_added_by = auth()->user()->u_id;
        $data->faq_target_role_ids = json_encode($request->faq_target_role_ids);
        $data->faq_category_ids = json_encode($request->faq_category_ids);
        if($data->save()){
            return redirect()->back()->with(['success'=>'تم اضافة الاسئلة بنجاح']);
        }
    }

    public function edit($id){
        $data = FAQModel::find($id);
        $roles = Role::get();
        $categories = FAQCategoryModel::get();
        return view('project.admin.FAQ.edit' , ['data'=>$data , 'roles'=>$roles , 'categories'=>$categories]);
    }

    public function update(Request $request){
        $data = FAQModel::find($request->faq_id);
        $data->faq_question = $request->faq_question;
        $data->faq_web_answer = $request->faq_web_answer;
        $data->faq_mobile_answer = $request->faq_mobile_answer;
        $data->faq_added_by = auth()->user()->u_id;
        $data->faq_target_role_ids = json_encode($request->faq_target_role_ids);
        $data->faq_category_ids = json_encode($request->faq_category_ids);
        if($data->save()){
            return redirect()->back()->with(['success'=>'تم تعديل الاسئلة بنجاح']);
        }
    }
}
