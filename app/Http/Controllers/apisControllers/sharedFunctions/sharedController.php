<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class sharedController extends Controller
{
    // user login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Invalid credentials'
            ], 403);
        }

        $token = $request->user()->createToken('api-token')->plainTextToken;

        // Save the token in the remember_token column
        // $request->user()->update(['remember_token' => $token]);

        return response([
            'message' => 'user logged in',
            'user' => auth()->user(),
            'token' => $token,
        ], 200);

    }

    // user logout
    public function logout(Request $request){
        Auth::user()->tokens->each(function (PersonalAccessToken $token) {
            $token->delete();
        });

        return response([
            'message' => 'Logout success'
        ], 200);
    }
}
