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
use App\Models\Company;
use App\Models\CompanyBranch;
use App\Models\CompanyDepartment;
use App\Models\StudentAttendance;
use App\Models\StudentCompany;
use Illuminate\Support\Facades\Storage;
use App\Models\MajorSupervisor;
use App\Models\Payment;
use App\Models\SemesterCourse;
use App\Models\StudentReport;
use App\Models\SupervisorAssistant;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function student_submit_report(Request $request)
    {
        $student_report = new StudentReport;
        $student_report->sr_student_attendance_id = $request->input('sa_id');
        if ($request->hasFile('file_report_student')) {
            $file = $request->file('file_report_student');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension; // Unique filename
            $file->storeAs('student_reports', $filename, 'public');
            $student_report->sr_attached_file = $filename;
            $student_report->save();
            // return response()->json(['html' => 'kdsljfdlkjd']);
        }
    }
    public function student_training_list($id)
    {
        $student_companies = StudentCompany::where('sc_student_id', $id)
                                            ->get();
        return view('project.admin.users.studentCompanyList' , ['student_companies' => $student_companies]);
    }
    public function report_student_edit(Request $request)
    {
        $student_report = StudentReport::find($request->sr_id);
        $student_report->sr_notes = $request->sr_notes;
        if($student_report->save()) {
            return response()->json([]);
        }
    }
    public function report_student_display(Request $request)
    {
        $student_report = StudentReport::where('sr_student_attendance_id' , $request->sa_id)->first();
        $modal = view('project.admin.users.modals.report_student' , ['student_report' => $student_report])->render();
        return response()->json(['modal' => $modal]);
    }
    public function supervisor_students_search_major(Request $request)
    {
        if(!isset($request->m_id)) {
            $ms_major_id = MajorSupervisor::where('ms_super_id' , $request->user_id)
                                    ->pluck('ms_major_id')
                                    ->toArray();
            $students = User::where('u_role_id' , 2)
                            ->whereIn('u_major_id' , $ms_major_id)
                            ->get();
        }
        else {
            $students = User::where('u_role_id' , 2)
                            ->where('u_major_id' , $request->m_id)
                            ->get();
        }
        $html = view('project.admin.users.ajax.supervisorStudentsList' , ['students' => $students])->render();
        return response()->json(['html' => $html]);
    }
    public function supervisor_students_search(Request $request)
    {
        $students = null;
        if(!isset($request->m_id)) {
            $ms_major_id = MajorSupervisor::where('ms_super_id' , $request->user_id)
                                            ->pluck('ms_major_id')
                                            ->toArray();
            $students = User::where('u_role_id' , 2)
                            ->whereIn('u_major_id' , $ms_major_id)
                            ->where('name', 'like', '%' . $request->word_to_search . '%');
            $students = $students->union(
                User::where('u_role_id' , 2)
                    ->whereIn('u_major_id' , $ms_major_id)
                    ->where('u_username', 'like', '%' . $request->word_to_search . '%')
            )->get();
        }
        else {
            $students = User::where('u_role_id' , 2)
                        ->where('u_major_id' , $request->m_id)
                        ->where('name', 'like', '%' . $request->word_to_search . '%');
            $students = $students->union(
            User::where('u_role_id' , 2)
                ->where('u_major_id' , $request->m_id)
                ->where('u_username', 'like', '%' . $request->word_to_search . '%')
            )->get();
        }
        $html = view('project.admin.users.ajax.supervisorStudentsList' , ['students' => $students])->render();
        return response()->json(['html' => $html]);
    }
    public function supervisor_major_delete(Request $request)
    {
        $major_supervisor_delete = MajorSupervisor::where('ms_id' , $request->ms_id)->delete();
        if($major_supervisor_delete > 0)
        {
            $data = MajorSupervisor::where('ms_super_id' , $request->user_id)->get();
            $html = view('project.admin.users.ajax.supervisorMajorList' , ['data' => $data])->render();
            $supervisor_majors_id = MajorSupervisor::where('ms_super_id' , $request->user_id)
                                            ->pluck('ms_major_id')
                                            ->toArray();
            $majors = Major::whereNotIn('m_id', $supervisor_majors_id)->get();
            $supervisor_assistants = User::where('u_role_id' , 4)->get();
            return response()->json(['html' => $html , 'majors' => $majors , 'supervisor_assistants' => $supervisor_assistants]);
        }
    }
    public function supervisor_major_add(Request $request)
    {
        $major_supervisor = new MajorSupervisor;
        $major_supervisor->ms_super_id = $request->user_id;
        $major_supervisor->ms_major_id = $request->major_id;
        if($major_supervisor->save())
        {
            $data = MajorSupervisor::where('ms_super_id' , $request->user_id)->get();
            $html = view('project.admin.users.ajax.supervisorMajorList' , ['data' => $data])->render();
            $supervisor_majors_id = MajorSupervisor::where('ms_super_id' , $request->user_id)
                                            ->pluck('ms_major_id')
                                            ->toArray();
            $majors = Major::whereNotIn('m_id', $supervisor_majors_id)->get();
            $supervisor_assistants = User::where('u_role_id' , 4)->get();
            return response()->json(['html' => $html , 'majors' => $majors , 'supervisor_assistants' => $supervisor_assistants]);
        }
    }
    public function student_payments($id)
    {
        $user = User::find($id);
        $payments = Payment::where('p_student_id', $id)->get();
        return view('project.admin.users.student_payments' , ['user' => $user , 'payments' => $payments]);
    }
    public function students_attendance($id)
    {
        $user = User::find($id);
        $student_company = StudentCompany::where('sc_student_id' , $id)
                            ->pluck('sc_id')
                            ->toArray();
        $student_attendances = StudentAttendance::where('sa_student_id', $id )
                            ->whereIn('sa_student_company_id', $student_company)
                            ->get();
        return view('project.admin.users.students_attendance' , ['id' => $id , 'user' => $user , 'student_attendances' => $student_attendances , 'student_report'=> null]);
    }
    public function training_place_delete_file_agreement($sc_id)
    {
        $studentCompany = StudentCompany::find($sc_id);
        if(Storage::exists('public/uploads/' . $studentCompany->sc_agreement_file))
        {
            Storage::delete('public/uploads/' . $studentCompany->sc_agreement_file);
        }
        $studentCompany->sc_agreement_file = null;
        if($studentCompany->save()) {
            return redirect()->back();
        }
    }
    public function training_place_update_file_agreement(Request $request)
    {
        $studentCompany = StudentCompany::find($request->id_company_student);
        if ($request->hasFile('file_company_student')) {
            $file = $request->file('file_company_student');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension; // Unique filename
            $file->storeAs('uploads', $filename, 'public');
            $studentCompany->sc_agreement_file = $filename;
        }
        if($studentCompany->save()) {
            $data = StudentCompany::where('sc_student_id' , $request->sc_student_id)
                                    ->where('sc_status', 1)
                                    ->get();
            $html = view('project.admin.users.ajax.placesTrainingList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
    public function training_place_delete(Request $request)
    {
        $student_company = StudentCompany::where('sc_id', $request->sc_id)->first();
        $student_company->sc_status = 0;
        if($student_company->save()) {
            $data = StudentCompany::where('sc_student_id' , $request->sc_student_id)
                                    ->where('sc_status', 1)
                                    ->get();
            $html = view('project.admin.users.ajax.placesTrainingList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
    public function places_training_add(Request $request)
    {
        $studentCompany = new StudentCompany;
        $studentCompany->sc_student_id = $request->id;
        $studentCompany->sc_company_id = $request->input('company');
        $studentCompany->sc_branch_id = $request->input('branch');
        $studentCompany->sc_department_id = $request->input('department');
        $studentCompany->sc_mentor_trainer_id = $request->input('trainer');
        $studentCompany->sc_assistant_id = $request->input('manager_assistant');
        $studentCompany->sc_status = 1;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension; // Unique filename
            $file->storeAs('uploads', $filename, 'public');
            $studentCompany->sc_agreement_file = $filename;
        }

        // Save the data to the database
        if($studentCompany->save()) {
            $data = StudentCompany::where('sc_student_id' , $request->id)
                                ->where('sc_status', 1)
                                ->get();
            $html = view('project.admin.users.ajax.placesTrainingList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
    }
    public function places_training_departments(Request $request)
    {
        $departments = CompanyDepartment::where('d_company_branch_id' , $request->branch_id)->get();
        return response()->json(['departments' => $departments]);
    }
    public function places_training_branches(Request $request)
    {
        $branches = CompanyBranch::where('b_company_id' , $request->company_id)->get();
        $trainers = User::where('u_company_id' , $request->company_id)->get();
        return response()->json(['branches' => $branches , 'trainers' => $trainers]);
    }
    public function places_training($id)
    {
        $user = User::find($id);
        $companies = Company::get();
        // to get المساعد الإداري
        $manager_assistants = User::where('u_role_id' , 4)->get();
        $data = StudentCompany::where('sc_student_id' , $id)
                            ->where('sc_status', 1)
                            ->get();
        return view('project.admin.users.places_training' , ['user' => $user , 'companies' => $companies , 'branches' => null , 'departments' => null , 'trainers' => null , 'manager_assistants' => $manager_assistants , 'data' => $data]);
    }
    public function courses_student_delete(Request $request)
    {
        $system_setting = SystemSetting::first();
        $deleted = Registration::where('r_student_id', $request->u_id)
                                ->where('r_course_id', $request->c_id)
                                ->where('r_semester' , $system_setting->ss_semester_type)
                                ->where('r_year' , $system_setting->ss_year)
                                ->delete();
        if($deleted > 0) {
            $data = Registration::where('r_student_id' , $request->u_id)
                                ->where('r_semester' , $system_setting->ss_semester_type)
                                ->where('r_year' , $system_setting->ss_year)
                                ->get();
            $html = view('project.admin.users.ajax.coursesList' , ['data' => $data])->render();
            $r_course_id = Registration::where('r_student_id' , $request->u_id)
                                            ->where('r_semester' , $system_setting->ss_semester_type)
                                            ->where('r_year' , $system_setting->ss_year)
                                            ->pluck('r_course_id')
                                            ->toArray();
            $semester_courses = SemesterCourse::whereNotIn('sc_course_id' , $r_course_id)
                                                ->pluck('sc_course_id')
                                                ->toArray();
            $courses = Course::whereIn('c_id' , $semester_courses)->get();
            return response()->json(['html' => $html , 'courses' => $courses]);
        }
    }
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
            $data = Registration::where('r_student_id' , $request->input('id'))
                                ->where('r_semester' , $system_setting->ss_semester_type)
                                ->where('r_year' , $system_setting->ss_year)
                                ->get();
            $html = view('project.admin.users.ajax.coursesList' , ['data' => $data])->render();
            $system_setting = SystemSetting::first();
            $r_course_id = Registration::where('r_student_id' , $request->input('id'))
                                            ->where('r_semester' , $system_setting->ss_semester_type)
                                            ->where('r_year' , $system_setting->ss_year)
                                            ->pluck('r_course_id')
                                            ->toArray();
            $semester_courses = SemesterCourse::whereNotIn('sc_course_id' , $r_course_id)
                                                ->pluck('sc_course_id')
                                                ->toArray();
            $courses = Course::whereIn('c_id' , $semester_courses)->get();
            $modal = view('project.admin.users.modals.add_courses_student' , ['courses' => $courses])->render();

            return response()->json(['html' => $html , 'modal' => $modal]);
        }
    }
    public function courses_student($id)
    {
        $user = User::find($id);
        $system_setting = SystemSetting::first();
        $r_course_id = Registration::where('r_student_id' , $id)
                                        ->where('r_semester' , $system_setting->ss_semester_type)
                                        ->where('r_year' , $system_setting->ss_year)
                                        ->pluck('r_course_id')
                                        ->toArray();
        $semester_courses = SemesterCourse::whereNotIn('sc_course_id' , $r_course_id)
                                            ->pluck('sc_course_id')
                                            ->toArray();
        $courses = Course::whereIn('c_id' , $semester_courses)->get();

        $data = Registration::where('r_student_id' , $id)
                                ->where('r_semester' , $system_setting->ss_semester_type)
                                ->where('r_year' , $system_setting->ss_year)
                                ->get();
        return view('project.admin.users.courese_student' , ['user' => $user , 'courses' => $courses , 'data' => $data]);
    }
    public function details($id)
    {
        $user = User::find($id);
        $company_id = Company::where('c_manager_id' , $id)
                                ->pluck('c_id')
                                ->toArray();
        $company = Company::where('c_manager_id' , $id)->first();
        $students = StudentCompany::whereIn('sc_company_id', $company_id)
                                    ->get();
        $supervisors_assistant = null;
        if($user->u_role_id == 4) {
            $supervisors_assistant = SupervisorAssistant::where('sa_assistant_id' , $user->u_id)
                                                        ->get();
        }
        return view('project.admin.users.details' , ['user' => $user , 'students' => $students , 'company' => $company , 'supervisors_assistant' => $supervisors_assistant]);
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
        $validatedData = $request->validate([
            'u_username' => 'required',
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->u_id , 'u_id'),
            ],
            'password' => 'nullable|min:8',
            'u_date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . Carbon::now()->format('Y-m-d'),
            ],
            'u_phone1' => 'required|digits:10',
            'u_phone2' => 'nullable|digits:10',
            'u_gender' => 'required'
        ],
        [
            'u_username.required' => __('translate.Username') // اسم المستخدم حقل مطلوب
            ,
            'name.required' => __('translate.Name field is required') // الاسم حقل مطلوب
            ,
            'email.required' => __('translate.Email field is required') // البريد الإلكتروني حقل مطلوب
            ,
            'email.email' => __('translate.Email must be a valid email address') // البريد الإلكتروني يجب أن يكون صالحًا
            ,
            'email.unique' => __('translate.Email is already taken') // البريد الإلكتروني موجود بالفعل
            ,
            'password.min' => __('translate.Password must be at least 8 characters long') // يجب أن تتكون كلمة المرور من 8  أرقام أو حروف
            ,
            'u_date_of_birth.required' => __('translate.Date of Birth field is required') // تاريخ الميلاد حقل مطلوب
            ,
            'u_date_of_birth.date' => __('translate.Date of Birth is in an invalid format') // صيغة تاريخ الميلاد غير صالحة
            ,
            'u_date_of_birth.before_or_equal' => __('translate.Date of Birth must be before or equal to today') // يجب أن يكون تاريخ الميلاد في الماضي
            ,
            'u_phone1.required' => __('translate.Phone number field is required') // رقم الجوال حقل مطلوب
            ,
            'u_phone1.digits' => __('translate.Phone number must be exactly 10 digits') // يجب أن يتكون رقم الجوال من عشرة أرقام فقط
            ,
            'u_phone2.digits' => __('translate.Secondary phone number must be exactly 10 digits') // يجب أن يتكون رقم الجوال الاحتياطي من عشرة أرقام فقط
            ,
            'u_gender' => __('translate.Gender must be Male or Female') // يجب اختيار ذكر أو أنثى
        ]
        );
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
        else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة أثناء تحديث البيانات.'])->withInput();
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

        return view('project.admin.users.index', [
            'data' => $data,
            'roles' => $roles,
            'u_role_id' => null,
            'major' => $major,
            'role_name' => null
        ]);
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'u_username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'u_date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . Carbon::now()->format('Y-m-d'),
            ],
            'u_phone1' => 'required|digits:10',
            'u_phone2' => 'nullable|digits:10',
            'u_gender' => 'required'
        ],
        [
            'u_username.required' => 'اسم المستخدم حقل مطلوب',
            'name.required' => 'الاسم حقل مطلوب' ,
            'email.required' => 'البريد الإلكتروني حقل مطلوب',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صالحا.',
            'email.unique' => 'البريد الإلكتروني موجود بالفعل',
            'password.required' => 'كلمة المرور حقل مطلوب',
            'password.min' => ' يجب أن تتكون كلمة المرور من 8  أرقام أو حروف',
            'u_date_of_birth.required' => 'تاريخ الميلاد حقل مطلوب',
            'u_date_of_birth.date' => 'صيغة تاريخ الميلاد غير صالحة',
            'u_date_of_birth.before_or_equal' => 'يجب أن يكون تاريخ الميلاد في الماضي',
            'u_phone1.required' => 'رقم الجوال حقل مطلوب',
            'u_phone1.digits' => 'يجب أن يتكون رقم الجوال من عشرة أرقام فقط',
            'u_phone2.digits' => 'يجب أن يتكون رقم الجوال الاحتياطي من عشرة أرقام فقط',
            'u_gender' => 'يجب اختيار ذكر أو أنثى'
        ]
        );
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
        $user->u_role_id = $request->u_role_id;
        if (isset($request->u_major_id)) {
            $user->u_major_id = $request->u_major_id;
        }
        else {
            $user->u_major_id = null;
        }
        if($user->save()) {
            $data = User::where('u_role_id', $request->u_role_id)->get();
            $html = view('project.admin.users.ajax.usersList' , ['data' => $data])->render();
            return response()->json(['html' => $html]);
        }
        return response()->json(['errors' => ['Save failed']]);
    }
    public function check_email_not_duplicate(Request $request)
    {
        $user_email = User::where('email', $request->email)->first();
        if($user_email) {
            return response()->json(['status' => 'true']);
        }
        else {
            return response()->json(['status' => 'false']);
        }
    }
    public function searchStudentByName(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->value . '%')
                        ->pluck('u_id')
                        ->toArray();
        $company_id = Company::where('c_manager_id' , $request->user_id)
                                ->pluck('c_id')
                                ->toArray();
        $students = StudentCompany::whereIn('sc_company_id', $company_id)
                                    ->whereIn('sc_student_id' , $users)
                                    ->get();
        $html = view('project.admin.users.includes.student' , ['students' => $students])->render();
        return response()->json(['html' => $html]);
    }
}
