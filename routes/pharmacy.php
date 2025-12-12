<?php

use App\Http\Controllers\Pharmacy\Web\Dashboard\PharmacydashboardController;
use App\Http\Controllers\Pharmacy\Web\Expense\Expenseentry\PharmacyexpenseentryController;
use App\Http\Controllers\Pharmacy\Web\Paymentvoucher\PharmacypaymentvoucherController;
use App\Http\Controllers\Pharmacy\Web\Purchase\Purchaseentry\PharmacypurchaseentryController;
use App\Http\Controllers\Pharmacy\Web\Purchase\Purchaseorder\PharmacyorderController;
use App\Http\Controllers\Pharmacy\Web\Purchase\Purchaseplanning\PharmacyplanningController;
use App\Http\Controllers\Pharmacy\Web\Purchase\Purchasereturn\PharmacypurchasereturnController;
use App\Http\Controllers\Pharmacy\Web\Receipt\PharmacyreceiptController;
use App\Http\Controllers\Pharmacy\Web\Report\PharmacyreportController;
use App\Http\Controllers\Pharmacy\Web\Sales\PharmacysalesentryController;
use App\Http\Controllers\Pharmacy\Web\Sales\PharmacysalesreturnController;
use App\Http\Controllers\Pharmacy\Web\Sales\Prescription\PharmacyhmsprescriptionController;
use App\Http\Controllers\Pharmacy\Web\Settings\Branch\PharmacybranchsettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\Category\Pharmacycategory\PharmacycategorysettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\Category\Pharmacysubcategory\PharmacysubcategorysettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\Drugmaster\Pharmacygenaric\PharmacygenaricsettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\Drugmaster\Pharmacymanufacture\PharmacymanufacturesettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\PharmacysettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\Product\PharmacyproductsettingController;
use App\Http\Controllers\Pharmacy\Web\Settings\Supplier\PharmacysupplierproductsettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth.pharmacy', 'preventbackbutton'], 'prefix' => 'pharmacy'], function () {
    // Dashboard
    Route::get('/pharmacydashboard', [PharmacydashboardController::class, 'dashboard'])->name('pharmacydashboard');

    //Purchase Planning
    Route::controller(PharmacyplanningController::class)
        ->prefix('pruchaseplanning')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('purchaseplanning');
            Route::get('/createoredit/{purchaseplanninguuid?}', 'createoredit')->name('pruchaseplanningcreateoredit');
        });

    //Purchase Order
    Route::controller(PharmacyorderController::class)
        ->prefix('pruchaseorder')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('purchaseorder');
            Route::get('/purchaseorderprint/{purchaseorder}', 'purchaseorderprint')->name('purchaseorderprint');

        });

    //Purchase Entry
    Route::controller(PharmacypurchaseentryController::class)
        ->prefix('purchase')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('purchaseindex');
            Route::get('/create', 'create')->name('pruchasecreate');
            Route::get('/purchaseentryreceiptprint/{purchaseentry}', 'purchaseentryreceiptprint')->name('purchaseentryreceiptprint');
        });

    //Purchase Payment Voucher
    Route::controller(PharmacypaymentvoucherController::class)
        ->prefix('paymentvoucher')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/pharmacypaymentvoucherentry', 'pharmacypaymentvoucherentry')->name('pharmacypaymentvoucherentry');
            Route::get('/pharmacypaymentvoucherhistory', 'pharmacypaymentvoucherhistory')->name('pharmacypaymentvoucherhistory');
            Route::get('/pharmacypaymentvoucherprint/{pharmacypaymentvoucher}', 'pharmacypaymentvoucherprint')->name('pharmacypaymentvoucherprint');
        });

    //Purchase Return
    Route::controller(PharmacypurchasereturnController::class)
        ->prefix('purchasereturn')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('purchasereturnindex');
            Route::get('/create', 'create')->name('purchasereturncreate');
            Route::get('/purchasereturnprint/{purchasereturn}', 'purchasereturnprint')->name('purchasereturnprint');
        });

    //Sales Entry
    Route::controller(PharmacysalesentryController::class)
        ->prefix('salesentry')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('salesentryindex');
            Route::get('/createorhms/{prescriptionuuid?}', 'createorhms')->name('salesentrycreate');
            Route::get('/salesentryprint/{salesentry}', 'salesentryprint')->name('salesentryprint');
        });

    //Report
    Route::controller(PharmacyreportController::class)
        ->prefix('report')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('reportindex');
            //Purchase
            Route::get('/purchasereportindex', 'purchasereportindex')->name('purchasereportindex');
            Route::get('/purchaseentryindex', 'purchaseentryindex')->name('purchaseentryindex');
            Route::get('/purchaseitemreturn', 'purchaseitemreturn')->name('purchaseitemreturn');
            //Sales
            Route::get('/salesreportindex', 'salesreportindex')->name('salesreportindex');
            Route::get('/salesitemreportindex', 'salesitemreportindex')->name('salesitemreportindex');
            Route::get('/salesitemreturn', 'salesitemreturn')->name('salesitemreturn');
            //Product
            Route::get('/productreportindex', 'productreportindex')->name('productreportindex');
            Route::get('/productexpiryreport', 'productexpiryreport')->name('productexpiryreport');
            //Receipt
            Route::get('/receiptreportindex', 'receiptreportindex')->name('receiptreportindex');
            //Payment Voucher
            Route::get('/paymentvoucher', 'paymentvoucher')->name('paymentvoucher');
        });

    //Sales Return
    Route::controller(PharmacysalesreturnController::class)
        ->prefix('salesreturn')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('salesreturnindex');
            Route::get('/create', 'create')->name('salesreturncreate');
            Route::get('/salesreturnprint/{salesreturn}', 'salesreturnprint')->name('salesreturnprint');
        });

    Route::controller(PharmacyreceiptController::class)
        ->prefix('receipt')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/pharmacyreceipt', 'pharmacyreceipt')->name('pharmacyreceipt');
            Route::get('/pharmacyreceipthistory', 'pharmacyreceipthistory')->name('pharmacyreceipthistory');
            Route::get('/printreceiptentry/{receipt}', 'printreceiptentry')->name('pharmprintreceiptentry');

        });

    //Purchase Expense Entry
    Route::controller(PharmacyexpenseentryController::class)
        ->prefix('expenseentry')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('expenseentryindex');
            Route::get('/createoredit/{expenseentryuuid?}', 'createoredit')->name('expenseentrycreateoredit');
            Route::get('/expenseentryreceiptprint/{expenseentry}', 'expenseentryreceiptprint')->name('expenseentryreceiptprint');
        });

    //HMS Prescription
    Route::controller(PharmacyhmsprescriptionController::class)
        ->prefix('hmsprescription')
        ->as('pharmacy.')
        ->group(function () {
            Route::get('/index', 'index')->name('hmsprescriptionindex');
        });

    // Settings
    Route::get('/pharmacysettings', [PharmacysettingController::class, 'index'])->name('pharmacysettings');
    Route::group(['prefix' => 'pharmacysettings'], function () {
        //Pharmacy Category
        Route::get('/pharmacybranch', [PharmacybranchsettingController::class, 'index'])->name('pharmacybranch');
        //User
        Route::controller(PharmacysettingController::class)
            ->group(function () {
                //Add User
                Route::get('/pharmacyadduser', 'pharmacyadduser')->name('pharmacyadduser');
                //Change Password
                Route::get('/pharmacychangepassword', 'pharmacychangepassword')->name('pharmacychangepassword');
            });
        //Pharmacy Category
        Route::get('/pharmacycategory', [PharmacycategorysettingController::class, 'index'])->name('pharmacycategory');
        //Pharmacy Sub Category
        Route::get('/pharmacysubcategory', [PharmacysubcategorysettingController::class, 'index'])->name('pharmacysubcategory');
        //Pharmacy Genaric Setting
        Route::get('/pharmacygenaric', [PharmacygenaricsettingController::class, 'index'])->name('pharmacygenaric');
        //Pharmacy Manufacture Setting
        Route::get('/pharmacymanufacture', [PharmacymanufacturesettingController::class, 'index'])->name('pharmacymanufacture');
        //Pharmacy Product and Alternative
        Route::controller(PharmacyproductsettingController::class)
            ->group(function () {
                //Add Product
                Route::get('/pharmacyproduct', 'index')->name('pharmacyproduct');
                //Alternative Product
                Route::get('/alternativepharmacyproduct/{productid}', 'alternativepharmacyproduct')->name('alternativepharmacyproduct');
            });
        //Pharmacy Supplier Product
        Route::controller(PharmacysupplierproductsettingController::class)
            ->group(function () {
                //Supplier Index
                Route::get('/pharmacysupplierproduct', 'index')->name('pharmacysupplierproduct');
                //Map product to supplier
                Route::get('/pharmacymapsupplierproduct/{supplieruuid}', 'pharmacymapsupplierproduct')->name('pharmacymapsupplierproduct');
            });
    });
});
