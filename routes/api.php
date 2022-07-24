<?php

use App\Http\Controllers\Api\Attendance\AttendanceApiController;
use App\Http\Controllers\Api\Employee\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest'], 'as' => 'dashboard.'], function () {

    Route::post('get-employee/{employee:account_no}', [EmployeeApiController::class, 'getEmployee']);

    // Attendance Routes
    Route::post('check-in-employee/{employee:account_no}', [AttendanceApiController::class, 'setCheckIn'])->name('checkin.employees');
});
