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


    Route::group(['prefix'=>'project'],function(){
    Route::group(['prefix'=>'admin'],function(){


        Route::group(['prefix'=>'courses'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\CoursesController::class,'index'])->name('admin.courses.index');
            Route::post('/create',[App\Http\Controllers\project\admin\CoursesController::class,'create'])->name('admin.courses.create');
            Route::post('/update',[App\Http\Controllers\project\admin\CoursesController::class,'update'])->name('admin.courses.update');
            Route::post('/courseSearch',[App\Http\Controllers\project\admin\CoursesController::class,'courseSearch'])->name('admin.courses.courseSearch');
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
                Route::get('/supervisor/majors/{id}' , [App\Http\Controllers\UserController::class , 'supervisor_majors'])->name('admin.users.supervisor.majors'); // To show majors to academic supervisor
                Route::post('/supervisor/major/add' , [App\Http\Controllers\UserController::class , 'supervisor_major_add'])->name('admin.users.supervisor.major.add'); // To add major to academic supervisor
                Route::post('/supervisor/major/delete' , [App\Http\Controllers\UserController::class, 'supervisor_major_delete'])->name('admin.users.supervisor.major.delete'); // To delete major to academic supervisor
                Route::get('/supervisor/students/{id}' , [App\Http\Controllers\UserController::class , 'supervisor_students'])->name('admin.users.supervisor.sutdents'); // To display supervisor's students
                Route::post('/supervisor/students/search' , [App\Http\Controllers\UserController::class, 'supervisor_students_search'])->name('admin.users.supervisor.students.search'); // To make search by username and name to supervisor's students
                Route::post('/supervisor/students/search/major' , [App\Http\Controllers\UserController::class , 'supervisor_students_search_major'])->name('admin.users.supervisor.students.search.major'); // To make filter for major in academic supervisor
                Route::post('/report/student/display' , [App\Http\Controllers\UserController::class , 'report_student_display'])->name('admin.users.report.student.display'); // To show report of student in modal
                Route::post('/report/student/edit' , [App\Http\Controllers\UserController::class , 'report_student_edit'])->name('admin.users.report.student.edit'); // To submit notes of supervisor to student report
                Route::get('/student/companies/list/{id}' , [App\Http\Controllers\UserController::class , 'student_companies_list'])->name('student.companies.list'); // To display list of companies student for student
                Route::get('/student/training/list/{id}' , [App\Http\Controllers\UserController::class , 'student_training_list'])->name('student.training.list'); // To display list of trainings student for student
                Route::get('/student/training/company/{id}' , [App\Http\Controllers\UserController::class , 'student_training_company'])->name('student.training.company'); // To show the page for specific company to make attendance for student (time in , time out , submit report , show notes of supervisor to student report)
                Route::post('/student/submit/attendance' , [App\Http\Controllers\UserController::class , 'student_submit_attendance'])->name('student.submit.attendance'); // To submit student time attendance (sa_in_time)
                Route::post('/student/submit/departure' , [App\Http\Controllers\UserController::class , 'student_submit_departure'])->name('student.submit.departure');
                Route::post('/student/submit/report' , [App\Http\Controllers\UserController::class , 'student_submit_report'])->name('student.submit.report');
            });


        Route::group(['prefix'=>'majors'],function(){
                Route::get('/index',[App\Http\Controllers\project\admin\MajorsController::class,'index'])->name('admin.majors.index');
                Route::post('/create',[App\Http\Controllers\project\admin\MajorsController::class,'create'])->name('admin.majors.create');
                Route::post('/update',[App\Http\Controllers\project\admin\MajorsController::class,'update'])->name('admin.majors.update');
                Route::post('/search',[App\Http\Controllers\project\admin\MajorsController::class,'search'])->name('admin.majors.search');
        });

        Route::group(['prefix'=>'companies_categories'],function(){
                Route::get('/index',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'index'])->name('admin.companies_categories.index');
                Route::post('/create',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'create'])->name('admin.companies_categories.create');
                Route::post('/update',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'update'])->name('admin.companies_categories.update');
                Route::post('/companies_categories_search',[App\Http\Controllers\project\admin\CompaniesCategoriesController::class,'companies_categories_search'])->name('admin.companies_categories.companies_categories_search');
        });

        Route::group(['prefix'=>'companies'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\CompaniesController::class,'index'])->name('admin.companies.index');
            Route::get('/company',[App\Http\Controllers\project\admin\CompaniesController::class,'company'])->name('admin.companies.company');
        });

        });
    });

    Route::group(['prefix' => 'companies'], function () {
    });

    Route::group(['prefix' => 'company_trainer'], function () {
    });

    Route::group(['prefix' => 'mnd'], function () {
    });

    Route::group(['prefix' => 'students'], function () {
    });

    Route::group(['prefix' => 'supervisor_assistatns'], function () {
    });

    Route::group(['prefix' => 'supervisors'], function () {
    });
});
