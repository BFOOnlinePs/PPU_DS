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
            });

            Route::group(['prefix'=>'users'],function(){
                Route::get('/index/{id}' , [App\Http\Controllers\UserController::class, 'index_id'])->name('admin.users.index_id');
                Route::get('/index' , [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
                Route::post('/create' , [App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');
                Route::get('/edit/{id}' , [App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');
                Route::post('/update' , [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
                Route::post('/search' , [App\Http\Controllers\UserController::class, 'search'])->name('admin.users.search');
                Route::get('/details/{id}' , [App\Http\Controllers\UserController::class, 'details'])->name('admin.users.details');
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
