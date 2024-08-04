<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use App\Models\CriteriaModel;
use App\Models\EvaluationCriteriaModel;
use App\Models\EvaluationsModel;
use App\Models\EvaluationTypesModel;
use App\Models\Role;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index()
    {
        $data = EvaluationsModel::with('evaluation_type')->orderBy('e_id','desc')->get();
        return view('project.admin.evaluations.index',['data'=>$data]);
    }

    public function add()
    {
        $evaluation_type = EvaluationTypesModel::get();
        $roles = Role::get();
        return view('project.admin.evaluations.add',['evaluation_type'=>$evaluation_type , 'roles'=>$roles]);
    }

    public function create(Request $request)
    {
        $data = new EvaluationsModel();
        $data->e_type_id = $request->e_type_id;
        $data->e_title = $request->e_title;
        $data->e_status = 1;
        $data->e_evaluator_role_id = EvaluationTypesModel::where('et_id',$request->e_type_id)->first()->et_evaluator_role_id;
        $data->e_start_time = $request->e_start_time;
        $data->e_end_time = $request->e_end_time;
        if ($data->save()){
            return redirect()->route('admin.evaluations.evaluation_criteria',['id'=>$data->e_id])->with(['success' => 'تم انشاء التقييم بنجاح']);
        }
    }

    public function edit($id)
    {
        $data = EvaluationsModel::find($id);
        $evaluation_type = EvaluationTypesModel::get();
        $roles = Role::get();
        $evaluation_criteria = EvaluationCriteriaModel::where('ec_evaluation_id')->first();
        return view('project.admin.evaluations.edit', ['data'=>$data , 'evaluation_type'=>$evaluation_type , 'roles'=>$roles , 'evaluation_criteria'=>$evaluation_criteria]);
    }

    public function update(Request $request)
    {
        $data = EvaluationsModel::where('e_id',$request->id)->first();
        $data->e_type_id = $request->e_type_id;
        $data->e_title = $request->e_title;
        $data->e_status = 1;
        $data->e_evaluator_role_id = $request->e_evaluator_role_id;
        $data->e_start_time = $request->e_start_time;
        $data->e_end_time = $request->e_end_time;
        if ($data->save()){
            return redirect()->route('admin.evaluations.index')->with(['success' => 'تم تعديل التقييم بنجاح']);
        }
    }

    public function list_criteria_ajax(Request $request)
    {
        $data = CriteriaModel::get();
        return response()->json([
            'success' => true,
            'view' => view('project.admin.evaluations.ajax.criteria_ajax',['data'=>$data])->render()
        ]);
    }

    public function list_evaluation_criteria_ajax(Request $request)
    {
        $data = EvaluationCriteriaModel::where('ec_evaluation_id',$request->evaluation_id)->get();
        return response()->json([
            'success' => true,
            'view' => view('project.admin.evaluations.ajax.criteria_evaluation_ajax',['data'=>$data])->render()
        ]);
    }

    public function add_evaluation_criteria_ajax(Request $request)
    {
        $check_if_found = EvaluationCriteriaModel::where('ec_evaluation_id',$request->evaluation_id)->where('ec_criteria_id',$request->criteria_id)->first();
        if (empty($check_if_found)){
            $data = new EvaluationCriteriaModel();
            $data->ec_evaluation_id = $request->evaluation_id;
            $data->ec_criteria_id = $request->criteria_id;
            if ($data->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'تم انشاء المعيار بنجاح'
                ]);
            }
        }
    }

    public function delete_evaluation_criteria_ajax(Request $request)
    {
        $data = EvaluationCriteriaModel::with('criteria')->where('ec_id',$request->ec_id)->first();
        if ($data->delete()){
            return response()->json([
                'success' => true,
                'message' => 'تم حذف البيانات بنجاح'
            ]);
        }
    }

    public function evaluation_criteria($id)
    {
        $data = EvaluationCriteriaModel::where('ec_evaluation_id',$id)->get();
        return view('project.admin.evaluations.evaluation_criteria',['data'=>$data , 'id'=>$id]);
    }
}
