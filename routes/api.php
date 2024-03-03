<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/auth/logout', [UserController::class, 'logout']);

    /* API Tasks */
    Route::get('/tasks/user', [TaskController::class, 'index']);
    Route::get('/task/{id}', [TaskController::class, 'show']);
    Route::post('/task/store', [TaskController::class, 'store']);
    Route::post('/task/update/{id}', [TaskController::class, 'update']);
    Route::delete('/task/delete/{id}', [TaskController::class, 'destroy']);

    /* API Employees */
    Route::get('/users', []);
    Route::get('/user/{id}', []);
    Route::post('/user/store', []);
    Route::post('/user/update/{id}', []);
    Route::delete('/user/delete/{id}', []);
    
});



Route::post ('/auth/register', [UserController::class, 'createUser']);
Route::post ('/auth/login', [UserController::class, 'login']);
