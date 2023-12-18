<?php

namespace App\Http\Controllers\apisControllers\supervisors;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\MajorSupervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupervisorStudentsController extends Controller
{
    // to get the students of a major that the current supervisor is supervised
    // all students if no major_id sent
    // students of a specific major when major_id sent
    public function getSupervisorStudentsDependOnMajor(Request $request)
    {
        $supervisorId = auth()->user()->u_id;
        $supervisorMajorsIdList = MajorSupervisor::where('ms_super_id', $supervisorId)->pluck('ms_major_id');
        $studentsList = User::where('u_role_id', 2)->whereIn('u_major_id', $supervisorMajorsIdList);

        if (request()->has('major_id')) {
            $majorId = $request->input('major_id');
            $studentsList->where('u_major_id', $majorId);
        }

        $studentsList = $studentsList->with('major')->get();

        return response()->json([
            'status' => true,
            'students' => $studentsList,
        ]);
    }


    // send student id to get his info
    public function getStudentInfo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['student_id' => 'required'],
            ['student_id.required' => 'الرجاء ارسال رقم الطالب']
        );

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $student_id = $request->input('student_id');
        $student_info = User::where('u_role_id', 2)->where('u_id', $student_id)->first();

        if(!$student_info){
            return response()->json([
                'status' => false,
                'message' => 'الطالب غير موحود'
            ]);
        }

        $major_name = Major::where('m_id', $student_info->u_major_id)->pluck('m_name')->first();
        $student_info['major_name'] = $major_name;

        return response()->json([
            'status' => true,
            'student_info' => $student_info,
        ]);
    }
}
