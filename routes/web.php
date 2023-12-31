<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    } else {
        return redirect('/login');
    }
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/language/{locale}', function($locale) {
        if(in_array($locale , ['en', 'ar'])) {
            session()->put('locale' , $locale);
        }
        return redirect()->back();
    })->name('language');


    Route::group(['prefix'=>'project'],function(){
    Route::group(['prefix'=>'admin'],function(){

        Route::group(['prefix'=>'registration'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\RegistrationController::class,'index'])->name('admin.registration.index');
            Route::get('/CourseStudents/{id}',[App\Http\Controllers\project\admin\RegistrationController::class,'CourseStudents'])->name('admin.registration.CourseStudents');
            Route::get('/SemesterStudents',[App\Http\Controllers\project\admin\RegistrationController::class,'SemesterStudents'])->name('admin.registration.semesterStudents');
        });


        Route::group(['prefix'=>'courses'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\CoursesController::class,'index'])->name('admin.courses.index');
            Route::post('/create',[App\Http\Controllers\project\admin\CoursesController::class,'create'])->name('admin.courses.create');
            Route::post('/update',[App\Http\Controllers\project\admin\CoursesController::class,'update'])->name('admin.courses.update');
            Route::post('/couseSearch',[App\Http\Controllers\project\admin\CoursesController::class,'courseSearch'])->name('admin.courses.courseSearch');
            Route::post('/checkrCourseCode',[App\Http\Controllers\project\admin\CoursesController::class,'checkCourseCode'])->name('admin.courses.checkCourseCode');
            Route::get('/loadCourses',[App\Http\Controllers\project\admin\CoursesController::class,'getCourses'])->name('admin.courses.loadMoreCourses');
        });

        Route::group(['prefix'=>'semesterCourses'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\SemesterCoursesController::class,'index'])->name('admin.semesterCourses.index');
            Route::post('/create',[App\Http\Controllers\project\admin\SemesterCoursesController::class,'create'])->name('admin.semesterCourses.create');
            Route::post('/delete',[App\Http\Controllers\project\admin\SemesterCoursesController::class,'delete'])->name('admin.semesterCourses.delete');
            Route::post('/search',[App\Http\Controllers\project\admin\SemesterCoursesController::class,'search'])->name('admin.semesterCourses.search');
            Route::post('/courseSearch',[App\Http\Controllers\project\admin\SemesterCoursesController::class,'courseNameSearch'])->name('admin.semesterCourses.courseNameSearch');
        });


        Route::group(['prefix'=>'users'],function(){
            Route::get('/index/{id}' , [App\Http\Controllers\UserController::class, 'index_id'])->name('admin.users.index_id');
            Route::get('/index' , [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
            Route::post('/create' , [App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');
            Route::get('/edit/{id}' , [App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');
            Route::post('/update' , [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
            Route::post('/search' , [App\Http\Controllers\UserController::class, 'search'])->name('admin.users.search');
            Route::get('/details/{id}' , [App\Http\Controllers\UserController::class, 'details'])->name('admin.users.details');
            Route::get('/courses/student/{id}' , [App\Http\Controllers\UserController::class, 'courses_student'])->name('admin.users.courses.student');
            Route::post('/courses/student/add' , [App\Http\Controllers\UserController::class, 'courses_student_add'])->name('admin.users.courses.student.add');
            Route::get('/places/training/{id}' , [App\Http\Controllers\UserController::class, 'places_training'])->name('admin.users.places.training');
            Route::post('/courses/student/delete' , [App\Http\Controllers\UserController::class, 'courses_student_delete'])->name('admin.users.courses.student.delete');
            Route::post('/places/training/branches' , [App\Http\Controllers\UserController::class, 'places_training_branches'])->name('admin.users.places.training.branches');
            Route::post('/places/training/departments' , [App\Http\Controllers\UserController::class, 'places_training_departments'])->name('admin.users.places.training.departments');
            Route::post('/places/training/add' , [App\Http\Controllers\UserController::class, 'places_training_add'])->name('admin.users.places.training.add');
            Route::post('/training/place/delete' , [App\Http\Controllers\UserController::class, 'training_place_delete'])->name('admin.users.training.place.delete');
            Route::post('/training/place/update/file_agreement' , [App\Http\Controllers\UserController::class, 'training_place_update_file_agreement'])->name('admin.users.training.place.update.file_agreement');
            Route::get('/training/place/delete/file_agreement/{sc_id}' , [App\Http\Controllers\UserController::class, 'training_place_delete_file_agreement'])->name('admin.users.training.place.delete.file_agreement');
            Route::get('/students/attendance/{id}' , [App\Http\Controllers\UserController::class, 'students_attendance'])->name('admin.users.students.attendance');
            Route::get('/student/payments/{id}' , [App\Http\Controllers\UserController::class, 'student_payments'])->name('admin.users.student.payments');
            Route::post('/supervisor/major/add' , [App\Http\Controllers\UserController::class , 'supervisor_major_add'])->name('admin.users.supervisor.major.add'); // To add major to academic supervisor
            Route::post('/supervisor/major/delete' , [App\Http\Controllers\UserController::class, 'supervisor_major_delete'])->name('admin.users.supervisor.major.delete'); // To delete major to academic supervisor
            Route::post('/supervisor/students/search' , [App\Http\Controllers\UserController::class, 'supervisor_students_search'])->name('admin.users.supervisor.students.search'); // To make search by username and name to supervisor's students
            Route::post('/supervisor/students/search/major' , [App\Http\Controllers\UserController::class , 'supervisor_students_search_major'])->name('admin.users.supervisor.students.search.major'); // To make filter for major in academic supervisor
            Route::post('/report/student/display' , [App\Http\Controllers\UserController::class , 'report_student_display'])->name('admin.users.report.student.display'); // To show report of student in modal
            Route::post('/report/student/edit' , [App\Http\Controllers\UserController::class , 'report_student_edit'])->name('admin.users.report.student.edit'); // To submit notes of supervisor to student report
            Route::post('/check_email_not_duplicate' , [App\Http\Controllers\UserController::class , 'check_email_not_duplicate'])->name('users.add.check_email_not_duplicate');
            Route::group(['prefix'=>'company_manager'],function(){
                Route::post('/searchStudentByName' , [App\Http\Controllers\UserController::class , 'searchStudentByName'])->name('users.company_manager.searchStudentByName');
            });
            Route::group(['prefix'=>'supervisor_assistatns'],function(){
                Route::post('/create' , [App\Http\Controllers\project\admin\supervisorAssistatnsController::class, 'create'])->name('admin.assistant.create');
                Route::post('/showSelectSupervisor' , [App\Http\Controllers\project\admin\supervisorAssistatnsController::class, 'show_select_for_supervisor'])->name('admin.assistant.showSelectSupervisor');
                Route::post('/deleteSupervisor' , [App\Http\Controllers\project\admin\supervisorAssistatnsController::class, 'deleteSupervisor'])->name('admin.assistant.deleteSupervisor');
            });
        });


        Route::group(['prefix'=>'majors'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\MajorsController::class,'index'])->name('admin.majors.index');
            Route::post('/create',[App\Http\Controllers\project\admin\MajorsController::class,'create'])->name('admin.majors.create');
            Route::post('/update',[App\Http\Controllers\project\admin\MajorsController::class,'update'])->name('admin.majors.update');
            Route::post('/search',[App\Http\Controllers\project\admin\MajorsController::class,'search'])->name('admin.majors.search');
            Route::post('/addSuperVisor',[App\Http\Controllers\project\admin\MajorsController::class,'addSuperVisor'])->name('admin.majors.addSuperVisor');
            Route::post('/updateSuperVisor',[App\Http\Controllers\project\admin\MajorsController::class,'updateSuperVisor'])->name('admin.majors.updateSuperVisor');
            Route::post('/checkMajorCode',[App\Http\Controllers\project\admin\MajorsController::class,'checkMajorCode'])->name('admin.majors.checkMajorCode');

         });


            Route::group(['prefix'=>'companies_categories'],function(){
                Route::get('/index',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'index'])->name('admin.companies_categories.index');
                Route::post('/create',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'create'])->name('admin.companies_categories.create');
                Route::post('/update',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'update'])->name('admin.companies_categories.update');
                Route::post('/companies_categories_search',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'companies_categories_search'])->name('admin.companies_categories.companies_categories_search');
            });

        Route::group(['prefix'=>'companies'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\CompaniesController::class,'index'])->name('admin.companies.index');
            Route::post('/companySearch',[App\Http\Controllers\project\admin\CompaniesController::class,'companySearch'])->name('admin.companies.companySearch');
            Route::get('/company',[App\Http\Controllers\project\admin\CompaniesController::class,'company'])->name('admin.companies.company');
            Route::post('/create',[App\Http\Controllers\project\admin\CompaniesController::class,'create'])->name('admin.companies.create');
            Route::get('/edit/{id}',[App\Http\Controllers\project\admin\CompaniesController::class,'edit'])->name('admin.companies.edit');
            Route::post('/updateCompany',[App\Http\Controllers\project\admin\CompaniesController::class,'updateCompany'])->name('admin.companies.updateCompany');
            Route::post('/createBranches',[App\Http\Controllers\project\admin\CompaniesController::class,'createBranches'])->name('admin.companies.createBranches');
            Route::post('/createBranchesEdit',[App\Http\Controllers\project\admin\CompaniesController::class,'createBranchesEdit'])->name('admin.companies.createBranchesEdit');
            Route::post('/checkCompany',[App\Http\Controllers\project\admin\CompaniesController::class,'checkCompany'])->name('admin.companies.checkCompany');
            Route::post('/companySummary',[App\Http\Controllers\project\admin\CompaniesController::class,'companySummary'])->name('admin.companies.companySummary');
            Route::get('/showCompanyInfo',[App\Http\Controllers\project\admin\CompaniesController::class,'showCompanyInfo'])->name('admin.companies.showCompanyInfo');
            Route::post('/update',[App\Http\Controllers\project\admin\CompaniesController::class,'update'])->name('admin.companies.update');
            Route::post('/updateDepartments',[App\Http\Controllers\project\admin\CompaniesController::class,'updateDepartments'])->name('admin.companies.updateDepartments');
            Route::post('/addDepartment',[App\Http\Controllers\project\admin\CompaniesController::class,'addDepartment'])->name('admin.companies.addDepartment');
            Route::post('/createDepartments',[App\Http\Controllers\project\admin\CompaniesController::class,'createDepartments'])->name('admin.companies.createDepartments');
            Route::post('/updateBranches',[App\Http\Controllers\project\admin\CompaniesController::class,'updateBranches'])->name('admin.companies.updateBranches');
            Route::post('/checkEmailEdit',[App\Http\Controllers\project\admin\CompaniesController::class,'checkEmailEdit'])->name('admin.companies.check_email_not_duplicate_edit');

        });

        });
        Route::group(['prefix'=>'settings'],function(){
            Route::get('/', function () {
                return view('project.admin.settings.index');
            })->name('admin.settings');
            Route::get('/coloring',[App\Http\Controllers\project\settings\SettingsController::class,'index'])->name('admin.color.index');
            Route::post('/primary_background_color',[App\Http\Controllers\project\settings\SettingsController::class,'primary_background_color'])->name('admin.color.primary_background_color');
            Route::post('/primary_font_color',[App\Http\Controllers\project\settings\SettingsController::class,'primary_font_color'])->name('admin.color.primary_font_color');

            Route::get('/integration',[App\Http\Controllers\project\settings\SettingsController::class,'integration'])->name('integration');
            Route::post('/uploadFileExcel',[App\Http\Controllers\project\settings\SettingsController::class,'uploadFileExcel'])->name('integration.uploadFileExcel');
            Route::post('/validateStepOne',[App\Http\Controllers\project\settings\SettingsController::class,'validateStepOne'])->name('integration.validateStepOne');
            Route::post('/submitForm',[App\Http\Controllers\project\settings\SettingsController::class,'submitForm'])->name('integration.submitForm');

            Route::get('/systemSettings',[App\Http\Controllers\project\settings\SettingsController::class,'systemSettings'])->name('admin.settings.systemSettings');
            Route::post('/systemSettingsUpdate',[App\Http\Controllers\project\settings\SettingsController::class,'systemSettingsUpdate'])->name('admin.settings.systemSettingsUpdate');

            Route::get('/deleteData',[App\Http\Controllers\project\settings\SettingsController::class,'deleteData'])->name('admin.settings.deleteData');
            Route::post('/confirmDelete',[App\Http\Controllers\project\settings\SettingsController::class,'confirmDelete'])->name('admin.settings.confirmDelete');
        });
    });

    Route::group(['prefix' => 'companies'], function () {
    });

    Route::group(['prefix' => 'company_trainer'], function () {
    });
    Route::group(['prefix' => 'communications_manager_with_companies'], function () {
        Route::group(['prefix' => 'students'], function () {
            Route::get('/index' , [App\Http\Controllers\project\communications_manager_with_companies\students\StudentsController::class, 'index'])->name('communications_manager_with_companies.students.index');
            Route::post('/search' , [App\Http\Controllers\project\communications_manager_with_companies\students\StudentsController::class, 'search'])->name('communications_manager_with_companies.students.search');
        });
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/index' , [App\Http\Controllers\project\communications_manager_with_companies\companies\CompaniesController::class, 'index'])->name('communications_manager_with_companies.companies.index');
            Route::get('/students/{id}' , [App\Http\Controllers\project\communications_manager_with_companies\companies\CompaniesController::class , 'students'])->name('communications_manager_with_companies.companies.students'); // To display students
        });
    });

    Route::group(['prefix' => 'monitor_evaluation'], function () {
        Route::get('/index' , [App\Http\Controllers\project\monitor_evaluation\MonitorEvaluationController::class, 'index'])->name('monitor_evaluation.index');
        Route::get('/semesterReport' , [App\Http\Controllers\project\monitor_evaluation\MonitorEvaluationController::class, 'semesterReport'])->name('monitor_evaluation.semesterReport');
        Route::get('/companiesReport' , [App\Http\Controllers\project\monitor_evaluation\MonitorEvaluationController::class, 'companiesReport'])->name('monitor_evaluation.companiesReport');
        Route::post('/semesterReportAjax' , [App\Http\Controllers\project\monitor_evaluation\MonitorEvaluationController::class, 'semesterReportAjax'])->name('monitor_evaluation.semesterReportAjax');
        Route::post('/companiesReportSearch' , [App\Http\Controllers\project\monitor_evaluation\MonitorEvaluationController::class, 'companiesReportSearch'])->name('monitor_evaluation.companiesReportSearch');

    });

    Route::group(['prefix' => 'company_manager'], function () {
        Route::group(['prefix' => 'students'], function () {
            Route::group(['prefix' => 'reports'], function () {
                Route::get('/index/{id}' , [App\Http\Controllers\project\company_manager\students\report\ReportController::class, 'index'])->name('company_manager.students.reports.index');
                Route::post('/add' , [App\Http\Controllers\project\company_manager\students\report\ReportController::class, 'addNotes'])->name('company_manager.students.reports.addNotes');
                Route::post('/show' , [App\Http\Controllers\project\company_manager\students\report\ReportController::class, 'showNotes'])->name('company_manager.students.reports.showNotes');
                Route::post('/report' , [App\Http\Controllers\project\company_manager\students\report\ReportController::class, 'showReport'])->name('company_manager.students.reports.showReport');
            });
            Route::group(['prefix' => 'attendance'], function () {
                Route::get('/index/{id}' , [App\Http\Controllers\project\company_manager\students\attendance\AttendanceController::class, 'index'])->name('company_manager.students.attendance.index');
                Route::post('/index' , [App\Http\Controllers\project\company_manager\students\attendance\AttendanceController::class, 'index_ajax'])->name('company_manager.students.attendance.index_ajax');

            });
            Route::group(['prefix' => 'payments'], function () {
                Route::get('/index/{id}/{name_student}' , [App\Http\Controllers\project\company_manager\students\payments\PaymentsController::class, 'index'])->name('company_manager.students.payments.index');
                Route::post('/create' , [App\Http\Controllers\project\company_manager\students\payments\PaymentsController::class, 'create'])->name('company_manager.students.payments.create');
            });
            Route::get('/index' , [App\Http\Controllers\project\company_manager\students\StudentController::class, 'index'])->name('company_manager.students.index');
        });
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/index' , [App\Http\Controllers\project\company_manager\payments\PaymentsController::class, 'index'])->name('company_manager.payments.index');
        });
        Route::group(['prefix' => 'records'], function () {
            Route::get('/index' , [App\Http\Controllers\project\company_manager\records\RecordsController::class, 'index'])->name('company_manager.records.index');
            Route::post('/search' , [App\Http\Controllers\project\company_Manager\records\RecordsController::class, 'search'])->name('company_manager.records.search');
        });

    });
    Route::group(['prefix' => 'students'], function () {
        Route::group(['prefix' => 'personal_profile'], function () {
            Route::get('/index' , [App\Http\Controllers\project\students\personal_profile\PersonalProfileController::class, 'index'])->name('students.personal_profile.index');  // To display personal profile for this student
        });
        Route::group(['prefix' => 'company'], function () {
            Route::get('/index' , [App\Http\Controllers\project\students\company\CompanyController::class , 'index'])->name('students.company.index'); // To display list of companies student for student
            Route::group(['prefix' => 'attendance'], function () {
                Route::get('/index/{id}', [App\Http\Controllers\project\students\attendance\AttendanceController::class , 'index_for_specific_company'])->name('students.company.attendance.index_for_specific_student'); // To show the page for specific company to make attendance for student (time in , time out , submit report , show notes of supervisor to student report)
                Route::post('/select' , [App\Http\Controllers\project\students\attendance\AttendanceController::class , 'ajax_company_from_to'])->name('students.attendance.ajax_company_from_to');
            });
        });
        Route::group(['prefix' => 'attendance'], function () {
            Route::group(['prefix' => 'report'], function () {
                Route::get('/edit/{sa_id}' , [App\Http\Controllers\project\students\attendance\report\ReportController::class , 'edit'])->name('students.attendance.report.edit'); // To creat or edit report student
                Route::post('/submit' , [App\Http\Controllers\project\students\attendance\report\ReportController::class , 'submit'])->name('students.attendance.report.submit'); // To submit report student
                Route::post('/upload' , [App\Http\Controllers\project\students\attendance\report\ReportController::class , 'upload'])->name('students.attendance.report.upload'); // To upload report student
            });
            Route::get('/index' , [App\Http\Controllers\project\students\attendance\AttendanceController::class , 'index'])->name('students.attendance.index'); // To show the page for specific company to make attendance for student (time in , time out , submit report , show notes of supervisor to student report)
            Route::post('/create_attendance' , [App\Http\Controllers\project\students\attendance\AttendanceController::class , 'create_attendance'])->name('students.attendance.create_attendance'); // To submit student attendance
            Route::post('/create_departure' , [App\Http\Controllers\project\students\attendance\AttendanceController::class , 'create_departure'])->name('students.attendance.create_departure'); // To submit student departure
        });
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/index' , [App\Http\Controllers\project\students\payments\PaymentsController::class, 'index'])->name('students.payments.index');
            Route::post('/confirm' , [App\Http\Controllers\project\students\payments\PaymentsController::class, 'confirmByAjax'])->name('student.payments.confirmByAjax');
        });
    });

    Route::group(['prefix' => 'supervisor_assistatns'], function () {
        Route::group(['prefix' => 'majors'], function () {
            Route::get('/index/{id}' , [App\Http\Controllers\project\supervisor_assistants\MajorsController::class , 'index'])->name('supervisor_assistants.majors.index'); // To show majors to supervisor assistant
        });
        Route::group(['prefix' => 'students'], function () {
            Route::get('/index/{ms_major_id?}' , [App\Http\Controllers\project\supervisor_assistants\StudentsController::class , 'index'])->name('supervisor_assistants.students.index');
            Route::post('/search' , [App\Http\Controllers\project\supervisor_assistants\StudentsController::class , 'search'])->name('supervisor_assistants.students.search');
        });
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/index' , [App\Http\Controllers\project\supervisor_assistants\CompaniesController::class , 'index'])->name('supervisor_assistants.companies.index');
            Route::get('/students/{id}' , [App\Http\Controllers\project\supervisor_assistants\CompaniesController::class , 'students'])->name('supervisor_assistants.companies.students'); // To display students
        });
    });

    Route::group(['prefix' => 'supervisors'], function () {
        Route::group(['prefix' => 'majors'], function () {
            Route::get('/index/{id}' , [App\Http\Controllers\project\supervisors\MajorsController::class , 'index'])->name('supervisors.majors.index'); // To show majors to academic supervisor
        });
        Route::group(['prefix' => 'students'], function () {
            Route::get('/index/{id}/{ms_major_id?}' , [App\Http\Controllers\project\supervisors\StudentsController::class , 'index'])->name('supervisors.students.index'); // To display supervisor's students
        });
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/index' , [App\Http\Controllers\project\supervisors\CompaniesController::class , 'index'])->name('supervisors.companies.index'); // To display companies
            Route::get('/students/{id}' , [App\Http\Controllers\project\supervisors\CompaniesController::class , 'students'])->name('supervisors.companies.students'); // To display students
        });
        Route::group(['prefix' => 'assistant'], function () {
            Route::get('/index/{id}' , [App\Http\Controllers\project\supervisors\AssistantController::class , 'index'])->name('supervisors.assistant.index');
            Route::post('/create' , [App\Http\Controllers\project\supervisors\AssistantController::class , 'create'])->name('supervisors.assistant.create');
            Route::post('/delete' , [App\Http\Controllers\project\supervisors\AssistantController::class , 'delete'])->name('supervisors.assistant.delete');
        });
    });
});

Route::get('generate', function () {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        echo 'ok';
    });

