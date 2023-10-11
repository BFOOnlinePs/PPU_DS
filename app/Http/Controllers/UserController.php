<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index_user(Request $request)
    {
        $data = User::where('u_role_id' , $request->id)->get();
        $html = view('project.admin.users.ajax.usersList' , ['data' => $data , 'u_role_id' => $request->id])->render();
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
        $user = User::find($request->id);
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
            $html = view('project.admin.users.ajax.usersList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        $html = view('project.admin.users.edit' , ['user' => $user])->render();
        return response()->json(['html' => $html]);
    }
    public function index()
    {
        $data = User::with('role')->get();
        $roles = Role::all();
        return view('project.admin.users.index' , ['data' => $data , 'roles' => $roles , 'u_role_id' => null]);
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
            $html = view('project.admin.users.ajax.usersList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
}
