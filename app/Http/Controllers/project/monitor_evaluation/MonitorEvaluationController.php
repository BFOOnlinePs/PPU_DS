<?php

namespace App\Http\Controllers\project\monitor_evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SemesterCourse;
use App\Models\SystemSetting;
use App\Models\Company;
use App\Models\StudentCompany;
use App\Models\Registration;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use App\Models\CompaniesCategory;


class MonitorEvaluationController extends Controller
{
    //
    public function index(){
        return view('project.monitor_evaluation.index');
    }

    public function companiesReport(){

        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;
        $companies = Company::where('c_id',0)->get();

        $data = Company::with('manager','companyCategories')->get();

        $categories = CompaniesCategory::get();

        foreach($data as $key){
            $studentsTotal = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
                $query->select('r_student_id')
                    ->from('registration')
                    ->where('r_year', $year)
                    ->where('r_semester', $semester)
                    ->distinct();
            })
            ->where('sc_status', 1)
            ->where('sc_company_id',$key->c_id)
            ->select('sc_student_id')
            ->distinct()
            ->get();
            $key->studentsTotal = count($studentsTotal);
            $companies = $data->filter(function ($item) {
                return $item->studentsTotal > 0;
            });
        }

        return view('project.monitor_evaluation.companiesReport',['data'=>$companies, 'semester'=>$semester,'categories'=>$categories]);
    }

    public function companiesReportSearch(Request $request){
        $semester = $request->semester;
        $companyType = null;
        $companyCategory = null;
        $companies = Company::where('c_id',0)->get();

        $systemSettings = SystemSetting::first();
        $year = $systemSettings->ss_year;

        $categories = CompaniesCategory::get();

        if($request->companyType != 0 && $request->companyCategory != 0){ //هون بكون ببحث عن النوع والتصنيف
            $companyType = $request->companyType;
            $companyCategory = $request->companyCategory;
            $data = Company::with('manager','companyCategories')->where('c_category_id',$companyCategory)
            ->where('c_type',$companyType)
            ->get();
        }
        else if($request->companyCategory != 0){ //هون بكون ببحث عن تصنيف الشركة
            $companyCategory = $request->companyCategory;
            $data = Company::with('manager','companyCategories')->where('c_category_id',$companyCategory)->get();
        }
        else if($request->companyType != 0){ //هون بكون ببحث عن نوع الشركة
            $companyType = $request->companyType;
            $data = Company::with('manager','companyCategories')->where('c_type',$companyType)->get();
        }
        else if($companyType == 0 && $companyCategory == 0){ //هون بكون ببحث عن الفصل لحال
            $data = Company::with('manager','companyCategories')->get();
        }


        foreach($data as $key){
            if($semester != 0){
                $studentsTotal = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
                    $query->select('r_student_id')
                        ->from('registration')
                        ->where('r_year', $year)
                        ->where('r_semester', $semester)
                        ->distinct();
                })
                ->where('sc_status', 1)
                ->where('sc_company_id',$key->c_id)
                ->select('sc_student_id')
                ->distinct()
                ->get();
            }else{
                $studentsTotal = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
                    $query->select('r_student_id')
                    ->from('registration')
                    ->distinct();
                })
                ->where('sc_status', 1)
                ->where('sc_company_id',$key->c_id)
                ->select('sc_student_id')
                ->distinct()
                ->get();
            }
            $key->studentsTotal = count($studentsTotal);
            $companies = $data->filter(function ($item) {
                return $item->studentsTotal > 0;
            });
        }

        // return view('project.monitor_evaluation.ajax.companiesReportTable',['data'=>$data, 'semester'=>$semester,'categories'=>$categories]);

        return response()->json([
            'success'=>'true',
            'view'=>view('project.monitor_evaluation.ajax.companiesReportTable',['data'=>$companies, 'semester'=>$semester,'categories'=>$categories])->render()
        ]);

    }

    public function semesterReport(){
        $years = SemesterCourse::distinct()->pluck('sc_year')->toArray();
        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;


        $coursesStudentsTotal = count(Registration::where('r_year',$year)
        ->where('r_semester',$semester)
        ->select('r_student_id')
        ->distinct()
        ->get());

        $companiesTotal = count(Company::get());

        // $semesterCompaniesTotal = count(Company::whereIn('r_student_id', function ($query) use ($year, $semester) {
        //     $query->select('r_student_id')
        //         ->from('registration')
        //         ->where('r_year', $year)
        //         ->where('r_semester', $semester)
        //         ->distinct();
        // }));




        $semesterCompanies = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })
        ->where('sc_status', 1)
        ->select('sc_company_id')
        ->get();

        $semesterCompaniesTotal = count(Company::whereIn('c_id',$semesterCompanies)->get());


        $semesterCoursesTotal = count(SemesterCourse::where('sc_semester',$semester)->where('sc_year',$year)->get());

        $attendanceRows = StudentAttendance::whereIn('sa_student_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })->whereNotNull('sa_out_time')
        ->get();

        $hours = 0;
        $minutes = 0;

        foreach ($attendanceRows as $attendance) {
            $timeIn = Carbon::parse($attendance->sa_in_time);
            $timeOut = Carbon::parse($attendance->sa_out_time);

            $duration = $timeOut->diff($timeIn);

            $hours = $hours + $duration->format('%h');
            $minutes = $minutes + $duration->format('%i');

        }


        $hoursFromMinutes = (int)($minutes/60);
        $trainingHoursTotal= $hours + $hoursFromMinutes;
        $trainingMinutesTotal= $minutes - ($hoursFromMinutes*60);

        // $traineesTotal = count(StudentCompany::
        // where('sc_status',1)
        // ->select('sc_student_id')
        // ->distinct()
        // ->get());

        $traineesTotal = count(StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })->where('sc_status',1)
        ->select('sc_student_id')
        ->distinct()
        ->get());

        return view('project.monitor_evaluation.semesterReport',['years'=>$years,'year'=>$year,'semester'=>$semester,'semesterCompaniesTotal'=>$semesterCompaniesTotal,
        'coursesStudentsTotal'=>$coursesStudentsTotal,'companiesTotal'=>$companiesTotal,'semesterCoursesTotal'=>$semesterCoursesTotal,
        'traineesTotal'=>$traineesTotal,'trainingMinutesTotal'=>$trainingMinutesTotal, 'trainingHoursTotal'=>$trainingHoursTotal]);
    }

    public function semesterReportAjax(Request $request){

        $semester = $request->semester;
        $year = $request->year;

        $coursesStudentsTotal = count(Registration::where('r_year',$year)
        ->where('r_semester',$semester)
        ->select('r_student_id')
        ->distinct()
        ->get());

        $companiesTotal = count(Company::get());


        $semesterCompanies = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })
        ->where('sc_status', 1)
        ->select('sc_company_id')
        ->get();

        $semesterCompaniesTotal = count(Company::whereIn('c_id',$semesterCompanies)->get());


        $semesterCoursesTotal = count(SemesterCourse::where('sc_semester',$semester)->where('sc_year',$year)->get());

        $attendanceRows = StudentAttendance::whereIn('sa_student_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })->whereNotNull('sa_out_time')
        ->get();

        $hours = 0;
        $minutes = 0;

        foreach ($attendanceRows as $attendance) {
            $timeIn = Carbon::parse($attendance->sa_in_time);
            $timeOut = Carbon::parse($attendance->sa_out_time);

            $duration = $timeOut->diff($timeIn);

            $hours = $hours + $duration->format('%h');
            $minutes = $minutes + $duration->format('%i');

        }


        $hoursFromMinutes = (int)($minutes/60);
        $trainingHoursTotal= $hours + $hoursFromMinutes;
        $trainingMinutesTotal= $minutes - ($hoursFromMinutes*60);

        // $traineesTotal = count(StudentCompany::
        // where('sc_status',1)
        // ->select('sc_student_id')
        // ->distinct()
        // ->get());

        $traineesTotal = count(StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })->where('sc_status',1)
        ->select('sc_student_id')
        ->distinct()
        ->get());

        return response()->json([
            'success'=>'true',
            'view'=>view('project.monitor_evaluation.ajax.semesterReportTable',[
            'coursesStudentsTotal'=>$coursesStudentsTotal,'companiesTotal'=>$companiesTotal,'semesterCoursesTotal'=>$semesterCoursesTotal,'semesterCompaniesTotal'=>$semesterCompaniesTotal,
            'traineesTotal'=>$traineesTotal,'trainingMinutesTotal'=>$trainingMinutesTotal, 'trainingHoursTotal'=>$trainingHoursTotal])->render(),
            'semester'=>$semester,'year'=>$year
        ]);

    }
}
