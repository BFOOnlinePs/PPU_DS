<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\announcements;

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
        $announcememts=announcements::where('a_stutas',1)->orderBy('created_at', 'desc')->get();
        return view('home',['data'=>$announcememts]);

    }

    // test
}