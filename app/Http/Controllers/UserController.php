<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function browse_admin(Request $request)
    {
        $data = User::where('u_role_id' , $request->id)->get();
        $html = view('project.admin.users.table_user' , ['data' => $data])->render();
        return response()->json(['html' => $html]);
    }
    public function edit_pasword(Request $request)
    {
        return response()->json(['id' => $request->data['id']]);
    }
    public function reset_pasword(Request $request)
    {
        $user = User::find($request->name_reset_password);
        $user->password = bcrypt($request->password);
        if($user->save()) {
            return response()->json([]);
        }
    }
    public function status(Request $request)
    {
        $user = User::find($request->id);
        $user->status = !($user->status);
        if($user->save()) {
            return response()->json(['status' => $user->status]);
        }
    }
    public function update(Request $request)
    {
        $user = User::find($request->user_id_modal_edit);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->phone2;
        $user->date_of_birth = $request->date_of_birth;
        $user->role_id = $request->role_id;
        $user->major_id = $request->major_id;
        $user->gender = $request->gender;
        $user->address = $request->address;
        if($user->save()) {
            $data = User::all();
            $html = view('project.admin.users.table_user' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return response()->json(['user' => $user]);
    }
    public function browse()
    {
        $data = User::all();
        $roles = Role::all();
        return view('project.admin.users.browse' , ['data' => $data , 'roles' => $roles]);
    }
    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->phone2;
        $user->date_of_birth = $request->date_of_birth;
        $user->role_id = $request->role_id;
        $user->major_id = $request->major_id;
        $user->gender = $request->gender;
        $user->address = $request->address;
        if($user->save()) {
            $data = User::all();
            $html = view('project.admin.users.table_user' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
}
