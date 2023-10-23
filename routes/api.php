<?php

use App\Http\Controllers\apisControllers\admin\AdminController;
use App\Http\Controllers\apisControllers\company_manager\CompaniesController;
use App\Http\Controllers\apisControllers\sharedFunctions\sharedController;
use App\Http\Controllers\apisControllers\students\StudentController;
use App\Http\Controllers\apisControllers\students\StudentReportAttendanceController;
use App\Http\Controllers\apisControllers\students\studentReportController;
use App\Models\StudentCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// public routes
Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [sharedController::class, 'login']);

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [sharedController::class, 'logout']);

    //user
    Route::post('/getUserById', [sharedController::class, 'index']);

    //student
    Route::get('/getStudentCompanies', [StudentController::class, 'index']);
    Route::post('/addStudentReport', [studentReportController::class, 'add']);

    Route::post('/getStudentReportsDependOnAttendance', [StudentReportAttendanceController::class, 'index']);

    //company_manager
    Route::get('/list_student_in_company',[CompaniesController::class , 'list_student_in_company']);

    // just for test
    Route::get('/test', [sharedController::class, 'test']);
});
