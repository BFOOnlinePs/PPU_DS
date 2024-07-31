<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\evaluation;

use App\Http\Controllers\Controller;
use App\Models\CriteriaModel;
use App\Models\EvaluationCriteriaModel;
use App\Models\EvaluationsModel;
use App\Models\EvaluationSubmissionScoresModel;
use App\Models\EvaluationSubmissionsModel;
use App\Models\EvaluationTypesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{

    public function isUserHasEvaluationToSubmit()
    {
        $current_user =  Auth::user();
        $user_role_id = $current_user->u_role_id;

        $evaluation_type_id = EvaluationTypesModel::where('et_evaluator_role_id', $user_role_id)->pluck('et_id');

        $evaluations = EvaluationsModel::whereIn('e_type_id', $evaluation_type_id)
            ->where('e_status', 1)
            ->where('e_start_time', '<=', Carbon::now())
            ->where('e_end_time', '>=', Carbon::now())
            ->exists();

        if ($evaluations) {
            return response()->json([
                'status' => true,
                'isEvaluationExists' => true
            ]);
        } else {
            return response()->json([
                'status' => true,
                'isEvaluationExists' => false
            ]);
        }
    }



    public function submitEvaluation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluation_id' => 'required',
            // 'evaluator_id' => 'required',
            'evaluatee_id' => 'required',
            'registration_id' => 'required',
            'notes' => 'nullable',
            // final score + max score
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        };

        $evaluator_id = Auth::user()->u_id;

        $evaluation_submission = new EvaluationSubmissionsModel();

        $evaluation_submission->es_evaluation_id = $request->input('evaluation_id');
        $evaluation_submission->es_evaluator_id = $evaluator_id;
        $evaluation_submission->es_evaluatee_id = $request->input('evaluatee_id');
        $evaluation_submission->es_registration_id = $request->input('registration_id');
        $evaluation_submission->es_notes = $request->input('notes');


        if ($evaluation_submission->save()) {
            $submission_id = $evaluation_submission->es_id;

            $submission_scores = $request->input('submission_scores');
            $final_score = 0;
            $max_score = 0;
            foreach ($submission_scores as $submission_score) {
                $evaluation_submission_scores = new EvaluationSubmissionScoresModel();

                $evaluation_submission_scores->ss_submission_id = $submission_id;
                $evaluation_submission_scores->ss_criteria_id = $submission_score['submission_criteria_id'];
                $evaluation_submission_scores->ss_score = $submission_score['submission_score_id'];
                $evaluation_submission_scores->save();

                $final_score += $submission_score['submission_score_id'];
                $max_score += CriteriaModel::where('c_id', $submission_score['submission_criteria_id'])->first()->c_max_score;
            }

            $evaluation_submission->es_final_score = $final_score;
            $evaluation_submission->es_max_score = $max_score;
            $evaluation_submission->save();

            return response()->json([
                'status' => true,
                'message' => 'evaluation submitted successfully',
            ]);
        }
    }

    public function getEvaluationsToSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'evaluation_id'
        ]);

        $current_user =  Auth::user();
        $user_role_id = $current_user->u_role_id;
        $user_id = $current_user->u_id;

        $evaluation = EvaluationsModel::where('e_status', 1)
            ->where('e_start_time', '<=', Carbon::now())
            ->where('e_end_time', '>=', Carbon::now())
            // ->where('e_evaluator_role_id', $user_role_id)
            ->first(); //

        if ($evaluation == null) {
            return response()->json([
                'status' => false,
                'message' => 'no evaluation found',
            ]);
        }

        $evaluation_criteria_ids = EvaluationCriteriaModel::where('ec_evaluation_id', $evaluation->e_id)
            ->pluck('ec_criteria_id');


        $criteria = CriteriaModel::whereIn('c_id', $evaluation_criteria_ids)->get();

        return response()->json([
            'status' => true,
            'evaluation' => $evaluation,
            'criteria' => $criteria,
        ]);
    }
}
