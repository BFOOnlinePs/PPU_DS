<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CoursesController extends Controller
{
    //
    public function index()
    {
        $data = Course::get();
        return view('project.admin.courses.index',['data'=>$data]);
    }

    public function create(Request $request)
    {
        $data = new Course;
        $data->c_name = $request->c_name;
        $data->c_course_code = $request->c_course_code;
        $data->c_hours = $request->c_hours;
        $data->c_description = $request->c_description;
        $data->c_course_type =$request->c_course_type;
        $data->c_reference_code	 =$request->c_reference_code;

        if ($data->save()) {
            $data = Course::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.courses.ajax.courseList',['data'=>$data])->render()
            ]);
        }
    }

    public function update(Request $request){
        $data = Course::where('c_id',$request->c_id)->first();
        $data->c_name = $request->c_name;
        $data->c_course_code = $request->c_course_code;
        $data->c_course_type = $request->c_course_type;
        $data->c_description = $request->c_description;
        $data->c_hours = $request->c_hours;
        $data->c_reference_code = $request->c_reference_code;
        $data->c_name = $request->c_name;


        if ($data->save()) {
            $data = Course::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.courses.ajax.courseList',['data'=>$data])->render()
            ]);
        }
    }

    public function courseSearch(Request $request){

        $data = Course::where('c_name','like','%'.$request->search.'%')->get();

        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.courses.ajax.courseList',['data'=>$data])->render()
        ]);

    }

    public function checkCourseCode(Request $request){



        $opp = $request->opp;

        if($opp == 'code'){
            $data = Course::where('c_course_code',$request->search)->first();
            if($data!=null){

                return response()->json([
                    'success'=>'true',
                    'data'=>$data
                ]);

            }else{
                return response()->json([
                    'success'=>'true',
                    'data'=>$data
                ]);
            }
        }else{
            $data = Course::where('c_reference_code',$request->search)->first();
            if($data!=null){

                return response()->json([
                    'success'=>'true',
                    'data'=>$data
                ]);

            }else{
                return response()->json([
                    'success'=>'true',
                    'data'=>$data
                ]);
            }
        }


    }
}
