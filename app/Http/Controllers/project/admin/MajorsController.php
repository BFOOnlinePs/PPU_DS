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
        $major = Major::Where('m_id',$request->m_id)->first();
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
    public function search(Request $request){

        $data = Major::where('m_name','like','%'.$request->search.'%')->get();

        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.majors.ajax.majorsList',['data'=>$data])->render()
        ]);

    }
}
