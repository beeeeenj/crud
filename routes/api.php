<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\hr\CareerController;
use App\Http\Controllers\hr\ApplicantController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/department/list/',[DepartmentController::class, 'list' ])->name('department.list');
Route::get('/hr/careers/list/',[CareerController::class, 'list' ])->name('careers.list');
Route::get('/hr/applicant/list/',[ApplicantController::class, 'list' ])->name('applicant.list');