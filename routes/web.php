<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\hr\CareerController;
use App\Http\Controllers\hr\ApplicantController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index' ]);

Route::resource('employees', EmployeesController::class);
Route::resource('departments', DepartmentController::class);

Route::prefix('hr')->group(function () {
    Route::resource('careers', CareerController::class);
    Route::resource('applicants', ApplicantController::class);
});