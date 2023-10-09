<?php

use App\Http\Controllers\apisControllers\admin\AdminController;
use App\Http\Controllers\apisControllers\sharedFunctions\sharedController;
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

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [sharedController::class, 'logout']);

});
