<?php

use App\Http\Controllers\Dashboard\AttendanceController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardPageController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\DeviceController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\LogController;
use App\Http\Controllers\Dashboard\PayRollController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\ShiftController;
use App\Http\Controllers\Dashboard\SiteLanguageController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::redirect('/', 'login');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['prefix' => 'admin', 'as' => 'dashboard.', 'middleware' => 'auth'], function () {

        Route::get('/', [DashboardPageController::class, 'index'])->name('home');

        // Management System Routes
        Route::resource('users', UserController::class);

        Route::resource('roles', RolesController::class);

        Route::resource('permissions', PermissionController::class)->except('show');

        // Organization
        Route::resource('companies', CompanyController::class);

        Route::resource('departments', DepartmentController::class);

        Route::resource('sections', SectionController::class);

        Route::resource('shifts', ShiftController::class);

        Route::get('get-departments/{company}', [EmployeeController::class, 'getDepartments'])->name('employee.getDepartments');
        Route::get('get-sections/{department}', [EmployeeController::class, 'getSections'])->name('employee.getSections');
        Route::get('employees/{company}/company', [EmployeeController::class, 'employeeCompany'])->name('employees.company');
        Route::resource('employees', EmployeeController::class);

        // Attendance Route
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('attendance/{attendance}', [AttendanceController::class, 'show'])->name('attendances.show');
        Route::delete('attendance/{attendance}/delete', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
        Route::get('attendance/{company}/company', [AttendanceController::class, 'companyAttendance'])->name('attendances.company');
        Route::post('attendance/export/excel', [AttendanceController::class, 'exportData'])->name('attendances.export');

        // Payroll Route
        Route::resource('payroll', PayRollController::class);

        // Device Route
        Route::resource('devices', DeviceController::class);

        //Log Routes
        Route::get('logs', [LogController::class, 'index'])->name('logs.index');
        Route::get('logs/{activity}', [LogController::class, 'show'])->name('logs.show');
        Route::delete('logs/{activity}/delete', [LogController::class, 'destroy'])->name('logs.destroy');
    });

});


