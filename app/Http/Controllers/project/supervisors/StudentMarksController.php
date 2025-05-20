<?php

namespace App\Http\Controllers\project\supervisors;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\MajorSupervisor;
use App\Models\Registration;
use App\Models\StudentCompany;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class StudentMarksController extends Controller
{
    public function index()
    {
        $supervisors = User::where('u_role_id', 10)->get();
        $majors = Major::whereIn('m_id', function ($query) {
            $query->select('ms_major_id')
                ->from('major_supervisors')
                ->where('ms_super_id', auth()->user()->u_id);
        })->get();
        return view('project.supervisor.studnet_marks.index' , ['majors' => $majors, 'supervisors' => $supervisors]);
    }

    public function list_student_mark_ajax(Request $request)
    {
        $user = User::find(auth()->user()->u_id);

        $students = User::query()
            ->where('u_role_id', 2)
            ->whereIn('u_major_id', function ($query) {
                $query->select('ms_major_id')
                    ->from('major_supervisors')
                    ->where('ms_super_id', auth()->user()->u_id);
            });

        if ($request->filled('student_name')) {
            $student_search = $request->input('student_name');
            $students = $students->where('name', 'like', '%' . $student_search . '%');
        }

        if ($request->filled('company_name')) {
            $company_search = $request->input('company_name');
            $students = $students->whereIn('u_id', function ($query) use ($company_search) {
                $query->select('sc_student_id')->from('students_companies')
                    ->whereIn('sc_company_id', function ($query2) use ($company_search) {
                        $query2->select('c_id')->from('companies')
                            ->where('c_name', 'like', '%' . $company_search . '%');
                    });
            });
        }

        if ($request->filled('supervisor')) {
            $supervisor = $request->input('supervisor');
            $students = $students->whereIn('u_id', function ($query) use ($request) {
                $query->select('r_student_id')->from('registration')
                    ->where('supervisor_id', $request->input('supervisor'))
                    ->where('r_semester', SystemSetting::first()->ss_semester_type)
                    ->where('r_year', SystemSetting::first()->ss_year);
            });
        }

        $students = $students->get();

        $systemSetting = SystemSetting::first();

        foreach ($students as $student) {
            $registration = Registration::where('r_student_id', $student->u_id)
                ->where('r_semester', $systemSetting->ss_semester_type)
                ->where('r_year', $systemSetting->ss_year)
                ->first();

            $student->training_supervisor_marks = optional($registration)->university_score ?? '0';
            $student->company_marks = optional($registration)->company_score ?? '0';

            $studentCompany = StudentCompany::with('company')
                ->where('sc_student_id', $student->u_id)
                ->first();

            $student->company = optional(optional($studentCompany)->company)->c_name ?? 'لا يوجد شركة';
            $student->training_supervisor = optional(optional($registration)->supervisor_id)->name ?? 'لا يوجد مشرف';
        }

        return response()->json([
            'success' => 'true',
            'view' => view('project.supervisor.studnet_marks.ajax.students_mark', ['data' => $students])->render()
        ]);
    }
}
