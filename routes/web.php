<?php

use Illuminate\Console\Application;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/application', function () {
        return view('manage_application.applicationList');
    })->name('application');
});

Route::get('/dashboard', 'App\Http\Controllers\HomeController@index') -> name('dashboard');

Route::resource('users',App\Http\Controllers\UserController::class);

Route::resource('applications',App\Http\Controllers\ApplicationController::class);
