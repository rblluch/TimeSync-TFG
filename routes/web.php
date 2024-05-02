<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Index Route
Route::get('/', [Controller::class, 'index'])->name('index')->middleware('guest');

Route::get('/register', function(){ return view('register'); })->name('register');

Route::post('/login', [AccessController::class, 'login'])->name('login');

Route::middleware('auth')->group(function(){

    Route::get('/logout', [AccessController::class, 'logout'])->name('logout');
    Route::get('/home', [Controller::class, 'home'])->name('home');
    Route::get('/workday', [UserController::class, 'workday'])->name('workday');

    Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');

    Route::get('/new/task', function(){
        return view('tasks.task_new');
    })->name('task.new');

    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');


});


// Rutas de Prueba

Route::get('/task', function(){
    return view('layouts.task');
})->name('task');


