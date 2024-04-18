<?php

use App\Http\Controllers\AccessController;
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
Route::get('/', [Controller::class, 'index'])->name('index');

Route::get('/signup', function(){})->name('signup');

Route::post('/login', [AccessController::class, 'login'])->name('login');

/* Route::get('/logout', [AccessController::class, 'logout'])->name('logout'); */
Route::get('/home', function(){
    return view('welcome');
})->name('home');