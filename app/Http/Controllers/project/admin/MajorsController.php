<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;

class MajorsController extends Controller
{
    public function index()
    {
        $data=Major::get();
        return view('project/admin/majors/index',['data'=>$data]);
    }
    public function create(Request $request){
        $major=new Major;
        $major->m_name=$request->m_name;
        $major->m_description=$request->m_description;
        $major->m_reference_code=$request->m_reference_code;
        if ($major->save()) {
            $data = Major::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.majors.ajax.majorsList',['data'=>$data])->render()
            ]);
        }
        
    }
    public function update(Request $request){
        return $major;
        $major = Major::Where('m_id',$request->edit_m_id)->first();
        $major->m_name=$request->edit_m_name;
        $major->m_description=$request->edit_m_description;
        $major->m_reference_code=$request->edit_m_reference_code;
       
        if ($major->save()) {
            $data = Major::get();
            return response()->json([
                'success'=>'true',
                'data'=>view('project.admin.majors.ajax.majorsList',['data'=>$data])->render()
            ]);
        }
        
    }
}
