<?php

namespace App\Http\Controllers\apisControllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // user signup
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email', //unique in users table, email column
            'password' => 'required|min:6|confirmed',
            'major_id' => 'nullable|exists:majors,m_id',  // Check if u_major_id exists in the "majors" table's "m_id" column
            'role_id' => 'required|exists:roles,r_id', // Check if u_role_id exists in the "roles" table's "r_id" column
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']), //hash the password
            'major_id' => $credentials['major_id'],
            'role_id' => $credentials['role_id'],
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        // Save the token in the remember_token column
        // $user->update(['remember_token' => $token]);

        return response([
            'message' => 'user created',
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
