<?php

use App\Http\Controllers\Admin\Web\Auth\AdminloginController;
use App\Http\Controllers\Laboratory\Web\Auth\LaboratoryloginController;
use App\Http\Controllers\Pharmacy\Web\Auth\PharmacyloginController;
use Illuminate\Support\Facades\Route;

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('admin/session', fn() =>
    ((session('sessiontoggled') == 'toggled') ? session()->forget('sessiontoggled') : session(['sessiontoggled' => 'toggled']))
)->middleware('auth', 'preventbackbutton');

Route::controller(AdminloginController::class)
    ->group(function () {
        Route::get('/', 'showadminloginform');
        Route::get('admin/login', 'showadminloginform')->name('adminlogin');
        Route::post('admin/login', 'adminlogin')->name('adminloginpost');
        Route::get('admin/logout', 'logout')->name('adminlogout');
        Route::post('admin/logout', 'logout')->name('postadminlogout');
    });

Route::controller(PharmacyloginController::class)
    ->group(function () {
        Route::get('pharmacy/login', 'showpharmacyloginform')->name('pharmacylogin');
        Route::post('pharmacy/login', 'pharmacylogin')->name('pharmacyloginpost');
        Route::get('pharmacy/logout', 'logout')->name('pharmacylogout');
        Route::post('pharmacy/logout', 'logout')->name('postpharmacylogout');
    });

Route::controller(LaboratoryloginController::class)
    ->group(function () {
        Route::get('laboratory/login', 'showlaboratoryloginform')->name('laboratorylogin');
        Route::post('laboratory/login', 'laboratorylogin')->name('laboratoryloginpost');
        Route::get('laboratory/logout', 'logout')->name('laboratorylogout');
        Route::post('laboratory/logout', 'logout')->name('postlaboratorylogout');
    });
