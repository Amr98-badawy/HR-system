<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::redirect('/','admin');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
        Route::get('/', function (){
            return view('dashboard.site.home');
        })->name('dashboard.home');
    });

});


