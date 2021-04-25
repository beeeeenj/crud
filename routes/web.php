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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[HomeController::class, 'index' ]);

Route::resource('employees', EmployeesController::class);
Route::resource('departments', DepartmentController::class);

Route::prefix('hr')->group(function () {
    Route::resource('careers', CareerController::class);
    Route::get('careers/preview/index/',[CareerController::class, 'prev_index' ])->name('careers.prev_index');
    Route::get('careers/preview/view/{slug}/',[CareerController::class, 'preview' ])->name('careers.view');
    Route::get('careers/preview/apply/{slug}/',[CareerController::class, 'apply' ])->name('careers.apply');
    Route::post('careers/preview/apply/{slug}/',[CareerController::class, 'apply_store' ])->name('careers.apply.store');
    Route::resource('applicants', ApplicantController::class);

    Route::post('applicants/view/update/{id}/', [ApplicantController::class,'view_update'])->name('applicants.view.update');
    
});


Route::get('department/list/',[DepartmentController::class, 'list' ])->name('department.list');
Route::get('hr/careers/list/2/',[CareerController::class, 'list' ])->name('careers.list');
Route::get('hr/applicant/list/',[ApplicantController::class, 'list' ])->name('applicant.list');
