<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Major;
use App\Models\Course;
use App\Models\SystemSetting;
use App\Models\Registration;

class UserController extends Controller
{
    public function courses_student_add(Request $request)
    {
        $serializedData = $request->input('data');

        // Parse the serialized data into an array
        parse_str($serializedData, $parsedData);

        // Access the 'c_id' value
        $c_id = $parsedData['c_id'];
        $system_setting = SystemSetting::first();
        $registration = new Registration();
        $registration->r_student_id = $request->input('id');
        $registration->r_course_id = $c_id;
        $registration->r_semester = $system_setting->ss_semester_type;
        $registration->r_year = $system_setting->ss_year;
        if($registration->save()) {
            $r_course_id = Registration::where('r_student_id' , $request->input('id'))
                                        ->where('r_semester' , $system_setting->ss_semester_type)
                                        ->where('r_year' , $system_setting->ss_year)
                                        ->pluck('r_course_id')
                                        ->toArray();
            $data = Course::whereIn('c_id' , $r_course_id)->get();
            $html = view('project.admin.users.ajax.coursesList' , ['data' => $data])->render();

            return response()->json(['html' => $html]);
        }
    }
    public function courses_student($id)
    {
        $user = User::find($id);
        $major = Major::where('m_id' , $user->u_major_id)->first();
        $major_name = $major->m_name;
        $courses = Course::get();

        $system_setting = SystemSetting::first();

        $r_course_id = Registration::where('r_student_id' , $id)
                                    ->where('r_semester' , $system_setting->ss_semester_type)
                                    ->where('r_year' , $system_setting->ss_year)
                                    ->pluck('r_course_id')
                                    ->toArray();
        // if($r_course_id == '[]') {
        //     $r_course_id = null;
        // }

        $data = Course::whereIn('c_id' , $r_course_id)->get();
        return view('project.admin.users.courese_student' , ['user' => $user , 'major' => $major_name , 'courses' => $courses , 'data' => $data]);
    }
    public function details($id)
    {
        $user = User::find($id);
        $major = Major::where('m_id' , $user->u_major_id)->first();
        $major_name = $major->m_name;
        return view('project.admin.users.details' , ['user' => $user , 'major' => $major_name]);
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
        $major_id = Major::where('m_id' , $user->u_major_id)->first();
        $role_id = Role::where('r_id' , $user->u_role_id)->first();
        $roles = Role::get();
        $majors = Major::get();
        return view('project.admin.users.edit' , ['user' => $user , 'role_name' => $role_name->r_name , 'major_id' => $major_id , 'roles' => $roles , 'majors' => $majors , 'role_id' => $role_id]);
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
