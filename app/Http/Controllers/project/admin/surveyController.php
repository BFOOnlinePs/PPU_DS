<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\survey;
use App\Models\User;
use App\Models\surveyTargetGroup;
use App\Models\surveyQuestions;
use App\Models\surveyQuestionsOptions;
use App\Models\surveySumbission;



class surveyController extends Controller
{
    public function index()
    {
        $now = now()->toDateTimeString(); 
        if (auth()->user()->u_role_id == 1) {
            $data = survey::with('targets', 'users')->orderBy('created_at', 'desc')->get();
        }
         else {
            $data = survey::with('targets', 'users')
                ->where('s_start_date', '<=', $now)
                ->where('s_end_date', '>=', $now)
                ->orderBy('created_at', 'desc')
                ->get();
        }
            for ($i = 0; $i < count($data); $i++) {
                $added_by = User::where("u_id", $data[$i]->s_added_by)->select('name')->first();
                $data[$i]->s_added_by = $added_by->name;
        }

            switch (auth()->user()->u_role_id) {
                            case '2':
                                $data = $data->whereIn('st_id', [2,1]);
                                break;
                            case '3':
                                $data = $data->whereIn('st_id', [3,1]);
                                break;
                            case '4':
                                $data = $data->whereIn('st_id', [1,4]);
                                break;
                            case '5':
                                $data = $data->whereIn('st_id', [5,1]);
                                break;
                            case '6':
                                $data = $data->whereIn('st_id', [6,1]);
                                break;
                            case '8':
                                $data = $data->whereIn('st_id', [7,1]);
                                break;
                            default:
                                $data = $data;
                        }
                      
        return view('project.admin.survey.index', ['data' => $data]);
    }
    
