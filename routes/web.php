<?php

use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardPageController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\RolesController;
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

    });

});


