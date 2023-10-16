<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Major;

class UserController extends Controller
{
<<<<<<< HEAD
    public function details($id)
    {
        $user = User::find($id);
        return view('project.admin.users.details' , ['user' => $user]);
    }
=======
<<<<<<< HEAD
=======
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477
    public function search(Request $request)
    {
        $data = null;
        if($request->data['u_role_id'] == null) {
            $data = User::where('u_username' , 'like' , '%' . $request->data['data'] . '%')
                        ->orWhere('name' , 'like' , '%' . $request->data['data'] . '%')
                        ->get();
        }
        else {
            $data = User::where('u_username', 'like', '%' . $request->data['data'] . '%')
                        ->where('u_role_id', $request->data['u_role_id']);

                    $data = $data->union(
                        User::where('name', 'like', '%' . $request->data['data'] . '%')
                            ->where('u_role_id', $request->data['u_role_id'])
                    )->get();

        }
        $html = view('project.admin.users.ajax.usersList' , ['data' => $data])->render();
        return response()->json(['html' => $html]);
<<<<<<< HEAD
    }
    public function update(Request $request)
    {
        $user = User::find($request->u_id);
        $user->u_username = $request->u_username;
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->u_phone1 = $request->u_phone1;
        $user->u_phone2 = $request->u_phone2;
        $user->u_address = $request->u_address;
        $user->u_date_of_birth = $request->u_date_of_birth;
        $user->u_gender = $request->u_gender;
        $user->u_major_id = $request->u_major_id;
        $user->u_role_id = $request->u_role_id;
        if(isset($request->u_status)) {
            $user->u_status = 1;
        }
        else {
            $user->u_status = 0;
        }
        if ($user->save()) {
            return redirect()->back()->with('success', 'تم تعديل بيانات هذا المستخدم بنجاح');
=======

        return response()->json(['html' => $request->data]);
    }
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
    public function index_user(Request $request)
    {
        $data = User::where('u_role_id' , $request->id)->get();
        $html = view('project.admin.users.ajax.usersList' , ['data' => $data , 'u_role_id' => $request->id])->render();
<<<<<<< HEAD
        return response()->json(['html' => $html]);
=======
        $r_name = Role::where('r_id', $request->id)->value('r_name');
        return response()->json(['html' => $html , 'u_role_id' => $request->id , 'r_name' => $r_name]);
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
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
<<<<<<< HEAD
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
=======
        $user = User::where('u_id' , $request->data['u_id'])->first();
        $user->u_username = $request->data['u_username'];
        $user->name = $request->data['name'];
        $user->email = $request->data['email'];
        $user->u_phone1 = $request->data['u_phone1'];
        $user->u_phone2 = $request->data['u_phone2'];
        $user->u_address = $request->data['u_address'];
        $user->u_date_of_birth = $request->data['u_date_of_birth'];
        $user->u_gender = $request->data['u_gender'];
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        if($user->save()) {
            $data = User::all();
            $html = view('project.admin.users.ajax.usersList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477
        }
    }
    public function edit($id)
    {
        $user = User::find($id);
        $role_name = Role::find($user->u_role_id);
        return view('project.admin.users.edit' , ['user' => $user , 'role_name' => $role_name->r_name]);
    }
    public function index_id($id)
    {
        $data = User::where('u_role_id' , $id)->get();
        $roles = Role::all();
        $major = Major::all();
        $role = Role::where('r_id' , $id)->first();
        $role_name = $role->r_name;
        return view('project.admin.users.index' , ['data' => $data , 'roles' => $roles , 'u_role_id' => $id , 'major' => $major , 'role_name' => $role_name]);
    }
    public function index()
    {
        $data = User::with('role')->get();
        $roles = Role::all();
        $major = Major::all();
        return view('project.admin.users.index' , ['data' => $data , 'roles' => $roles , 'u_role_id' => null , 'major' => $major , 'role_name' => null]);
    }
    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->u_username = $request->u_username;
        $user->u_phone1 = $request->u_phone1;
        $user->u_phone2 = $request->u_phone2;
        $user->u_address = $request->u_address;
        $user->u_date_of_birth = $request->u_date_of_birth;
        $user->u_gender = $request->u_gender;
        $user->u_major_id = $request->u_major_id;
        $user->u_role_id = $request->u_role_id;
        if($user->save()) {
            $data = User::where('u_role_id', $request->u_role_id)->get();
            $html = view('project.admin.users.ajax.usersList' , ['data' => $data])->render();

            return response()->json(['html' => $html]);
        }
    }
}
