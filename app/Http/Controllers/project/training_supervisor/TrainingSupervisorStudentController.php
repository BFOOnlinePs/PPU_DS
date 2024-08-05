<?php

namespace App\Http\Controllers\project\training_supervisor;

use App\Http\Controllers\Controller;
use App\Models\StudentCompany;
use App\Models\User;
use Illuminate\Http\Request;

class TrainingSupervisorStudentController extends Controller
{
    public function index()
    {

        return view('project.training_supervisor.my_students.index');
    }

    public function list_my_student_ajax(Request $request)
    {
        $data = StudentCompany::query();
        if ($request->filled('student_name')){
            $studentName = $request->input('student_name');
            $data->whereIn('sc_registration_id',function ($query) use ($studentName){
                $query->select('r_id')->from('registration')->where('supervisor_id',auth()->user()->u_id)
                ->whereIn('r_student_id',function ($query) use ($studentName){
                    $query->select('u_id')->from('users')->where('name', 'like', '%' . $studentName . '%');
                });
            })->get();
        }
        if ($request->filled('company_name')){
            $companyName = $request->input('company_name');
            $data->whereIn('sc_registration_id',function ($query) use ($companyName){
                $query->whereIn('sc_company_id',function ($query) use ($companyName){
                    $query->select('c_id')->from('companies')->where('c_name', 'like', '%' . $companyName . '%');
                });
                $query->select('r_id')->from('registration')->where('supervisor_id',auth()->user()->u_id);
            })->get();
        }
        $data = $data->with(['users','company'])->get();
        return response()->json([
            'success' => true,
            'view' => view('project.training_supervisor.my_students.ajax.my_student_ajax',['data'=>$data])->render()
        ]);
    }
}
