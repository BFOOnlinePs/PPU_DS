<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\announcements;

class announcementController extends Controller
{
    public function index(){

        $data=announcements::with('users')->get();
        return view('project.admin.announcements.index', ['data' => $data]);
    }

    public function announcementSearch(Request $request){
        $data = announcements::where('a_title','like','%'.$request->search.'%')->get();
        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.announcements.ajax.announcementsList',['data'=>$data])->render()
        ]);
    }

    public function create(Request $request){
        
        if ($request->hasFile('a_image')) {
            $file = $request->file('a_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/announcements', $filename, 'public');           
        }
      
        $announcements=new announcements();
        $announcements->a_title=$request->a_title;
        $announcements->a_content=$request->a_content;
        $announcements->a_image=$filename;
        $announcements->a_added_by=auth()->user()->u_id;
        if($announcements->save()){
        $data=announcements::get();
        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.announcements.ajax.announcementsList',['data'=>$data])->render()
        ]);
    }

    }
   public function updateStutas(Request $request){
    // $requestencode= json_encode($request);
    //return $request->selected_a_stutas;
    $announcement=announcements::where('a_id',$request->selected_a_id)->first();
    $announcement->a_stutas=$request->selected_a_stutas;
    if($announcement->save()){
        $data=announcements::with('users')->get();
        return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.announcements.ajax.announcementsList',['data'=>$data])->render()
            ]);
    }
   
   }
}