    public function surveySearch(Request $request){
        $data = survey::where('s_title','like','%'.$request->search.'%')->get();
        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.survey.ajax.surveysList',['data'=>$data])->render()
        ]);
    }
    public function addSurvey(){
        $targets= surveyTargetGroup::get();

        return view('project.admin.survey.addSurvey',['targets'=>$targets]);

    }
    public function editSurvey($id){
        $targets= surveyTargetGroup::get();
        $data = survey::where('s_id',$id)->with('questions.options')->first();
        //return $data;
        return view('project.admin.survey.editSurvey',['data'=>$data,'targets'=>$targets]);

    }
    public function createSurvey(Request $request){
        $targets= surveyTargetGroup::get();
        //add survey info
        $survey= new survey;
        $survey->s_title=$request->s_title;
        $survey->s_description=$request->s_description;
        $survey->st_id=$request->s_target;
        $survey->s_start_date=$request->s_start_date;
        $survey->s_end_date=$request->s_end_date;
        $survey->s_added_by=auth()->user()->u_id;
       
       
   if($survey->save())
  {

     //add questions 
        if($request->questionsNumber != 0){
            for($i = 1 ; $i < $request->questionsNumber +1 ; $i++){
          $surveyQuestion=new surveyQuestions;
          $surveyQuestion->sq_s_id=$survey->s_id;
          $sq='sq_question'.$i;
          $sq_type='sq_question_type'.$i;
          $sq_required='sq'.$i.'_required';
          $surveyQuestion->sq_question_text=$request->$sq;
          $surveyQuestion->sq_question_type=$request->$sq_type;
          $surveyQuestion->sq_question_required=$request->$sq_required;
          $surveyQuestion->save();
          //add options if exist
          if($request->$sq_type == "multiple_choice" || $request->$sq_type == "single_choice" ){
          $questionOptionsNumber= 'q'.$i.'optionsNumber';
           for($j = 1 ; $j < $request->$questionOptionsNumber + 1; $j++){
            $optionText='q'.$i.'option'.$j;
            $sq_options = new surveyQuestionsOptions;
            $sq_options->sqo_sq_id=$surveyQuestion->sq_id;
            $sq_options->sqo_option_text=$request->$optionText; 
            $sq_options->save();
           }
            }
            }
        }   
        $questions = surveyQuestions::where('sq_s_id',$survey->s_id)->with('options')->get();
        return  redirect()->route("admin.survey.surveyView",["id"=>$survey->s_id]);
    }
    }

   public function surveyView($id){
    $data = survey::where('s_id',$id)->first();
    $questions = surveyQuestions::where('sq_s_id',$id)->with('options')->get();
    $surveyExist=surveySumbission::where('ss_s_id',$id)->where('ss_u_id',auth()->user()->u_id)->get();
if(count($surveyExist)!=0)
{
 return redirect()->route("admin.survey.surveySubmit",["id"=>$id]);

}
else{
    return view('project.admin.survey.surveyView',['data'=>$data,'questions'=>$questions]);


}


   }
   public function deleteSurvey(Request $request){
    $data = survey::where('s_id', $request->s_id)->first();

    if ($data->delete()) {
        $questions = surveyQuestions::where('sq_s_id',$request->s_id)->with('options')->get();
        if($questions){
        for($i=0 ; $i < count($questions);$i++){
            if($questions[$i]->delete()){
               $options=surveyQuestionsOptions::where("sqo_sq_id",$questions[$i]->sq_id)->get();
               if($options){
                for($j=0 ; $j < count($options);$j++){
                    $options[$j]->delete();
                }

               }

            }
           

        }
}
        $data = survey::with('targets','users')->orderBy('created_at', 'desc')->get();
        for($i=0 ; $i< count($data);$i++){
        $added_by=User::where("u_id",$data[$i]->s_added_by)->select('name')->first();
        $data[$i]->s_added_by=$added_by->name;
        }
        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.survey.ajax.surveysList',['data'=>$data])->render()
        ]);
    } 
   }
   public function submitSurvey(Request $request){
// return $request;
    $surveyExist=surveySumbission::where('ss_s_id',$request->s_id)->where('ss_u_id',auth()->user()->u_id)->get();
    if(count($surveyExist)==0)
    for($i = 1; $i < $request->questionsCount+1 ;$i++){

        $questionNumber='questionNumber'.$i;
        $ifMultiple='questionType'.$request->$questionNumber;
        $questionAnswer='question'.$request->$questionNumber.'_answer';
        if($request->$ifMultiple=='multiple_choice'){
            if($request->$questionAnswer){
        for($j = 0 ; $j< count($request->$questionAnswer); $j++){
            $surveySumbission =  new surveySumbission;
            $surveySumbission->ss_u_id=auth()->user()->u_id; 
            $surveySumbission->ss_s_id=$request->s_id;   
            $surveySumbission->ss_q_id=$request->$questionNumber;
            $surveySumbission->ss_question_answer=$request->$questionAnswer[$j];
            $surveySumbission->ss_question_answer=$request->$questionAnswer[$j];
            $surveySumbission->save();

        }
        }
        }
        else {
            if($request->$questionAnswer){
            $surveySumbission =  new surveySumbission;
            $surveySumbission->ss_u_id=auth()->user()->u_id; 
            $surveySumbission->ss_s_id=$request->s_id;   
            $surveySumbission->ss_q_id=$request->$questionNumber;
            $surveySumbission->ss_question_answer=$request->$questionAnswer;
            $surveySumbission->save();
            }
        }

    
    // }
}
    $data = survey::where('s_id',$request->s_id)->first();
    return  redirect()->route("admin.survey.surveySubmit",["id"=>$request->s_id]);
    
}

   public function surveySubmit($id){
    $data = survey::where('s_id',$id)->with('questions.options.answers',"questions.answers")->first();
 //   return $data;
    $questions = surveyQuestions::where('sq_s_id',$id)->with('options','answers')->get();
    //return $questions;
    $surveySumbission = surveySumbission::where('ss_s_id',$id)->where('ss_u_id',auth()->user()->u_id)->with('questions.options.answers')->get();
//return $surveySumbission;
    return view("project.admin.survey.surveySubmit",['data'=>$data,'surveySumbission'=>$surveySumbission]);


   }

   public function update(Request $request){
   
    // $survey = survey::where('s_id',$request->s_id)->first();
    // $survey->s_title=$request->s_title;
    // $survey->s_description=$request->s_description;
    // $survey->s_start_date=$request->s_start_date;
    // $survey->s_end_date=$request->s_end_date;
    // //update questions     
    //  $questions = surveyQuestions::where('sq_s_id',$request->s_id)->get();
    // if($request->questionsNumber == count($questions)){
       
    //     for($i = 1 ; $i < $request->questionsNumber + 1 ; $i++){
    //         $questionNumber='questionNumber'.$i;
    //         $questionTextAttribute='sq_question'.$request->$questionNumber;
    //         $questionTypeAttribute='sq_question_type'.$request->$questionNumber;
    //         $questionRequiredAttribute='sq'.$request->$questionNumber.'_required';
    //      if($questions[$i]->sq_id==$request->$questionNumber){
    //         $questions[$i]->sq_question_text=$request->$questionTextAttribute;
    //         $questions[$i]->sq_question_type=$request->$questionTypeAttribute;
    //         $questions[$i]->sq_question_required=$request->$questionRequiredAttribute;
    //         //options
    //         if($request->$questionTypeAttribute==$questions[$i]->sq_question_type)
    //         if($questions[$i]->sq_question_type == 'multiple_choice' || $questions[$i]->sq_question_type == 'single_choice')
    //          $options = surveyQuestionsOptions::where('sqo_sq_id',$request->$questionNumber);
    //       for($j = 0 ; $j < count($options);$j++){
    //         if()
    //       }
            
    //      } 
    //     }

    // }
    // else if($request->questionsNumber > count($questions)){


            
    // }

    // else {



    // }
   

    return $request;
   }
}



   