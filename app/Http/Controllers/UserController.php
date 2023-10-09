<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function browse()
    {
        $data = User::all();
        return view('project.admin.users.browse' , ['data' => $data]);
    }
}
