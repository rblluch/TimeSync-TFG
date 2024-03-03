<?php

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

// Socialite Routes
Route::get('/login/google', [Controller::class, 'index'])->name('google.login');
Route::get('/login/google/callback', [Controller::class, 'index'])->name('google.callback');

Route::get('/signup', function(){})->name('signup');
