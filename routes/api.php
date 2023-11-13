<?php

use App\Http\Controllers\apisController\students\StudentAttendanceController;
use App\Http\Controllers\apisControllers\admin\AdminController;
use App\Http\Controllers\apisControllers\company_manager\CompaniesController;
use App\Http\Controllers\apisControllers\sharedFunctions\FCMController;
use App\Http\Controllers\apisControllers\sharedFunctions\sharedController;
use App\Http\Controllers\apisControllers\students\StudentAttendanceController as StudentsStudentAttendanceController;
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

Route::get('/getFacebookLink', [sharedController::class, 'getFacebookLink']);
Route::get('/getInstagramLink', [sharedController::class, 'getInstagramLink']);

Route::post('/storeFcmUserToken', [FCMController::class, 'storeFcmUserToken']);


// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [sharedController::class, 'logout']);

    //user
    Route::post('/getUserById', [sharedController::class, 'getUserInfo']);

    //student
    Route::get('/getStudentCompanies', [StudentController::class, 'index']);

    Route::post('/addStudentReport', [studentReportController::class, 'studentSubmitNewReport']);
    Route::post('/studentEditReport', [studentReportController::class, 'studentEditReport']);

    Route::post('/getStudentReportsDependOnAttendance', [StudentReportAttendanceController::class, 'getStudentReportsWithAttendance']);

    Route::post('/recordStudentCheckIn', [StudentsStudentAttendanceController::class, 'studentCheckIn']);
    Route::post('/recordStudentCheckOut', [StudentsStudentAttendanceController::class, 'studentCheckOut']);
    Route::post('/checkTodayStudentAttendance', [StudentsStudentAttendanceController::class, 'checkTodayStudentAttendance']);

    //company_manager
    Route::get('/list_student_in_company',[CompaniesController::class , 'list_student_in_company']);

    // just for test
    Route::get('/test', [sharedController::class, 'test']);
});
