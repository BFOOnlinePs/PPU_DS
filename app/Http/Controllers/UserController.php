<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Major;

class UserController extends Controller
{
    public function details($id)
    {
        $user = User::find($id);
        return view('project.admin.users.details' , ['user' => $user]);
    }
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
