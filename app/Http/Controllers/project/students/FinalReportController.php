<?php

namespace App\Http\Controllers\project\students;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class FinalReportController extends Controller
{
    public function index(){
        $registration = Registration::where('r_student_id',auth()->user()->u_id)->where('r_semester',SystemSetting::first()->ss_semester_type)->where('r_year',SystemSetting::first()->ss_year)->first();
        $setting = SystemSetting::first();
        return view('project.student.final_report.index',['registration'=>$registration , 'setting'=>$setting]);
    }

    public function create(Request $request){
        $system_setting = SystemSetting::first();
        $data = Registration::where('r_student_id',auth()->user()->u_id)->where('r_semester',$system_setting->ss_semester_type)->where('r_year',$system_setting->ss_year)->first();
        if ($request->hasFile('final_file')) {
            $file = $request->file('final_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension; // Unique filename
            $file->storeAs('uploads', $filename, 'public');
            $data->final_file = $filename;
        }
        if($data->save()){
            return redirect()->route('students.final_reports.index')->with(['success'=>'تم اضافة ال التقرير النهائي بنجاح']);
        }
    }
}
