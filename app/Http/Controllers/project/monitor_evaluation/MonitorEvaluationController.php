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
use App\Models\Payment;
use App\Models\Currency;
use PDF;
use Illuminate\Support\Collection;
use App\Models\User;

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
            // $studentsTotal = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
            //     $query->select('r_student_id')
            //         ->from('registration')
            //         ->where('r_year', $year)
            //         ->where('r_semester', $semester)
            //         ->distinct();
            // })
            $studentsTotal = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
                $query->select('r_id')
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
                // $studentsTotal = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
                $studentsTotal = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
                    $query->select('r_id')
                        ->from('registration')
                        ->where('r_year', $year)
                        ->where('r_semester', $semester)
                        ->distinct();
                })
                // ->where('sc_status', 1)
                ->where('sc_company_id',$key->c_id)
                ->select('sc_student_id')
                ->distinct()
                ->get();
            }else{
                // $studentsTotal = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
                $studentsTotal = StudentCompany::
                // whereIn('sc_registration_id', function ($query) use ($year, $semester) {
                //     $query->select('r_id')
                //     ->from('registration')
                //     ->distinct();
                // })
                // ->where('sc_status', 1)
                // ->
                where('sc_company_id',$key->c_id)
                ->select('sc_student_id')
                ->distinct()
                ->get();
            }
            $key->studentsTotal = count($studentsTotal);
            $companies = $data->filter(function ($item) {
                return $item->studentsTotal > 0;
            });
        }

        return response()->json([
            'success'=>'true',
            'data'=> base64_encode(serialize($companies)),
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

        // $semesterCompanies = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
        $semesterCompanies = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
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

        // $traineesTotal = count(StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
        $traineesTotal = count(StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })->where('sc_status',1)
        ->select('sc_student_id')
        ->distinct()
        ->get());

        if($semester==1){
            $semesterText = __('translate.First Semester Report');
        }else if($semester==2){
             $semesterText = __('translate.Second Semester Report');
        }else{
             $semesterText = __('translate.Summer Semester Report');
        }

        $yearText = __('translate.for Academic Year') . " " . $year;
        $concatenatedText = $semesterText . " " . $yearText;

        $data = [
            'title' => $concatenatedText,
            'semesterCompaniesTotal' => $semesterCompaniesTotal,
            'coursesStudentsTotal' => $coursesStudentsTotal,
            'companiesTotal'=>$companiesTotal,
            'semesterCoursesTotal'=>$semesterCoursesTotal,
            'traineesTotal'=>$traineesTotal,
            'trainingMinutesTotal'=>$trainingMinutesTotal,
            'trainingHoursTotal'=>$trainingHoursTotal
        ];

        return view('project.monitor_evaluation.semesterReport',['years'=>$years,'year'=>$year,'semester'=>$semester,'semesterCompaniesTotal'=>$semesterCompaniesTotal,
        'coursesStudentsTotal'=>$coursesStudentsTotal,'companiesTotal'=>$companiesTotal,'semesterCoursesTotal'=>$semesterCoursesTotal,
        'traineesTotal'=>$traineesTotal,'trainingMinutesTotal'=>$trainingMinutesTotal, 'trainingHoursTotal'=>$trainingHoursTotal, 'pdf'=> $data]);
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

        // $semesterCompanies = StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
        $semesterCompanies = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
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

        // $traineesTotal = count(StudentCompany::whereIn('sc_student_id', function ($query) use ($year, $semester) {
        $traineesTotal = count(StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester)
                ->distinct();
        })->where('sc_status',1)
        ->select('sc_student_id')
        ->distinct()
        ->get());


        if($semester==1){
           $semesterText = __('translate.First Semester Report');
        }else if($semester==2){
            $semesterText = __('translate.Second Semester Report');
        }else{
            $semesterText = __('translate.Summer Semester Report');
        }

        $yearText = __('translate.for Academic Year') . " " . $year;
        $concatenatedText = $semesterText . " " . $yearText;

        $data = [
            'title' => $concatenatedText,
            'semesterCompaniesTotal' => $semesterCompaniesTotal,
            'coursesStudentsTotal' => $coursesStudentsTotal,
            'companiesTotal'=>$companiesTotal,
            'semesterCoursesTotal'=>$semesterCoursesTotal,
            'traineesTotal'=>$traineesTotal,
            'trainingMinutesTotal'=>$trainingMinutesTotal,
            'trainingHoursTotal'=>$trainingHoursTotal
        ];

        $data = base64_encode(serialize($data));

        return response()->json([
            'success'=>'true',
            'view'=>view('project.monitor_evaluation.ajax.semesterReportTable',[
            'coursesStudentsTotal'=>$coursesStudentsTotal,'companiesTotal'=>$companiesTotal,'semesterCoursesTotal'=>$semesterCoursesTotal,'semesterCompaniesTotal'=>$semesterCompaniesTotal,
            'traineesTotal'=>$traineesTotal,'trainingMinutesTotal'=>$trainingMinutesTotal, 'trainingHoursTotal'=>$trainingHoursTotal])->render(),
            'semester'=>$semester,'year'=>$year, 'pdf'=> $data
        ]);

    }

    public function semesterReportPDF($data){

        $pdfData = unserialize(base64_decode($data));
        $pdf = PDF::loadView('project.monitor_evaluation.pdf.semesterReportPDF', $pdfData);

        // Use the stream method to open the PDF in a new tab
        return $pdf->stream('semesterReport.pdf');
    }

    public function companiesReportPDF(Request $request){
        //return $request->test;

        $pdfData = unserialize(base64_decode($request->test));
        //return $pdfData;
        $pdf = PDF::loadView('project.monitor_evaluation.pdf.companiesReportPDF', ['data'=>$pdfData]);

        // Use the stream method to open the PDF in a new tab
        return $pdf->stream('semesterReport.pdf');
    }

    public function companiesPaymentsReport(){
        $years = SemesterCourse::distinct()->pluck('sc_year')->toArray();
        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;

        $companiesID = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
                        $query->select('r_id')
                        ->from('registration')
                        ->where('r_year', $year)
                        ->where('r_semester', $semester)
                        ->distinct();
                    })
                    ->where('sc_status', 1)
                    ->select('sc_company_id')
                    ->distinct()
                    ->get();

        $companies = Company::whereIn('c_id', $companiesID)->get();

        $trainingIDs = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
                ->from('registration')
                ->where('r_year', $year)
                ->where('r_semester', $semester);
        })
        ->select('sc_id')
        ->get();

        $endIDs = Payment::whereIn('p_student_company_id', $trainingIDs)
        ->get()
        ->unique('p_student_company_id')
        ->pluck('p_student_company_id');


        $currencies = Currency::select('c_id','c_symbol')->get();

        $paymentCollection = new Collection();

        foreach($endIDs as $test){

            //هون عندي كل الدفعات اللي للتدريب هاد
            $paymentsForTrain = Payment::with('userStudent', 'payments')->where('p_student_company_id', $test)->get();

            //بدي احط اوبجيكت جديد عشان احط فيه حقول جديدة
            $objectToreturnView = $paymentsForTrain->first();

            $currunciesKeysToCheck = Currency::select('c_id')->pluck('c_id')->toArray();

            $paymentsTotalCollection = new Collection();
            $approvedPaymentsTotalCollection = new Collection();

            foreach($currunciesKeysToCheck as $key){
                $currencyTotal = $paymentsForTrain->where('p_currency_id',$key)->sum('p_payment_value');//هون بعطيني المجموع لكل عملة واذا ما كانت موجودة بعطي 0
                $paymentsTotalCollection->add(['c_id' => $key, 'total' => $currencyTotal, 'symbol'=>$currencies->where('c_id',$key)->first()->c_symbol]);

                $currencyApprovedTotal = $paymentsForTrain->where('p_currency_id',$key)->where('p_status',1)->sum('p_payment_value');//هون بعطيني المجموع لكل عملة واذا ما كانت موجودة بعطي 0
                $approvedPaymentsTotalCollection->add(['c_id' => $key, 'total' => $currencyApprovedTotal, 'symbol'=>$currencies->where('c_id',$key)->first()->c_symbol]);
            }

            $objectToreturnView->paymentsTotalCollection = $paymentsTotalCollection;
            $objectToreturnView->approvedPaymentsTotalCollection = $approvedPaymentsTotalCollection;

            $paymentCollection->add($objectToreturnView);

        }

        return view('project.monitor_evaluation.companiesPaymentsReport',['years'=>$years,'year'=>$year,'semester'=>$semester,'companies'=>$companies,'companiesPayments'=>$paymentCollection]);

    }

    public function companyPaymentDetailes(Request $request){

        $trainingPayment = unserialize(base64_decode($request->test));

        $trainingID = Payment::where('p_id',$trainingPayment->p_id)->select('p_student_company_id')->get()->first()->p_student_company_id;

        $trainingPayments = Payment::with('userStudent', 'payments','currency')->where('p_student_company_id',$trainingID)->get();


        return view('project.monitor_evaluation.companyPaymentDetailes',['payments'=>$trainingPayments,'trainingPayment'=>$trainingPayment]);
    }

    public function companiesPaymentsSearch(Request $request){

        $company_id = $request->company;
        $semester = $request->semester;
        $year = $request->year;

        if($company_id != 0){//يعني هون ببحث عن شركة

            //التدريبات التي تنتمي إلى هذا الفصل والعام والشركة
            $trainingIDs = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
                $query->select('r_id')
                    ->from('registration')
                    ->where('r_year', $year)
                    ->where('r_semester', $semester);
            })
            ->where('sc_company_id', $company_id)
            ->select('sc_id')
            ->get();



        }else{
            $trainingIDs = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
                $query->select('r_id')
                    ->from('registration')
                    ->where('r_year', $year)
                    ->where('r_semester', $semester);
            })
            ->select('sc_id')
            ->get();
        }

        $endIDs = Payment::whereIn('p_student_company_id', $trainingIDs)
        ->get()
        ->unique('p_student_company_id')
        ->pluck('p_student_company_id');


        $currencies = Currency::select('c_id','c_symbol')->get();

        $paymentCollection = new Collection();

        foreach($endIDs as $test){

            //هون عندي كل الدفعات اللي للتدريب هاد
            $paymentsForTrain = Payment::with('userStudent', 'payments')->where('p_student_company_id', $test)->get();

            //بدي احط اوبجيكت جديد عشان احط فيه حقول جديدة
            $objectToreturnView = $paymentsForTrain->first();

            $currunciesKeysToCheck = Currency::select('c_id')->pluck('c_id')->toArray();

            $paymentsTotalCollection = new Collection();
            $approvedPaymentsTotalCollection = new Collection();

            foreach($currunciesKeysToCheck as $key){
                $currencyTotal = $paymentsForTrain->where('p_currency_id',$key)->sum('p_payment_value');//هون بعطيني المجموع لكل عملة واذا ما كانت موجودة بعطي 0
                $paymentsTotalCollection->add(['c_id' => $key, 'total' => $currencyTotal, 'symbol'=>$currencies->where('c_id',$key)->first()->c_symbol]);

                $currencyApprovedTotal = $paymentsForTrain->where('p_currency_id',$key)->where('p_status',1)->sum('p_payment_value');//هون بعطيني المجموع لكل عملة واذا ما كانت موجودة بعطي 0
                $approvedPaymentsTotalCollection->add(['c_id' => $key, 'total' => $currencyApprovedTotal, 'symbol'=>$currencies->where('c_id',$key)->first()->c_symbol]);
            }

            $objectToreturnView->paymentsTotalCollection = $paymentsTotalCollection;
            $objectToreturnView->approvedPaymentsTotalCollection = $approvedPaymentsTotalCollection;

            $paymentCollection->add($objectToreturnView);

        }


        return response()->json([
            'success'=>'true',
            'data'=>$paymentCollection,
            'view'=>view('project.monitor_evaluation.ajax.companiesPaymentsReportTable',['companiesPayments'=>$paymentCollection])->render(),
        ]);
    }

    public function paymentsReport(){

        $years = SemesterCourse::distinct()->pluck('sc_year')->toArray();
        $systemSettings = SystemSetting::first();

        $semester = $systemSettings->ss_semester_type;
        $year = $systemSettings->ss_year;

        $trainingIDs = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
            ->from('registration')
            ->where('r_year', $year)
            ->where('r_semester', $semester)
            ->distinct();
        })
        ->where('sc_status', 1)
        ->select('sc_id')
        ->distinct()
        ->get();

        $companiesID = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
            ->from('registration')
            ->where('r_year', $year)
            ->where('r_semester', $semester)
            ->distinct();
        })
        ->where('sc_status', 1)
        ->select('sc_company_id')
        ->distinct()
        ->get();

        $companies = Company::whereIn('c_id', $companiesID)->get();
        $payments = Payment::with('userStudent', 'payments','currency')->whereIn('p_student_company_id',$trainingIDs)->get();

        $students = User::whereIn('u_id', function ($query) use ($year, $semester) {
            $query->select('r_student_id')
            ->from('registration')
            ->where('r_year', $year)
            ->where('r_semester', $semester)
            ->distinct();
        })
        ->get();

        return view('project.monitor_evaluation.paymentsReport',['years'=>$years,'year'=>$year,
        'semester'=>$semester,'payments'=>$payments,'companies'=>$companies,'students'=>$students]);
    }

    public function paymentsReportSearch(Request $request){

        $semester = $request->semester;
        $year = $request->year;
        $trainings = StudentCompany::where('sc_id',0)->get();

        $trainingIDs = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
            ->from('registration')
            ->where('r_year', $year)
            ->where('r_semester', $semester)
            ->distinct();
        })
        // ->select('sc_id')
        // ->distinct()
        ->get();

        $trainingsFilterCompany = StudentCompany::whereIn('sc_registration_id', function ($query) use ($year, $semester) {
            $query->select('r_id')
            ->from('registration')
            ->where('r_year', $year)
            ->where('r_semester', $semester)
            ->distinct();
        })
        ->where('sc_status', 1)
        ->select('sc_id')
        ->distinct()
        ->get();

        if($request->company!=0 && $request->student!=0){

            $trainingsFilterCompany = $trainingIDs->filter(function ($item) use ($request){
                return ($item->sc_company_id == $request->company && $item->sc_student_id == $request->student);
            })->pluck('sc_id')->toArray();

        }



        if($request->company!=0&&$request->student==0){
            //do filter according to company
            $trainingsFilterCompany = $trainingIDs->filter(function ($item) use ($request) {
                return $item->sc_company_id == $request->company;
            })->pluck('sc_id')->toArray();
        }
        if($request->student!=0&&$request->company==0){

            $trainingsFilterCompany = $trainingIDs->filter(function ($item) use ($request){
                return $item->sc_student_id == $request->student;
            })->pluck('sc_id')->toArray();

        }

        // $payments = Payment::with('userStudent', 'payments','currency')->whereIn('p_student_company_id',$trainings)->get();
        if($request->company==0&&$request->student==0){
            $payments = Payment::with('userStudent', 'payments','currency')->whereIn('p_student_company_id',$trainingsFilterCompany)->get();
        }else{
            $payments = Payment::with('userStudent', 'payments','currency')->whereIn('p_student_company_id',$trainingsFilterCompany)->get();
        }

        if($request->status!=2){
            //do filter according to status
            $payments = Payment::with('userStudent', 'payments','currency')
            ->whereIn('p_student_company_id',$trainingsFilterCompany)
            ->where('p_status',$request->status)
            ->get();
        }

        return response()->json([
            'success'=>'true',
            'trainings'=>$payments,
            'view'=>view('project.monitor_evaluation.ajax.paymentsReportTable',['payments'=>$payments])->render(),
        ]);
    }

}
