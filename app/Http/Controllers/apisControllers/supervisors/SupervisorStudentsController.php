<?php

namespace App\Http\Controllers\apisControllers\supervisors;

use App\Http\Controllers\Controller;
use App\Models\MajorSupervisor;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorStudentsController extends Controller
{
    // to get the students of a major that the current supervisor is supervised
    // all students if no major_id sent
    // student of a specific major when major_id sent
    public function getSupervisorStudentsDependOnMajor(Request $request){
        $supervisorId = auth()->user()->u_id;
        $supervisorMajorsIdList = MajorSupervisor::where('ms_super_id',$supervisorId)->pluck('ms_major_id');
        $studentsList = User::where('u_role_id' , 2)->whereIn('u_major_id', $supervisorMajorsIdList);

        if (request()->has('major_id')) {
            $majorId = $request->input('major_id');
            $studentsList ->where('u_major_id', $majorId);
        }

        // ->with('major')
        // ->get();
        // $studentsList = $studentsList->where('u_major_id', 'major_id')

        $studentsList = $studentsList->with('major')->get();

        return response()->json([
            'status' => true,
            'students' => $studentsList,
        ]);
    }
}
