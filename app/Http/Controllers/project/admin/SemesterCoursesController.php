<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SemesterCourse;

class SemesterCoursesController extends Controller
{
    //
    public function index()
    {
        $data = SemesterCourse::get();
        return view('project.admin.semesterCourses.index');
    }
}
