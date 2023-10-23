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
