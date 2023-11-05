<?php

namespace App\Http\Controllers\project\students\Personal_Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Major;
use App\Models\Role;

class PersonalProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $role_name = Role::find($user->u_role_id);
        $major_id = Major::where('m_id' , $user->u_major_id)->first();
        $role_id = Role::where('r_id' , $user->u_role_id)->first();
        $roles = Role::get();
        $majors = Major::get();
        return view('project.student.personal_profile.index' , ['user' => $user , 'role_name' => $role_name->r_name , 'major_id' => $major_id , 'roles' => $roles , 'majors' => $majors , 'role_id' => $role_id]);
    }
}
