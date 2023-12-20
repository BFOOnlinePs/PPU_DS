<?php

namespace App\Http\Controllers\apisControllers\supervisors;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\MajorSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorMajorsController extends Controller
{
    // for the supervisor who logged in
    public function getSupervisorsMajors(){
        $supervisorId = auth()->user()->u_id;
        $supervisorMajorsIdList = MajorSupervisor::where('ms_super_id',$supervisorId)->pluck('ms_major_id');
        $supervisorMajorsNamesList = Major::whereIn('m_id', $supervisorMajorsIdList)->get();

        return response()->json([
            'status' => true,
            'majors' => $supervisorMajorsNamesList
        ]);
    }

}
