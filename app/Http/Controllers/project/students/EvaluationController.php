<?php

namespace App\Http\Controllers\project\students;

use App\Http\Controllers\Controller;
use App\Models\CriteriaModel;
use App\Models\EvaluationsModel;
use App\Models\EvaluationSubmissionScoresModel;
use App\Models\EvaluationSubmissionsModel;
use App\Models\Registration;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index()
    {
        $data = EvaluationsModel::where('e_status',1)->where('e_evaluator_role_id',2)->get();
        return view('project.student.evaluation.index',['data'=>$data]);
    }

    public function details($id)
    {
        $criteria = CriteriaModel::get();
        $data = Registration::query();
        if (auth()->user()->u_role_id == 2){
            $data->where('r_student_id',auth()->user()->u_id)->where('supervisor_id' , '!=' , null);
        }
        if (auth()->user()->u_role_id == 10){
            $data->where('supervisor_id',auth()->user()->u_id);
        }
        if (auth()->user()->u_role_id == 6){
            $data->whereIn('r_id',function ($query){
                $query->select('sc_registration_id')->from('students_companies');
            });
        }
        $data = $data->get();
        foreach ($data as $index => $key) {
            $key->submission_status = EvaluationSubmissionsModel::where('es_registration_id',$key->r_id)->where('s_evaluation_id',$id)->where('e_evaluator_id',auth()->user()->u_id)->first();
        }
        return view('project.student.evaluation.details',['criteria'=>$criteria,'id'=>$id , 'data' => $data]);
    }

    public function evaluation_submission_page($registration_id , $evaluation_id)
    {
        $registration = Registration::where('r_id',$registration_id)->first();
        $evaluation = EvaluationsModel::where('e_id',$evaluation_id)->first();
        $criteria = CriteriaModel::get();
        return view('project.student.evaluation.evaluation_submission',['registration'=>$registration , 'evaluation'=>$evaluation , 'criteria'=>$criteria]);
    }

    public function list_user($user_id)
    {
        return view('project.student.evaluation.list_user',['user_id'=>$user_id]);
    }

    public function evaluation_submission_create(Request $request)
    {
        $check_if_submission = EvaluationSubmissionsModel::where('s_evaluation_id',$request->s_evaluation_id)->where('es_registration_id',$request->registration_id)->where('e_evaluator_id',auth()->user()->u_id)->first();
        if (empty($check_if_submission)){
            $criteria_score = 0;
            $data = new EvaluationSubmissionsModel();
            $data->s_evaluation_id = $request->s_evaluation_id;
            $data->e_evaluator_id = auth()->user()->u_id;
            $data->e_evaluatee_id = (auth()->user()->u_id == '10') ? Registration::where('r_id', $request->registration_id)->first()->supervisor_id : $data->e_evaluatee_id = Registration::where('r_id', $request->registration_id)->first()->r_student_id;
            $data->es_registration_id = $request->registration_id;
            $data->es_notes = $request->es_notes;
            if ($data->save()) {
                foreach ($request->criteria as $index => $score) {
                    $evaluation_submission_scores = new EvaluationSubmissionScoresModel();
                    $evaluation_submission_scores->ss_submission_id = $data->s_id;
                    $evaluation_submission_scores->ss_criteria_id = $request->criteria_ids[$index - 1];
                    $evaluation_submission_scores->ss_score = $score;
                    $criteria_score = ($criteria_score + $score);
                    $evaluation_submission_scores->save();
                }
                $data->es_final_score = $criteria_score / count($request->criteria);
                $data->save();
                return redirect()->route('students.evaluation.details', ['evaluation_id' => $request->s_evaluation_id])->with(['success' => 'تم التقييم بنجاح']);
            }
            return back()->withErrors(['error' => 'Failed to save the evaluation. Please try again.']);
        }
        else{
            return 'تم التقييم مسبقا';
        }
    }
}
