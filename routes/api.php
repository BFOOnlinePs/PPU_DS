<?php

use App\Http\Controllers\apisController\students\StudentAttendanceController;
use App\Http\Controllers\apisControllers\admin\AdminController;
use App\Http\Controllers\apisControllers\company_manager\CompaniesController;
use App\Http\Controllers\apisControllers\company_manager\company_trainees\CompanyTrainees;
use App\Http\Controllers\apisControllers\company_manager\company_trainees\manager_notes\ManagerNotes;
use App\Http\Controllers\apisControllers\company_manager\payments\AllTraineesPaymentsController;
use App\Http\Controllers\apisControllers\company_manager\payments\TraineePaymentsController;
use App\Http\Controllers\apisControllers\monitoring_evaluation_officer\CompaniesPaymentsReportController;
use App\Http\Controllers\apisControllers\monitoring_evaluation_officer\PaymentsReportController;
use App\Http\Controllers\apisControllers\monitoring_evaluation_officer\SemesterReportController;
use App\Http\Controllers\apisControllers\monitoring_evaluation_officer\StudentCompanyPaymentsDetailsReportController;
use App\Http\Controllers\apisControllers\monitoring_evaluation_officer\TrainingHoursReportController;
use App\Http\Controllers\apisControllers\program_coordinator\majors\ProgramCoordinatorMajorsController;
use App\Http\Controllers\apisControllers\program_coordinator\students\ProgramCoordinatorStudentsController;
use App\Http\Controllers\apisControllers\program_coordinator\students_trainings\ProgramCoordinatorStudentsTrainingsController;
use App\Http\Controllers\apisControllers\sharedFunctions\add_edit_company\AddCompanyController;
use App\Http\Controllers\apisControllers\sharedFunctions\add_edit_company\editCompanyController;
use App\Http\Controllers\apisControllers\sharedFunctions\all_students\all_students_attendance;
use App\Http\Controllers\apisControllers\sharedFunctions\all_students\all_students_reports;
use App\Http\Controllers\apisControllers\sharedFunctions\announcements\AnnouncementsController;
use App\Http\Controllers\apisControllers\sharedFunctions\CollageYearsController;
use App\Http\Controllers\apisControllers\sharedFunctions\CompaniesCategoriesController;
use App\Http\Controllers\apisControllers\sharedFunctions\CompaniesController as SharedFunctionsCompaniesController;
use App\Http\Controllers\apisControllers\sharedFunctions\CurrenciesController;
use App\Http\Controllers\apisControllers\sharedFunctions\FCMController;
use App\Http\Controllers\apisControllers\sharedFunctions\sharedController;
use App\Http\Controllers\apisControllers\sharedFunctions\system\CollageYearsController as SystemCollageYearsController;
use App\Http\Controllers\apisControllers\sharedFunctions\system\CurrentYearAndSemesterController;
use App\Http\Controllers\apisControllers\students\payments\StudentPaymentsController;
use App\Http\Controllers\apisControllers\students\student_log\studentLogController;
use App\Http\Controllers\apisControllers\students\StudentAttendanceController as StudentsStudentAttendanceController;
use App\Http\Controllers\apisControllers\students\StudentController;
use App\Http\Controllers\apisControllers\students\StudentCoursesController;
use App\Http\Controllers\apisControllers\students\StudentReportAttendanceController;
use App\Http\Controllers\apisControllers\students\studentReportController;
use App\Http\Controllers\apisControllers\students\studentTrainingsController;
use App\Http\Controllers\apisControllers\supervisors\payments\PaymentsController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorMajors;
use App\Http\Controllers\apisControllers\supervisors\SupervisorMajorsController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorNotesController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorStudentsController;
use App\Http\Controllers\apisControllers\supervisors\SupervisorStudentsTrainingsController;
use App\Models\AnnouncementModel;
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
    Route::post('getTrainees', [CompanyTrainees::class, 'getTrainees']); // return student company
    Route::post('getTraineeAttendanceLog', [CompanyTrainees::class, 'getTraineeAttendanceLog']);
    Route::post('getTraineeReportsLog', [CompanyTrainees::class, 'getTraineeReportsLog']);
    Route::post('getTraineesWithSearch', [CompanyTrainees::class, 'getTraineesWithSearch']);


    Route::get('getAllTraineesAttendanceLog', [CompanyTrainees::class, 'getAllTraineesAttendanceLog']);
    Route::get('getAllTraineesReportsLog', [CompanyTrainees::class, 'getAllTraineesReportsLog']);

    Route::post('managerAddOrEditReportNote', [ManagerNotes::class, 'managerAddOrEditReportNote']);

    // Route::post('managerEditNote', [ManagerNotes::class, 'managerEditNote']);


    // Supervisor
    Route::get('getSupervisorsMajors', [SupervisorMajorsController::class, 'getSupervisorsMajors'])->middleware('CheckUserRole:3');
    Route::post('getSupervisorStudentsDependOnMajor', [SupervisorStudentsController::class, 'getSupervisorStudentsDependOnMajor'])->middleware('CheckUserRole:3');
    Route::post('getStudentInfo', [SupervisorStudentsController::class, 'getStudentInfo']);
    Route::post('supervisorAddOrEditReportNote', [SupervisorNotesController::class, 'supervisorAddOrEditReportNote'])->middleware('CheckUserRole:3');
    Route::get('getAllSupervisorStudentsAttendanceLog', [SupervisorStudentsController::class, 'getAllSupervisorStudentsAttendanceLog'])->middleware('CheckUserRole:3');
    Route::get('getAllSupervisorStudentsReportsLog', [SupervisorStudentsController::class, 'getAllSupervisorStudentsReportsLog'])->middleware('CheckUserRole:3');
    Route::get('getSupervisorStudentsCompanies', [SupervisorStudentsTrainingsController::class, 'getSupervisorStudentsCompanies'])->middleware('CheckUserRole:3'); // training places
    Route::post('getSupervisorStudentsInCompany', [SupervisorStudentsTrainingsController::class, 'getSupervisorStudentsInCompany'])->middleware('CheckUserRole:3');

    // student courses
    Route::post('getStudentCoursesById', [StudentCoursesController::class, 'getStudentCoursesById']); // all student courses, for supervisor
    Route::post('addStudentCourse', [StudentCoursesController::class, 'addStudentCourse']);
    Route::post('deleteStudentCourse', [StudentCoursesController::class, 'deleteStudentCourse']);
    Route::post('availableCoursesForStudent', [StudentCoursesController::class, 'availableCoursesForStudent']);
    Route::post('getStudentCourseRegistrations', [StudentCoursesController::class, 'getStudentCourseRegistrations']);


    // student trainings
    Route::post('getStudentTrainings', [studentTrainingsController::class, 'getStudentTrainings']);
    Route::post('registerStudentInTraining', [studentTrainingsController::class, 'registerStudentInTraining']); // for supervisor
    Route::post('updateStudentRegistrationInTraining', [studentTrainingsController::class, 'updateStudentRegistrationInTraining']);
    Route::post('getCompanyBranchesWithEmployees', [studentTrainingsController::class, 'getCompanyBranchesWithEmployees']);
    Route::post('getBranchDepartments', [studentTrainingsController::class, 'getBranchDepartments']);
    Route::get('getAllCompaniesWithSearch', [studentTrainingsController::class, 'getAllCompaniesWithSearch']);
    Route::get('getAllAssistants', [studentTrainingsController::class, 'getAllAssistants']);

    // courses => for supervisor
    Route::get('availableCourses', [sharedController::class, 'availableCourses']);

    // companies categories => for supervisor
    Route::post('getCompaniesCategories', [CompaniesCategoriesController::class, 'getCompaniesCategories']); // with search
    Route::post('addCompanyCategory', [CompaniesCategoriesController::class, 'addCompanyCategory']);
    Route::post('editCompanyCategory', [CompaniesCategoriesController::class, 'editCompanyCategory']);

    // payments => for manager
    Route::post('addTraineePayment', [TraineePaymentsController::class, 'addTraineePayment']);
    Route::post('getTraineePayments', [TraineePaymentsController::class, 'getTraineePayments']);
    Route::post('getAllTraineesPayments', [AllTraineesPaymentsController::class, 'getAllTraineesPayments']);

    // payments => for student
    Route::get('getAllStudentPayments', [StudentPaymentsController::class, 'getAllStudentPayments']);
    Route::post('studentChangePaymentStatus', [StudentPaymentsController::class, 'studentChangePaymentStatus']);
    Route::post('studentAddOrEditPaymentNote', [StudentPaymentsController::class, 'studentAddOrEditPaymentNote']);

    // payments => for supervisor
    Route::post('getStudentPayments', [PaymentsController::class, 'getStudentPayments']);
    Route::post('supervisorAddOrEditPaymentNote', [PaymentsController::class, 'supervisorAddOrEditPaymentNote']);

    // payments => for manager, supervisor and student
    Route::post('getStudentCompanyPayments', [StudentPaymentsController::class, 'getStudentCompanyPayments']);


    // program coordinator
    Route::post('getAllStudentsDependOnMajor', [ProgramCoordinatorStudentsController::class, 'getAllStudentsDependOnMajor']);
    Route::get('getAllMajors', [ProgramCoordinatorMajorsController::class, 'getAllMajors']);
    Route::get('getStudentsCompanies', [ProgramCoordinatorStudentsTrainingsController::class, 'getStudentsCompanies']);
    Route::post('getAllStudentsInCompany', [ProgramCoordinatorStudentsTrainingsController::class, 'getAllStudentsInCompany']);
    Route::post('getStudentsRegisteredForTraining', [ProgramCoordinatorStudentsController::class, 'getStudentsRegisteredForTraining']);


    // add company => for supervisor and coordinator
    Route::post('createManagerAndHisCompany', [AddCompanyController::class, 'createManagerAndHisCompany']);
    Route::post('updateCompanyAddingCategoryAndType', [AddCompanyController::class, 'updateCompanyAddingCategoryAndType']);
    Route::post('addCompanyDepartments', [AddCompanyController::class, 'addCompanyDepartments']);
    Route::post('addCompanyBranches', [AddCompanyController::class, 'addCompanyBranches']);
    Route::post('getCompanyDepartments', [AddCompanyController::class, 'getCompanyDepartments']);

    // edit company => for supervisor and coordinator
    Route::post('getCompanyAndManagerInfo', [editCompanyController::class, 'getCompanyAndManagerInfo']);
    Route::post('updateCompanyAndManagerInfo', [editCompanyController::class, 'updateCompanyAndManagerInfo']);
    Route::post('getCompanyDepartments', [editCompanyController::class, 'getCompanyDepartments']);
    Route::post('addNewCompanyDepartment', [editCompanyController::class, 'addNewCompanyDepartment']);
    Route::post('editCompanyDepartmentName', [editCompanyController::class, 'editCompanyDepartmentName']);
    Route::post('getCompanyBranches', [editCompanyController::class, 'getCompanyBranches']); // + i use it with semester report
    Route::post('addNewCompanyBranch', [editCompanyController::class, 'addNewCompanyBranch']);
    Route::post('editCompanyBranch', [editCompanyController::class, 'editCompanyBranch']);

    // Monitoring and Evaluation Officer
    Route::get('getSemesterReport', [SemesterReportController::class, 'getSemesterReport']);
    Route::get('getTrainingHoursReport', [TrainingHoursReportController::class, 'getTrainingHoursReport']);
    Route::get('getCompaniesPaymentsReport', [CompaniesPaymentsReportController::class, 'getCompaniesPaymentsReport']);
    Route::post('getTrainingPaymentsDetails', [StudentCompanyPaymentsDetailsReportController::class, 'getTrainingPaymentsDetails']);
    Route::get('getAllPayments', [PaymentsReportController::class, 'getAllPayments']);
    Route::get('getStudentsNamesWithSearch', [PaymentsReportController::class, 'getStudentsNamesWithSearch']);

    // all students
    Route::get('getAllStudentsAttendance', [all_students_attendance::class, 'getAllStudentsAttendance']);
    Route::get('getAllStudentsReports', [all_students_reports::class, 'getAllStudentsReports']);


    // announcements
    Route::get('getAllActiveAnnouncements', [AnnouncementsController::class, 'getAllActiveAnnouncements']);
    Route::post('addNewAnnouncement', [AnnouncementsController::class, 'addNewAnnouncement']);
    Route::get('getAllAnnouncements', [AnnouncementsController::class, 'getAllAnnouncements']);
    Route::get('getUserAnnouncements', [AnnouncementsController::class, 'getUserAnnouncements']);
    Route::put('announcements/{announcement_id}/a_status',  [AnnouncementsController::class, 'changeAnnouncementStatus']);


    // system
    Route::get('getCollageYears', [SystemCollageYearsController::class, 'getCollageYears']);
    Route::get('getCurrentYearAndSemester', [CurrentYearAndSemesterController::class, 'getCurrentYearAndSemester']);


    // companies
    Route::get('getAllCompanies', [SharedFunctionsCompaniesController::class, 'getAllCompanies']);

    // currencies
    Route::get('getCurrencies', [CurrenciesController::class, 'getCurrencies']);

    // file test
    Route::post('/fileUpload', [sharedController::class, 'fileUpload']);


    // just for test
    Route::get('/test', [sharedController::class, 'test']);
});
