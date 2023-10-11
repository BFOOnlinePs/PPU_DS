<?php

use Illuminate\Support\Facades\Route;

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
    if(auth()->check()){
        return redirect()->route('home');
    }
    else{
        return redirect('/login');
    }
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix'=>'project'],function(){
    Route::group(['prefix'=>'admin'],function(){


        Route::group(['prefix'=>'courses'],function(){
            Route::get('/index',[App\Http\Controllers\project\admin\CoursesController::class,'index'])->name('admin.courses.index');
            Route::post('/create',[App\Http\Controllers\project\admin\CoursesController::class,'create'])->name('admin.courses.create');
            Route::post('/update',[App\Http\Controllers\project\admin\CoursesController::class,'update'])->name('admin.courses.update');
            Route::post('/courseSearch',[App\Http\Controllers\project\admin\CoursesController::class,'courseSearch'])->name('admin.courses.courseSearch');
        });

        Route::group(['prefix'=>'users'],function(){
            Route::get('/browse' , [App\Http\Controllers\UserController::class, 'browse'])->name('browse.users');
            Route::post('/add' , [App\Http\Controllers\UserController::class, 'create'])->name('add.user');
            Route::post('/edit' , [App\Http\Controllers\UserController::class, 'edit'])->name('edit.user');
            Route::post('/update' , [App\Http\Controllers\UserController::class, 'update'])->name('update.user');
            Route::post('/status' , [App\Http\Controllers\UserController::class, 'status'])->name('change.status.account');
            Route::post('/edit_password' , [App\Http\Controllers\UserController::class, 'edit_pasword'])->name('id.reset.password');
            Route::post('/reset_pasword' , [App\Http\Controllers\UserController::class, 'reset_pasword'])->name('reset.password');
            Route::post('/browse_admin' , [App\Http\Controllers\UserController::class, 'browse_admin'])->name('browse.admin');
        });


        Route::group(['prefix'=>'majors'],function(){
                Route::get('/index',[App\Http\Controllers\project\admin\MajorsController::class,'index'])->name('admin.majors.index');
            Route::post('/create',[App\Http\Controllers\project\admin\MajorsController::class,'create'])->name('admin.majors.create');
        });
        });

    });

    Route::group(['prefix'=>'companies'],function(){

    });

    Route::group(['prefix'=>'company_trainer'],function(){

    });

    Route::group(['prefix'=>'mnd'],function(){

    });

    Route::group(['prefix'=>'students'],function(){

    });

    Route::group(['prefix'=>'supervisor_assistatns'],function(){

    });

    Route::group(['prefix'=>'supervisors'],function(){

    });

});
