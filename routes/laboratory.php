<?php

use App\Http\Controllers\Laboratory\Web\Dashboard\InvestigationdashboardController;
use App\Http\Controllers\Laboratory\Web\Laboratory\Homepage\LaboratoryhomepageController;
use App\Http\Controllers\Laboratory\Web\Laboratory\Labpatient\LabpatientController;
use App\Http\Controllers\Laboratory\Web\Paymentvoucher\InvestigationpaymentvoucherController;
use App\Http\Controllers\Laboratory\Web\Receipt\InvestigationreceiptController;
use App\Http\Controllers\Laboratory\Web\Report\InvestigationreportController;
use App\Http\Controllers\Laboratory\Web\Scan\Homepage\ScanhomepageController;
use App\Http\Controllers\Laboratory\Web\Scan\Scanpatient\ScanpatientController;
use App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labinvestigationgroup\LabinvestigationgroupController;
use App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labinvestigation\LabinvestigationController;
use App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labreporttemplate\LabreporttemplateController;
use App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labtestmethod\LabtestmethodController;
use App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labunit\LabunitController;
use App\Http\Controllers\Laboratory\Web\Settings\LaboratorysettingController;
use App\Http\Controllers\Laboratory\Web\Xray\Homepage\XrayhomepageController;
use App\Http\Controllers\Laboratory\Web\Xray\Xraypatient\XraypatientController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth.laboratory', 'preventbackbutton'], 'prefix' => 'laboratory'], function () {
    // Dashboard
    Route::get('/investigationdashboard', [InvestigationdashboardController::class, 'dashboard'])->name('investigationdashboard');

    // Laboratory

    // Lab Patient Queue
    Route::controller(LabpatientController::class)
        ->group(function () {
            Route::get('/laboratorypatientlist', 'laboratorypatientlist')->name('laboratorypatientlist');
            Route::get('/labpatientmovetobill/{uuid}', 'labpatientmovetobill')->name('labpatientmovetobill');
            Route::get('/labbillingprint/{uuid}', 'labbillingprint')->name('labbillingprint');
            Route::get('/labsample/{uuid}', 'labsample')->name('labsample');
            Route::get('/labresultentry/{uuid}', 'labresultentry')->name('labresultentry');
            Route::get('/labdelivery/{uuid}', 'labdelivery')->name('labdelivery');
            Route::get('/labprint/{uuid}', 'labprint')->name('labprint');
            Route::get('/laboratorypatienthistory', 'laboratorypatienthistory')->name('laboratorypatienthistory');
        });
    Route::controller(LaboratoryhomepageController::class)
        ->group(function () {
            Route::get('/laboratoryhomepage', 'laboratoryhomepage')->name('laboratoryhomepage');
            Route::get('/laboratorypatientwalkin', 'laboratorypatientwalkin')->name('laboratorypatientwalkin');
        });

    // Scan Patient
    Route::controller(ScanhomepageController::class)
        ->group(function () {
            Route::get('/scanhomepage', 'scanhomepage')->name('scanhomepage');
            Route::get('/scanpatientwalkin', 'scanpatientwalkin')->name('scanpatientwalkin');
        });
    Route::controller(ScanpatientController::class)
        ->group(function () {
            Route::get('/scanpatientlist', 'scanpatientlist')->name('scanpatientlist');
            Route::get('/scanpatientmovetobill/{uuid}', 'scanpatientmovetobill')->name('scanpatientmovetobill');
            Route::get('/scanbillingprint/{uuid}', 'scanbillingprint')->name('scanbillingprint');
            Route::get('/scansample/{uuid}', 'scansample')->name('scansample');
            Route::get('/scanresultentry/{uuid}', 'scanresultentry')->name('scanresultentry');
            Route::get('/scandelivery/{uuid}', 'scandelivery')->name('scandelivery');
            Route::get('/scanprint/{uuid}', 'scanprint')->name('scanprint');
            Route::get('/scanpatienthistory', 'scanpatienthistory')->name('scanpatienthistory');
        });

    // X-ray
    Route::controller(XraypatientController::class)
        ->group(function () {
            Route::get('/xraypatientlist', 'xraypatientlist')->name('xraypatientlist');
            Route::get('/xraypatientmovetobill/{uuid}', 'xraypatientmovetobill')->name('xraypatientmovetobill');
            Route::get('/xraybillingprint/{uuid}', 'xraybillingprint')->name('xraybillingprint');
            Route::get('/xraysample/{uuid}', 'xraysample')->name('xraysample');
            Route::get('/xrayresultentry/{uuid}', 'xrayresultentry')->name('xrayresultentry');
            Route::get('/xraydelivery/{uuid}', 'xraydelivery')->name('xraydelivery');
            Route::get('/xrayprint/{uuid}', 'xrayprint')->name('xrayprint');
            Route::get('/xraypatienthistory', 'xraypatienthistory')->name('xraypatienthistory');
        });
    Route::controller(XrayhomepageController::class)
        ->group(function () {
            Route::get('/xrayhomepage', 'xrayhomepage')->name('xrayhomepage');
            Route::get('/xraypatientwalkin', 'xraypatientwalkin')->name('xraypatientwalkin');
        });

    Route::controller(InvestigationreceiptController::class)
        ->group(function () {
            Route::get('/investigationreceipt', 'investigationreceipt')->name('investigationreceipt');
            Route::get('/investigationreceipthistory', 'investigationreceipthistory')->name('investigationreceipthistory');
            Route::get('/printreceiptentry/{receipt}', 'printreceiptentry')->name('labprintreceiptentry');
        });

    Route::controller(InvestigationreportController::class)
        ->group(function () {
            Route::get('/investigationreport', 'investigationreport')->name('investigationreport');
            Route::get('/labreport', 'labreport')->name('labreport');
            Route::get('/labbillreport', 'labbillreport')->name('labbillreport');
            Route::get('/scanreport', 'scanreport')->name('scanreport');
            Route::get('/scanbillreport', 'scanbillreport')->name('scanbillreport');
            Route::get('/xrayreport', 'xrayreport')->name('xrayreport');
            Route::get('/xraybillreport', 'xraybillreport')->name('xraybillreport');
            Route::get('/receiptreport', 'receiptreport')->name('receiptreport');
            Route::get('/paymentvoucherreport', 'paymentvoucherreport')->name('paymentvoucherreport');
        });

    Route::controller(InvestigationpaymentvoucherController::class)
        ->group(function () {
            Route::get('/investigationpaymentvoucherentry', 'investigationpaymentvoucherentry')->name('investigationpaymentvoucherentry');
            Route::get('/investigationpaymentvoucherhistory', 'investigationpaymentvoucherhistory')->name('investigationpaymentvoucherhistory');
            Route::get('/investigationvoucherprint/{investigationvoucher}', 'investigationvoucherprint')->name('investigationvoucherprint');
        });

    Route::controller(LaboratorysettingController::class)
        ->group(function () {
            //Settings
            Route::get('/laboratorysettings', 'index')->name('laboratorysettings');
            //Add User
            Route::get('/laboratoryadduser', 'laboratoryadduser')->name('laboratoryadduser');
            //Change Password
            Route::get('/laboratorychangepassword', 'laboratorychangepassword')->name('laboratorychangepassword');
        });

    //Laboratory Report Template  Setting
    Route::get('/labreporttemplate', [LabreporttemplateController::class, 'index'])->name('labreporttemplate');
    //Laboratory Investigation name Setting
    Route::get('/labinvestigation', [LabinvestigationController::class, 'index'])->name('labinvestigation');
    //Laboratory investigationgroup Setting
    Route::get('/labinvestigationgroup', [LabinvestigationgroupController::class, 'index'])->name('labinvestigationgroup');
    //Laboratory Unit
    Route::get('/labunit', [LabunitController::class, 'index'])->name('labunit');
    //Laboratory Test Method
    Route::get('/labtestmethod', [LabtestmethodController::class, 'index'])->name('labtestmethod');
});
