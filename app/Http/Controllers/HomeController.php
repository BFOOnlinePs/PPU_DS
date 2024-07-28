<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\announcements;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $announcememts=announcements::where('a_status',1)->orderBy('created_at', 'desc')->get();
        $student_count = User::where('u_role_id',2)->count();
        $company_count = User::where('u_role_id',6)->count();
        $supervisor_count = User::where('u_role_id',3)->count();
        $student_male_count = User::where('u_gender',0)->count();
        $student_female_count = User::where('u_gender',1)->count();
        $company_active = Company::where('c_status',1)->count();
        $company_not_active = Company::where('c_status',0)->count();

        $results = DB::table('registration as r')
            ->join('courses as c', 'r.r_course_id', '=', 'c.c_id')
            ->join('users as u', 'r.r_student_id', '=', 'u.u_id')
            ->select(
                'c.c_name as course_name',
                'r.r_year',
                'r.r_semester',
                DB::raw('SUM(CASE WHEN u.u_gender = 0 THEN 1 ELSE 0 END) AS male_count'),
                DB::raw('SUM(CASE WHEN u.u_gender = 1 THEN 1 ELSE 0 END) AS female_count'),
                DB::raw('COUNT(r.r_student_id) AS total_count')
            )
            ->whereBetween('r.r_year', [2023, 2024])
            ->groupBy('c.c_name', 'r.r_year', 'r.r_semester')
            ->orderBy('r.r_year')
            ->orderBy('c.c_name')
            ->orderBy('r.r_semester')
            ->get();

        return view('home',['data'=>$announcememts,'student_count'=>$student_count,'company_count'=>$company_count,'supervisor_count'=>$supervisor_count,'student_male_count'=>$student_male_count , 'student_female_count'=>$student_female_count,'company_active'=>$company_active,'company_not_active'=>$company_not_active , 'results'=>$results]);
    }

    // test
}
