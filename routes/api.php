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

/* Only logged users */
Route::middleware('auth:sanctum')->group(function(){

    /* If you have one of these rols you can access */
    Route::middleware('role:timesync_admin, superadmin, admin, user')->group(function(){

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

        /* API Services */

    });

    /* If you have this rol you can update your company */
    Route::middleware('role:unregistered_user')->group(function(){

        Route::post('/company/update', []);

    });

    
    
});



Route::post ('/auth/register', [UserController::class, 'registerCompany']);
Route::post ('/auth/login', [UserController::class, 'login']);
Route::get ('/hola', function(){
    return response()->json([
        'message' => 'Hola mundo'
    ]);
});
