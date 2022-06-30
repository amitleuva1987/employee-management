<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('employees/get_avtar/{id}/{image}',[App\Http\Controllers\EmployeeController::class,'get_avtar'])->name('get_avtar');
Route::resource('companies',CompanyController::class);
Route::resource('employees',EmployeeController::class);
Route::post('set_session',[App\Http\Controllers\SessionController::class,'set_session'])->name('set_session');
