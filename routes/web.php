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

Route::resource('payments',App\Http\Controllers\PaymentController::class);

Route::post('/applications/approve','App\Http\Controllers\ApplicationController@approve') -> name('approve_application');

Route::post('/applications/reject','App\Http\Controllers\ApplicationController@reject') -> name('reject_application');

Route::patch('/applications/update/{id}','App\Http\Controllers\ApplicationController@update') -> name('update_application');

Route::get('/applications/view/id={id}','App\Http\Controllers\ApplicationController@show') -> name('view_application');

Route::get('/payments/create/type={type}/{id}', 'App\Http\Controllers\PaymentController@create') -> name('add_payment');

Route::post('/payments/store', 'App\Http\Controllers\PaymentController@store') -> name('store_payment');

Route::get('toyyibpay/{billName}/{description}/{amount}/{refNo}/{name}/{email}/{phone}/{expires}','App\Http\Controllers\PaymentController@createBill') -> name('toyyibpay-create');
Route::get('toyyibpay-status','App\Http\Controllers\PaymentController@paymentStatus') -> name('toyyibpay-status');
Route::post('toyyibpay-callback','App\Http\Controllers\PaymentController@callBack') -> name('toyyibpay-callback');