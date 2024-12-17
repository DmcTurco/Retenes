<?php

use App\MyApp;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as Admin;
use App\Http\Controllers\Employee as Employee;

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

Route::prefix(MyApp::ADMINS_SUBDIR)->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.home');
    })->withoutMiddleware('auth:admin');
    Route::get('/home', [Admin\HomeController::class, 'index'])->name('home');
    Route::resource('employee', Admin\EmployeeController::class);
    // Route::resource('user', UserController::class);

});

Route::prefix(MyApp::EMPLOYEE_SUBDIR)->middleware('auth:employee')->name('employee.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('employee.home');
    })->withoutMiddleware('auth:employee');
    
    Route::get('/home', [Employee\HomeController::class, 'index'])->name('home');
    Route::resource('/retainer', Employee\RetainerController::class);
    Route::put('/updateState/{id}', [Employee\RetainerController::class, 'updateState'])->name('updateState');
    Route::resource('record', Employee\RecordController::class);
    Route::get('/getRetainer/{date}', [Employee\RecordController::class, 'getRetainer'])->name('getRetainer');
    Route::get('/generatePdf', [Employee\RecordController::class,'generatePdf'])->name('generatePdf');
    Route::resource('reloj', Employee\RelojController::class);
    Route::resource('frequency', Employee\FrequencyController::class);



});