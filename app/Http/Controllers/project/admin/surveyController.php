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
       // return $request;
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
           for($j = 1 ; $j <= $request->$questionOptionsNumber ; $j++){
            $optionText='q'.($i).'option'.($j);
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
    //return $data;
    $questions = surveyQuestions::where('sq_s_id',$id)->with('options','answers')->get();
    //return $questions;
    $surveySumbission = surveySumbission::where('ss_s_id',$id)->where('ss_u_id',auth()->user()->u_id)->with('questions.options.answers')->get();
//return $surveySumbission;
    return view("project.admin.survey.surveySubmit",['data'=>$data,'surveySumbission'=>$surveySumbission]);


   }

   public function update(Request $request){
//   //  return $request;
//     $questionsArray=[];
//     $survey = survey::where('s_id',$request->s_id)->first(); 
//     $survey->s_title=$request->s_title;
//     $survey->s_description=$request->s_description;
//     $survey->s_start_date=$request->s_start_date;
//     $survey->s_end_date=$request->s_end_date;
//    if($survey->save()){
//       //update questions     
//        $questions = surveyQuestions::where('sq_s_id',$request->s_id)->get();// if question exist important to add 
//        if($request->questionsNumber == 0 ){
//         if(count($questions)!=0){
//            for($i = 0 ; $i < count($questions);$i++){
//                $questions[$i]->delete();
//             }
//         }
//     }
//     else if(count($questions)==0){
//                         for($i=0 ; $i < $request->questionsNumber ; $i++ ){
//                                 $surveyQuestion=new surveyQuestions;
//                                 $surveyQuestion->sq_s_id=$survey->s_id;
//                                 $sq='sq_question'.$i+1;
//                                 $sq_type='sq_question_type'.$i+1;
//                                 $sq_required='sq'.($i+1).'_required';
//                                 $surveyQuestion->sq_question_text=$request->$sq;
//                                 $surveyQuestion->sq_question_type=$request->$sq_type;
//                                 $surveyQuestion->sq_question_required=$request->$sq_required;
//                                 if($surveyQuestion->save()){
//                                     //add options if exist
//                                     if($request->$sq_type == "multiple_choice" || $request->$sq_type == "single_choice" ){
//                                         $questionOptionsNumber= 'q'.($i+1).'optionsNumber';
//                                        // return $request->$questionOptionsNumber;
//                                         for($j = 1 ; $j < $request->$questionOptionsNumber+1 ; $j++){
//                                             $optionText='q'.($i+1).'option'.$j;
//                                             //return $optionText;
//                                             $sq_options  = new surveyQuestionsOptions;
//                                             $sq_options->sqo_sq_id=$surveyQuestion->sq_id;
//                                             $sq_options->sqo_option_text=$request->$optionText; 
//                                             $sq_options->save(); 
//                                             // return $sq_options->sqo_option_text;
//                                         }
//                                     }
                                
//                                 }
//                             }
//                         }
//             else if(count($questions)!=0){
//             for($i = 0 ; $i < $request->questionsNumber  ; $i++){
//                 if($i < count($questions)){ //0 < 3
//                     $questionNumber='questionNumber'.($i+1);//206
//                     if($request->$questionNumber){ //true
                
//                     $questionTextAttribute='sq_question'.$request->$questionNumber;//2
//                     $questionTypeAttribute='sq_question_type'.$request->$questionNumber;//paragraph
//                     $questionRequiredAttribute='sq'.$request->$questionNumber.'_required';//0
//                     $questionsArray[]=$request->$questionNumber;//[206,]
                   
//                 if($questions[$i]->sq_id==$request->$questionNumber){//206==206
//                     $questions[$i]->sq_question_text=$request->$questionTextAttribute;
//                     $questions[$i]->sq_question_required=$request->$questionRequiredAttribute;
//                     $questions[$i]->save();//////////////////////////test
               
//             //options       //change type
           
//             if($request->$questionTypeAttribute!=$questions[$i]->sq_question_type){
// //return $request; 
// // return $request->$questionTypeAttribute ;
//                     $questions[$i]->sq_question_type=$request->$questionTypeAttribute;
//                 if($questions[$i]->sq_question_type == 'multiple_choice' || $questions[$i]->sq_question_type == 'single_choice')
//                 {
//                     $optionsNumberAttribute='q'.($i+1).'optionsNumber';
//                     $optionsNumber=$request->$optionsNumberAttribute;
//                     $options = surveyQuestionsOptions::where('sqo_sq_id',$request->$questionNumber)->get();  
//                     for($j = 0 ; $j < $optionsNumber;$j++){     
                    
//                         $options[$j]->delete();
            
            
//                     }
//                     }  
                   

//             if($request->$questionTypeAttribute == 'multiple_choice' || $request->$questionTypeAttribute == 'single_choice' ){
              
//                 $questionOptionsNumber= 'q'.($i+1).'optionsNumber';
//                 for($j = 1 ; $j < $request->$questionOptionsNumber+1 ; $j++){
//                 $optionText='q'.($i+1).'option'.($j);
//                 $sq_options2 = new surveyQuestionsOptions;
//                 $sq_options2->sqo_sq_id=$surveyQuestion->sq_id;
//                 $sq_options2->sqo_option_text=$request->$optionText; 
//                 $sq_options2->save();
//                 }
            
//             }
            
            
               
            
            
             
            
            
//             }
//             if($request->$questionTypeAttribute==$questions[$i]->sq_question_type){////////////////////////////change type
//                 $questions[$i]->sq_question_type=$request->$questionTypeAttribute;
//                 if($questions[$i]->sq_question_type == 'multiple_choice' || $questions[$i]->sq_question_type == 'single_choice')
//                 {
//                     $optionsNumberAttribute='q'.($i+1).'optionsNumber';
//                     $optionsNumber=$request->$optionsNumberAttribute;
//                     $options = surveyQuestionsOptions::where('sqo_sq_id',$request->$questionNumber)->get();  
//                     for($j = 0 ; $j < $optionsNumber;$j++){                
                    
//                     if(count($options) == $optionsNumber){// just update 
//                         $optionsTextAttribute='q'.$questions[$i]->sq_id.'option'.$options[$j]->sqo_id;
//                     $options[$j]->sqo_option_text=$request->$optionsTextAttribute;
//                     $options[$j]->save();
//             }
//             else if(count($options) > $optionsNumber ){ //update + delete
//                     if($optionsTextAttribute){
//                 $optionsTextAttribute='q'.$questions[$i]->sq_id.'option'.$options[$j]->sqo_id;
//                 $options[$j]->sqo_option_text=$request->$optionsTextAttribute;
//                 $options[$j]->save();
//             }
        
//             else {
//             $options[$j]->delete();


            
//         }
//     }

            
        
//             else if(count($options) < $optionsNumber) { //update + add
//                 if($j+1>count($options)){
//                 $addedOptionAttribute = 'q'.($i+1).'option'.($j+1);
//                 $addedOption=new surveyQuestionsOptions;
//                 $addedOption->sqo_sq_id=$questions[$i]->sq_id;
//                 $addedOption->sqo_option_text=$request->$addedOptionAttribute;
//                 $addedOption->save();
//                 }
//                 else{
//                 $optionsTextAttribute='q'.$questions[$i]->sq_id.'option'.$options[$j]->sqo_id;
//                 $options[$j]->sqo_option_text=$request->$optionsTextAttribute;
//                 $options[$j]->save();
//                 }
//             }
            
//             }
        
//         }

//         }




//         $questions[$i]->save();       
//     }
            
        
            
                

//             }
     
            
            


        
//             }
//         //add questions
//         else if($i+1 > count($questions) || count($questions)==0){
                
//             $surveyQuestion=new surveyQuestions;
//             $surveyQuestion->sq_s_id=$survey->s_id;
//             $sq='sq_question'.$i+1;
//             $sq_type='sq_question_type'.$i+1;
//             $sq_required='sq'.($i+1).'_required';
//             $surveyQuestion->sq_question_text=$request->$sq;
//             $surveyQuestion->sq_question_type=$request->$sq_type;
//             $surveyQuestion->sq_question_required=$request->$sq_required;
//             if($surveyQuestion->save()){
//             //add options if exist
//             if($request->$sq_type == "multiple_choice" || $request->$sq_type == "single_choice" ){
//             $questionOptionsNumber= 'q'.($i+1).'optionsNumber';
//            // return $request->$questionOptionsNumber;
//             for($j = 1 ; $j < $request->$questionOptionsNumber+1 ; $j++){
//             $optionText='q'.($i+1).'option'.$j;
//           //  return $optionText;
//             $sq_options1  = new surveyQuestionsOptions;
//             $sq_options1->sqo_sq_id=$surveyQuestion->sq_id;
//             $sq_options1->sqo_option_text=$request->$optionText; 
//             $sq_options1->save(); 
//             // return $sq_options1->sqo_option_text;
//             }
//             }
            
//         }
            
            
        


//             }
//             //  return $questionsArray;
//                 //delete questions
//                 // if(count($questions) > $request->questionsNumber)
//                 //     {  
//         //         for($r = 0 ; $r < count($questions)  ; $r++){
                
//         //         if(!in_array($questions[$r]->sq_id,$questionsArray)){
//         //             //return !in_array($questions[$i]->sq_id,$questionsArray);
//         //             $deletedQuestion=surveyQuestions::where('sq_s_id',$request->s_id)->where('sq_id',$questions[$r]->sq_id)->first();
//         //           //  return $deletedQuestion;
//         //         if($deletedQuestion->delete()){
//         //             if($questions[$r]->sq_question_type == 'multiple_choice' || $questions[$r]->sq_question_type == 'single_choice')
//         //             {
//         //                 $deletedOptions= surveyQuestionsOptions::where('sqo_sq_id',$questions[$r]->sq_id)->get(); 
//         //                 for($n = 0 ; $n < count($deletedOptions)  ; $n++){
//         //                     $deletedOptions[$n]->delete();
//         //                 } 
                
//         //             }
//         //             }
                
//         //         // }
//         //     }
//         // }
//             }
//              }
//                 return  redirect()->route("admin.survey.surveyView",["id"=>$survey->s_id]); 
           
        
        
        
//             }
        $survey = survey::where('s_id',$request->s_id)->first();
        $survey->s_title=$request->s_title;
        $survey->s_description=$request->s_description;
        $survey->s_start_date=$request->s_start_date;
        $survey->s_end_date=$request->s_end_date;
       if($survey->save()){
                $existingQustions=surveyQuestions::where('sq_s_id',$request->s_id)->get();
                if(count($existingQustions)!=0 && $request->questionsNumber == 0){
                        for($i = 0 ; $i < count($existingQustions);$i++){
                            if($existingQustions[$i]->delete()){
                                    $options=surveyQuestionsOptions::where("sqo_sq_id",$existingQustions[$i]->sq_id)->get();
                                    if($options){
                                        for($j=0 ; $j < count($options);$j++){
                                            $options[$j]->delete();
                                        }
                                    }
                            }     
                        }   
                    }
                if(count($existingQustions)==0 && $request->questionsNumber != 0){
                    for($i=0 ; $i < $request->questionsNumber ; $i++ ){
                            $surveyQuestion=new surveyQuestions;
                            $surveyQuestion->sq_s_id=$survey->s_id;
                            $sq='sq_question'.$i+1;
                            $sq_type='sq_question_type'.$i+1;
                            $sq_required='sq'.($i+1).'_required';
                            $surveyQuestion->sq_question_text=$request->$sq;
                            $surveyQuestion->sq_question_type=$request->$sq_type;
                            $surveyQuestion->sq_question_required=$request->$sq_required;
                            if($surveyQuestion->save()){
                                //add options if exist
                                if($request->$sq_type == "multiple_choice" || $request->$sq_type == "single_choice" ){
                                    $questionOptionsNumber= 'q'.($i+1).'optionsNumber';
                                   // return $request->$questionOptionsNumber;
                                    for($j = 1 ; $j < $request->$questionOptionsNumber+1 ; $j++){
                                        $optionText='q'.($i+1).'option'.$j;
                                        //return $optionText;
                                        $sq_options  = new surveyQuestionsOptions;
                                        $sq_options->sqo_sq_id=$surveyQuestion->sq_id;
                                        $sq_options->sqo_option_text=$request->$optionText; 
                                        $sq_options->save(); 
                                        // return $sq_options->sqo_option_text;
                                    }
                                }
                            
                            }
                        }
                    }

                    if(count($existingQustions)!=0 && $request->questionsNumber != 0){
                            for($i = 0 ; $i < $request->questionsNumber  ; $i++){
                                if($i < count($questions)){ //0 < 3
                                  $questionNumber='questionNumber'.($i+1);//206
                                    if($request->$questionNumber){ //true
                                        $questionTextAttribute='sq_question'.$request->$questionNumber;//2
                                        $questionTypeAttribute='sq_question_type'.$request->$questionNumber;//paragraph
                                        $questionRequiredAttribute='sq'.$request->$questionNumber.'_required';//0
                                        $questionsArray[]=$request->$questionNumber;//[206,]
                                          if($questions[$i]->sq_id==$request->$questionNumber){//206==206
                                             $questions[$i]->sq_question_text=$request->$questionTextAttribute;
                                             $questions[$i]->sq_question_required=$request->$questionRequiredAttribute;
                                             $questions[$i]->save();//////////////////////////test
                                            }
                                    }
                                }
                            }
                        }
        }
        
       return  redirect()->route("admin.survey.surveyView",["id"=>$survey->s_id]); 
 }
 public function surveyResults($id){

    $surveySumbission=surveySumbission::where('ss_s_id',$id)->get();
   $data=survey::where('s_id',$id)->with('questions.options.answers',"questions.answers")->first();
   //return $data;
   $data = survey::where('s_id',$id)->first();
   $questions = surveyQuestions::where('sq_s_id',$id)->with('options')->get();
   $surveyExist=surveySumbission::where('ss_s_id',$id)->where('ss_u_id',auth()->user()->u_id)->get();
    return view("project.admin.survey.surveyResults",['data'=>$data,'surveySumbission'=>$surveySumbission,'questions'=>$questions]);
 }
            }



   