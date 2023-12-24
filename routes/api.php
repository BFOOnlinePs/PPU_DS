<?php

use App\Http\Controllers\apisController\students\StudentAttendanceController;
use App\Http\Controllers\apisControllers\admin\AdminController;
use App\Http\Controllers\apisControllers\company_manager\CompaniesController;
use App\Http\Controllers\apisControllers\company_manager\company_trainees\CompanyTrainees;
use App\Http\Controllers\apisControllers\company_manager\company_trainees\manager_notes\ManagerNotes;
use App\Http\Controllers\apisControllers\sharedFunctions\CompaniesCategoriesController;
use App\Http\Controllers\apisControllers\sharedFunctions\FCMController;
use App\Http\Controllers\apisControllers\sharedFunctions\sharedController;
use App\Http\Controllers\apisControllers\students\student_log\studentLogController;
use App\Http\Controllers\apisControllers\students\StudentAttendanceController as StudentsStudentAttendanceController;
use App\Http\Controllers\apisControllers\students\StudentController;
use App\Http\Controllers\apisControllers\students\StudentCoursesController;
use App\Http\Controllers\apisControllers\students\StudentReportAttendanceController;
use App\Http\Controllers\apisControllers\students\studentReportController;
use App\Http\Controllers\apisControllers\students\studentTrainingsController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorMajors;
use App\Http\Controllers\apisControllers\supervisors\SupervisorMajorsController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorNotesController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorStudentsController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorStudentsTrainingsController;
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

// FCM
Route::post('/storeFcmUserToken', [FCMController::class, 'storeFcmUserToken']);
Route::post('/deleteFcmUserToken', [FCMController::class, 'deleteFcmUserToken']);
Route::post('/updateFcmUserToken', [FCMController::class, 'updateFcmUserToken']);


// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [sharedController::class, 'logout']);

    // user
    Route::post('/getUserById', [sharedController::class, 'getUserInfo']);

    // student trainings
    Route::get('/getStudentCompanies', [StudentController::class, 'index']);

    // student reports
    Route::post('/addStudentReport', [studentReportController::class, 'studentSubmitNewReport']);
    Route::post('/studentEditReport', [studentReportController::class, 'studentEditReport']);
    Route::post('/getStudentReportsDependOnAttendance', [StudentReportAttendanceController::class, 'getStudentReportsWithAttendance']);

    // student attendance
    Route::post('/recordStudentCheckIn', [StudentsStudentAttendanceController::class, 'studentCheckIn']);
    Route::post('/recordStudentCheckOut', [StudentsStudentAttendanceController::class, 'studentCheckOut']);
    Route::post('/checkTodayStudentAttendance', [StudentsStudentAttendanceController::class, 'checkTodayStudentAttendance']);

    // student log
    Route::post('/getAllStudentAttendanceLog', [studentLogController::class, 'getAllStudentAttendanceLog']);
    Route::post('/getAllStudentReportsLog', [studentLogController::class, 'getAllStudentReportsLog']);


    // add middleware
    // manager
    Route::post('getTrainees', [CompanyTrainees::class, 'getTrainees']);
    Route::post('getTraineeAttendanceLog', [CompanyTrainees::class, 'getTraineeAttendanceLog']);
    Route::post('getTraineeReportsLog', [CompanyTrainees::class, 'getTraineeReportsLog']);

    Route::get('getAllTraineesAttendanceLog', [CompanyTrainees::class, 'getAllTraineesAttendanceLog']);
    Route::get('getAllTraineesReportsLog', [CompanyTrainees::class, 'getAllTraineesReportsLog']);

    Route::post('managerAddOrEditReportNote', [ManagerNotes::class, 'managerAddOrEditReportNote']);
    // Route::post('managerEditNote', [ManagerNotes::class, 'managerEditNote']);


    // Supervisor
    Route::get('getSupervisorsMajors', [SupervisorMajorsController::class, 'getSupervisorsMajors']);
    Route::post('getSupervisorStudentsDependOnMajor', [SupervisorStudentsController::class, 'getSupervisorStudentsDependOnMajor']);
    Route::post('getStudentInfo', [SupervisorStudentsController::class, 'getStudentInfo']);
    Route::post('supervisorAddOrEditReportNote', [SupervisorNotesController::class, 'supervisorAddOrEditReportNote']);
    Route::get('getAllSupervisorStudentsAttendanceLog', [SupervisorStudentsController::class, 'getAllSupervisorStudentsAttendanceLog']);
    Route::get('getAllSupervisorStudentsReportsLog', [SupervisorStudentsController::class, 'getAllSupervisorStudentsReportsLog']);
    Route::get('getSupervisorStudentsCompanies', [SupervisorStudentsTrainingsController::class, 'getSupervisorStudentsCompanies']); // training places
    Route::post('getSupervisorStudentsInCompany', [SupervisorStudentsTrainingsController::class, 'getSupervisorStudentsInCompany']);

    // student courses
    Route::post('getStudentCoursesById', [StudentCoursesController::class, 'getStudentCoursesById']);
    Route::post('addStudentCourse', [StudentCoursesController::class, 'addStudentCourse']);
    Route::post('deleteStudentCourse', [StudentCoursesController::class, 'deleteStudentCourse']);
    Route::post('availableCoursesForStudent', [StudentCoursesController::class, 'availableCoursesForStudent']);


    // student trainings
    Route::post('getStudentTrainings', [studentTrainingsController::class, 'getStudentTrainings']);

    // courses => for supervisor
    Route::get('availableCourses', [sharedController::class, 'availableCourses']);

    // companies categories => for supervisor
    Route::post('getCompaniesCategories', [CompaniesCategoriesController::class, 'getCompaniesCategories']); // with search
    Route::post('addCompanyCategory', [CompaniesCategoriesController::class, 'addCompanyCategory']);
    Route::post('editCompanyCategory', [CompaniesCategoriesController::class, 'editCompanyCategory']);


    // just for test
    Route::get('/test', [sharedController::class, 'test']);
});
