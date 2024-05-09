<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController;

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

    //App Routes
    Route::get('/logout', [AccessController::class, 'logout'])->name('logout');
    Route::get('/home', [Controller::class, 'home'])->name('home');
    Route::get('/workday', [UserController::class, 'workday'])->name('workday');

    //Task Routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/new/task', [TaskController::class, 'showNewTaskForm'])->name('task.new');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::post('/task/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
    Route::get('/task/cancel/{id}', [TaskController::class, 'cancel'])->name('task.cancel');

    //Service Routes
    Route::get('/new/service', [ServiceController::class, 'showNewServiceForm'])->name('service.new');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::post('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');

    //User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/new/user', [AccessController::class, 'showNewUserForm'])->name('user.new');
    Route::post('/user/store', [AccessController::class, 'store'])->name('user.store');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');


});


// Rutas de Prueba

Route::get('/task', function(){
    return view('tasks.task');
})->name('task');

//Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');



