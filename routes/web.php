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

//User resource
Route::resource('users',App\Http\Controllers\UserController::class);

//Application resource
Route::resource('applications',App\Http\Controllers\ApplicationController::class);

//Payment resource
Route::resource('payments',App\Http\Controllers\PaymentController::class);

//Complaint resource
Route::resource('complaints',App\Http\Controllers\ComplaintController::class);

//Report resource
Route::resource('reports',App\Http\Controllers\ReportController::class);

//Report resource
Route::resource('complaints',App\Http\Controllers\ComplaintController::class);

//Application Route
Route::post('/applications/approve','App\Http\Controllers\ApplicationController@approve') -> name('approve_application');

Route::post('/applications/reject','App\Http\Controllers\ApplicationController@reject') -> name('reject_application');

Route::patch('/applications/update/{id}','App\Http\Controllers\ApplicationController@update') -> name('update_application');

Route::get('/applications/view/id={id}','App\Http\Controllers\ApplicationController@show') -> name('view_application');

//Payment Route
Route::get('/payments/create/type={type}/{id}', 'App\Http\Controllers\PaymentController@create') -> name('add_payment');

Route::post('/payments/store', 'App\Http\Controllers\PaymentController@store') -> name('store_payment');

Route::post('/payments/approve','App\Http\Controllers\PaymentController@approve') -> name('approve_payment');

Route::post('/payments/reject','App\Http\Controllers\PaymentController@reject') -> name('reject_payment');

//Payment Gateway
Route::get('toyyibpay/{billName}/{description}/{amount}/{refNo}/{name}/{email}/{phone}/{expires}','App\Http\Controllers\PaymentController@createBill') -> name('toyyibpay-create');
Route::get('toyyibpay-status','App\Http\Controllers\PaymentController@paymentStatus') -> name('toyyibpay-status');
Route::post('toyyibpay-callback','App\Http\Controllers\PaymentController@callBack') -> name('toyyibpay-callback');

//Report Route
Route::get('/reports/view/id={id}','App\Http\Controllers\ReportController@show') -> name('view_report');

Route::get('reports/{report}/edit', 'App\Http\Controllers\ReportController@edit')->name('reports.edit');

//Complaint Route
Route::get('reports/Add_Note/{id}', 'App\Http\Controllers\ComplaintController@addNote')->name('complaint_addNote');

Route::patch('reports/Update_Note/{id}', 'App\Http\Controllers\ComplaintController@updateNote')->name('complaint_updateNote');