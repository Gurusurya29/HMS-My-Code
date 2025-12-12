<?php

use App\Http\Controllers\Admin\Web\Account\Paymentvoucher\PaymentvoucherController;
use App\Http\Controllers\Admin\Web\Billing\Billdiscount\BilldiscountController;
use App\Http\Controllers\Admin\Web\Billing\Ipbilling\IpbillingController;
use App\Http\Controllers\Admin\Web\Billing\Opbilling\OpbillingController;
use App\Http\Controllers\Admin\Web\Billing\Otbilling\OtbillingController;
use App\Http\Controllers\Admin\Web\Billing\Receipt\ReceiptController;
use App\Http\Controllers\Admin\Web\Dashboard\AdmindashboardController;
use App\Http\Controllers\Admin\Web\Employee\EmployeeController;
use App\Http\Controllers\Admin\Web\Emr\EmrController;
use App\Http\Controllers\Admin\Web\Facility\FacilityController;
use App\Http\Controllers\Admin\Web\Inpatient\InpatientController;
use App\Http\Controllers\Admin\Web\Insurance\PatientinsuranceController;
use App\Http\Controllers\Admin\Web\Operationtheatre\OperationtheatreController;
use App\Http\Controllers\Admin\Web\Outpatient\OutpatientController;
use App\Http\Controllers\Admin\Web\Patientregistration\PatientregistrationController;
use App\Http\Controllers\Admin\Web\Reports\Accountreports\AccountreportsController;
use App\Http\Controllers\Admin\Web\Reports\AdminreportsController;
use App\Http\Controllers\Admin\Web\Reports\Billingreports\BillingreportsController;
use App\Http\Controllers\Admin\Web\Reports\Facilityreports\FacilityreportsController;
use App\Http\Controllers\Admin\Web\Reports\Inpatientreports\InpatientreportsController;
use App\Http\Controllers\Admin\Web\Reports\Logreports\LogreportsController;
use App\Http\Controllers\Admin\Web\Reports\Outpatientreports\OutpatientreportsController;
use App\Http\Controllers\Admin\Web\Reports\Patientreports\PatientreportsController;
use App\Http\Controllers\Admin\Web\Settings\Admininvestigationsetting\AdmininvestigationController;
use App\Http\Controllers\Admin\Web\Settings\Adminpharmacysetting\AdminpharmacyController;
use App\Http\Controllers\Admin\Web\Settings\Doctorsetting\AdddoctorController;
use App\Http\Controllers\Admin\Web\Settings\Doctorsetting\DoctorconsultationfeeController;
use App\Http\Controllers\Admin\Web\Settings\Doctorsetting\DoctorspecializationController;
use App\Http\Controllers\Admin\Web\Settings\Documentsetting\MedicaldocumentController;
use App\Http\Controllers\Admin\Web\Settings\Generalsetting\GeneralsettingController;
use App\Http\Controllers\Admin\Web\Settings\Generalsetting\ThemesettingController;
use App\Http\Controllers\Admin\Web\Settings\Ipsetting\IpservicecategoryController;
use App\Http\Controllers\Admin\Web\Settings\Ipsetting\IpservicemasterController;
use App\Http\Controllers\Admin\Web\Settings\Ipsetting\IptreatmentController;
use App\Http\Controllers\Admin\Web\Settings\Mastersetting\LocationmasterController;
use App\Http\Controllers\Admin\Web\Settings\Opsetting\DiagnosismasterController;
use App\Http\Controllers\Admin\Web\Settings\Opsetting\OpservicemasterController;
use App\Http\Controllers\Admin\Web\Settings\Opsetting\PhysicalexamController;
use App\Http\Controllers\Admin\Web\Settings\Patientregisterationsetting\CountryController;
use App\Http\Controllers\Admin\Web\Settings\Patientregisterationsetting\ReferencemasterController;
use App\Http\Controllers\Admin\Web\Settings\Patientregisterationsetting\StateController;
use App\Http\Controllers\Admin\Web\Settings\Patientvisitsetting\AllergymasterController;
use App\Http\Controllers\Admin\Web\Settings\Patientvisitsetting\CurrentcomplaintsController;
use App\Http\Controllers\Admin\Web\Settings\Patientvisitsetting\InsurancecompanymasterController;
use App\Http\Controllers\Admin\Web\Settings\Settings\AdminsettingsController;
use App\Http\Controllers\Admin\Web\Settings\Suppliersetting\SupplierController;
use App\Http\Controllers\Admin\Web\Settings\Tracking\LogininfoController;
use App\Http\Controllers\Admin\Web\Settings\Tracking\TrackingController;
use App\Http\Controllers\Admin\Web\Settings\User\UserController;
use App\Http\Controllers\Admin\Web\Settings\Wardsetting\BedorroomnumberController;
use App\Http\Controllers\Admin\Web\Settings\Wardsetting\WardfloorController;
use App\Http\Controllers\Admin\Web\Settings\Wardsetting\WardtypeController;
use App\Http\Controllers\Admin\Web\Wardmanagement\WardmanagementController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'preventbackbutton'], 'prefix' => 'admin'], function () {
    // Dashboard
    Route::get('/admindashboard', [AdmindashboardController::class, 'dashboard'])->name('admindashboard');

    Route::get('/humanresource', [AdmindashboardController::class, 'humanresource'])->name('humanresource');

    Route::controller(PatientregistrationController::class)
        ->group(function () {
            Route::get('/patientregistration', 'patientregistration')->name('patientregistration');
            Route::get('/patienttodayvisit', 'patienttodayvisit')->name('patienttodayvisit');
            Route::get('/patientappointment', 'patientappointment')->name('patientappointment');
            Route::get('/patientvisithistory', 'patientvisithistory')->name('patientvisithistory');
            Route::get('/patientvisithistoryedit/{uuid}', 'patientvisithistoryedit')->name('patientvisithistoryedit');
            Route::get('/inpatientlist', 'inpatientlist')->name('inpatientlist');
            Route::get('/patientmasterlist', 'patientmasterlist')->name('patientmasterlist');
            Route::get('/printlabel/{patient}', 'printlabel')->name('printlabel');
            Route::get('/printtoken/{patientvisit}', 'printtoken')->name('printtoken');
        });

    // Out Patient
    Route::controller(OutpatientController::class)
        ->group(function () {
            Route::get('/outpatientqueue', 'outpatientqueue')->name('outpatientqueue');
            Route::get('/outpatientvisitentry', 'outpatientvisitentry')->name('outpatientvisitentry');
            Route::get('/outpatienthistory', 'outpatienthistory')->name('outpatienthistory');
            Route::get('/opassessment/{uuid}/{requesttype?}', 'opassessment')->name('opassessment');
            Route::get('/printprescription/{outpatient}', 'printprescription')->name('printprescription');
            Route::get('/printassessment/{outpatient}', 'printassessment')->name('printassessment');
            Route::get('/opprintinvestigation/{outpatient}', 'opprintinvestigation')->name('opprintinvestigation');
            Route::get('/opprintinvestigationresult/{outpatient}', 'opprintinvestigationresult')->name('opprintinvestigationresult');
        });

    // In Patient
    Route::controller(InpatientController::class)
        ->group(function () {
            Route::get('/inpatientqueue', 'inpatientqueue')->name('inpatientqueue');
            Route::get('/inpatientadmission/{uuid}', 'inpatientadmission')->name('inpatientadmission');
            Route::get('/ipnursingstationservice/{uuid}', 'ipnursingstationservice')->name('ipnursingstationservice');
            Route::get('/ippatienttransfer/{uuid}', 'ippatienttransfer')->name('ippatienttransfer');
            Route::get('/ipassesment/{inpatientuuid}/{ipassesmentuuid?}', 'ipassesment')->name('ipassesment');
            Route::get('/inpatientdischarge/{uuid}', 'inpatientdischarge')->name('inpatientdischarge');
            Route::get('/ipscheduleotlist/{uuid}', 'ipscheduleotlist')->name('ipscheduleotlist');
            Route::get('/ipscheduleot/{inpatientuuid}/{otscheduleuuid?}', 'ipscheduleot')->name('ipscheduleot');
            Route::get('/printipbarcode/{inpatient}', 'printipbarcode')->name('printipbarcode');
            Route::get('/printipprescription/{ipassessment}', 'printipprescription')->name('printipprescription');
            Route::get('/printdischargesummary/{inpatient}', 'printdischargesummary')->name('printdischargesummary');
            Route::get('/printipinvestigation/{ipassessment}', 'printipinvestigation')->name('printipinvestigation');
            Route::get('/printipinvestigationresult/{ipassessment}', 'printipinvestigationresult')->name('printipinvestigationresult');
            Route::get('/inpatientvisitentry', 'inpatientvisitentry')->name('inpatientvisitentry');
            Route::get('/inpatienthistory', 'inpatienthistory')->name('inpatienthistory');
            Route::get('/ipassesmentlist/{uuid}', 'ipassesmentlist')->name('ipassesmentlist');
            Route::get('/ipotscheduledlist/{uuid}', 'ipotscheduledlist')->name('ipotscheduledlist');
        });

    // Insurance
    Route::controller(PatientinsuranceController::class)
        ->group(function () {
            Route::get('/patientinsurancelist', 'patientinsurancelist')->name('patientinsurancelist');
            Route::get('/patientinsurance/{uuid}/{type}', 'patientinsurance')->name('patientinsurance');
            Route::get('/patientinsurancehistory', 'patientinsurancehistory')->name('patientinsurancehistory');
        });

    // Operation theatre
    Route::controller(OperationtheatreController::class)
        ->group(function () {
            Route::get('/otcalendar', 'otcalendar')->name('otcalendar');
            Route::get('/otscheduling/{uuid?}', 'otscheduling')->name('otscheduling');
            Route::get('/otschedulelist', 'otschedulelist')->name('otschedulelist');
            Route::get('/otpreopnotes/{otschedule_uuid}', 'otpreopnotes')->name('otpreopnotes');
            Route::get('/otpostopnotes/{otschedule_uuid}', 'otpostopnotes')->name('otpostopnotes');
            Route::get('/othistory', 'othistory')->name('othistory');
        });

    // Ward Management
    Route::controller(WardmanagementController::class)
        ->group(function () {
            Route::get('/wardtypemanagement', 'wardtypemanagement')->name('wardtypemanagement');
            Route::get('/wardfloormanagement', 'wardfloormanagement')->name('wardfloormanagement');
            Route::get('/wardavailability', 'wardavailability')->name('wardavailability');
            Route::get('/wardhousekeeping', 'wardhousekeeping')->name('wardhousekeeping');
            Route::get('/wardroomblocked', 'wardroomblocked')->name('wardroomblocked');
        });

    // Billing
    Route::controller(OpbillingController::class)
        ->group(function () {
            Route::get('/opbilling', 'opbilling')->name('opbilling');
            Route::get('/opbillingaddservice/{uuid}', 'opbillingaddservice')->name('opbillingaddservice');
            Route::get('/opbillpayment/{uuid}', 'opbillpayment')->name('opbillpayment');
            Route::get('/printopreceipt/{receipt}', 'printopreceipt')->name('printopreceipt');
            Route::get('/printbillinglist/{opbillinglist}', 'printbillinglist')->name('printbillinglist');
        });
    Route::controller(IpbillingController::class)
        ->group(function () {
            Route::get('/ipbilling', 'ipbilling')->name('ipbilling');
            Route::get('/ipbillingservice/{uuid}', 'ipbillingservice')->name('ipbillingservice');
            Route::get('/ipbillpayment/{uuid}', 'ipbillpayment')->name('ipbillpayment');
            Route::get('/ippaymentreceiptprint/{receipt}', 'ippaymentreceiptprint')->name('ippaymentreceiptprint');
            Route::get('/printdetailedipbill/{ipbilling}', 'printdetailedipbill')->name('printdetailedipbill');
            Route::get('/printconsolidatedipbill/{ipbilling}', 'printconsolidatedipbill')->name('printconsolidatedipbill');
        });

    Route::controller(OtbillingController::class)
        ->group(function () {
            Route::get('/otbilling', 'otbilling')->name('otbilling');
            Route::get('/otbillingservice/{uuid}', 'otbillingservice')->name('otbillingservice');
            Route::get('/otbillpayment/{uuid}', 'otbillpayment')->name('otbillpayment');
            Route::get('/printotbill/{otbilling}', 'printotbill')->name('printotbill');
            Route::get('/otpaymentreceiptprint/{receipt}', 'otpaymentreceiptprint')->name('otpaymentreceiptprint');
        });

    Route::controller(ReceiptController::class)
        ->group(function () {
            Route::get('/receipt', 'receipt')->name('receipt');
            Route::get('/receipthistory', 'receipthistory')->name('receipthistory');
            Route::get('/printreceiptentry/{receipt}', 'printreceiptentry')->name('printreceiptentry');
        });

    Route::controller(BilldiscountController::class)
        ->group(function () {
            Route::get('/billdiscount', 'billdiscount')->name('billdiscount');
            Route::get('/billdiscounthistory', 'billdiscounthistory')->name('billdiscounthistory');
        });

    Route::controller(PaymentvoucherController::class)
        ->group(function () {
            Route::get('/paymentvoucherentry', 'paymentvoucherentry')->name('paymentvoucherentry');
            Route::get('/paymentvoucherhistory', 'paymentvoucherhistory')->name('paymentvoucherhistory');
            Route::get('/paymentvoucherprint/{paymentvoucher}', 'paymentvoucherprint')->name('paymentvoucherprint');

        });

    // EMR
    Route::get('/emr', [EmrController::class, 'emr'])->name('emr');
    // Facility
    Route::get('/facility', [FacilityController::class, 'facility'])->name('facility');
    // Reports
    Route::get('/adminreports', [AdminreportsController::class, 'adminreports'])->name('adminreports');
    Route::controller(PatientreportsController::class)
        ->group(function () {
            Route::get('/patientregisterreport', 'patientregisterreport')->name('patientregisterreport');
            Route::get('/patientvisitreport', 'patientvisitreport')->name('patientvisitreport');
        });
    Route::controller(OutpatientreportsController::class)
        ->group(function () {
            Route::get('/outpatientreport', 'outpatientreport')->name('outpatientreport');
            Route::get('/doctorwiseopvisitreport', 'doctorwiseopvisitreport')->name('doctorwiseopvisitreport');
            Route::get('/doctorwiseopbillreport', 'doctorwiseopbillreport')->name('doctorwiseopbillreport');
        });

    Route::controller(InpatientreportsController::class)
        ->group(function () {
            Route::get('/inpatientreport', 'inpatientreport')->name('inpatientreport');
            Route::get('/scheduledsurgeryreport', 'scheduledsurgeryreport')->name('scheduledsurgeryreport');
            Route::get('/completedsurgeryreport', 'completedsurgeryreport')->name('completedsurgeryreport');
            Route::get('/dischargedpatientreport', 'dischargedpatientreport')->name('dischargedpatientreport');
        });
    Route::controller(AccountreportsController::class)
        ->group(function () {
            Route::get('/adminreceiptreport', 'adminreceiptreport')->name('adminreceiptreport');
            Route::get('/adminpaymentvoucherreport', 'adminpaymentvoucherreport')->name('adminpaymentvoucherreport');
            Route::get('/adminbilldiscountreport', 'adminbilldiscountreport')->name('adminbilldiscountreport');
            Route::get('/hospitalstatementreport', 'hospitalstatementreport')->name('hospitalstatementreport');
            Route::get('/patientstatementreport', 'patientstatementreport')->name('patientstatementreport');
            Route::get('/employeestatementreport', 'employeestatementreport')->name('employeestatementreport');
            Route::get('/supplierstatementreport', 'supplierstatementreport')->name('supplierstatementreport');
        });

    Route::controller(BillingreportsController::class)
        ->group(function () {
            Route::get('/opbillingreport', 'opbillingreport')->name('opbillingreport');
            Route::get('/ipbillingreport', 'ipbillingreport')->name('ipbillingreport');
            Route::get('/otbillingreport', 'otbillingreport')->name('otbillingreport');
        });
    Route::controller(FacilityreportsController::class)
        ->group(function () {
            Route::get('/facilitylistreport', 'facilitylistreport')->name('facilitylistreport');
        });
    Route::controller(LogreportsController::class)
        ->group(function () {
            Route::get('/loginlogsreport', 'loginlogsreport')->name('loginlogsreport');
            Route::get('/trackinglogsreport', 'trackinglogsreport')->name('trackinglogsreport');
        });

    // Settings
    Route::get('/settings', [AdminsettingsController::class, 'index'])->name('settings');

    // Employee
    Route::get('addemployee', [EmployeeController::class, 'addemployee'])->name('addemployee');
    // Master Settings
    Route::get('locationmaster', [LocationmasterController::class, 'locationmaster'])->name('locationmaster');

    //Patient Registeration Settings
    Route::get('referencemaster', [ReferencemasterController::class, 'referencemaster'])->name('referencemaster');
    Route::get('country', [CountryController::class, 'country'])->name('country');
    Route::get('states', [StateController::class, 'states'])->name('states');

    //Patient Visit Settings
    Route::get('allergymaster', [AllergymasterController::class, 'allergymaster'])->name('allergymaster');
    Route::get('currentcomplaints', [CurrentcomplaintsController::class, 'currentcomplaints'])->name('currentcomplaints');
    Route::get('insurancecompanymaster', [InsurancecompanymasterController::class, 'insurancecompanymaster'])->name('insurancecompanymaster');

    // OP Settings
    Route::get('opservicemaster', [OpservicemasterController::class, 'opservicemaster'])->name('opservicemaster');
    Route::get('diagnosismaster', [DiagnosismasterController::class, 'diagnosismaster'])->name('diagnosismaster');
    Route::get('physicalexam', [PhysicalexamController::class, 'physicalexam'])->name('physicalexam');

    // IP Settings
    Route::get('ipservicecategory', [IpservicecategoryController::class, 'ipservicecategory'])->name('ipservicecategory');
    Route::get('ipservicemaster', [IpservicemasterController::class, 'ipservicemaster'])->name('ipservicemaster');
    Route::get('iptreatment', [IptreatmentController::class, 'iptreatment'])->name('iptreatment');

    // Document Settings
    Route::get('medicaldocument', [MedicaldocumentController::class, 'medicaldocument'])->name('medicaldocument');

    //Investigation Setting
    Route::controller(AdmininvestigationController::class)
        ->group(function () {
            Route::get('/adminlabinvestigation', 'adminlabinvestigation')->name('adminlabinvestigation');
            Route::get('/adminlabinvestigationgroup', 'adminlabinvestigationgroup')->name('adminlabinvestigationgroup');
            Route::get('/adminlabunit', 'adminlabunit')->name('adminlabunit');
            Route::get('/adminlabtestmethod', 'adminlabtestmethod')->name('adminlabtestmethod');
        });

    //Pharmacy Setting
    Route::controller(AdminpharmacyController::class)
        ->group(function () {
            Route::get('/adminpharmacysettings', 'adminpharmacysettings')->name('adminpharmacysettings');
            //Pharmacy Category
            Route::get('/adminpharmacycategory', 'adminpharmacycategory')->name('adminpharmacycategory');
            //Pharmacy Sub Category
            Route::get('/adminpharmacysubcategory', 'adminpharmacysubcategory')->name('adminpharmacysubcategory');
            //Pharmacy Genaric Setting
            Route::get('/adminpharmacygenaric', 'adminpharmacygenaric')->name('adminpharmacygenaric');
            //Pharmacy Manufacture Setting
            Route::get('/adminpharmacymanufacture', 'adminpharmacymanufacture')->name('adminpharmacymanufacture');
            //Add Product
            Route::get('/adminpharmacyproduct', 'adminpharmacyproduct')->name('adminpharmacyproduct');
            //Alternative Product
            Route::get('/adminalternativepharmacyproduct/{productid}', 'adminalternativepharmacyproduct')->name('adminalternativepharmacyproduct');
        });

    //Supplier Settings
    Route::get('supplier', [SupplierController::class, 'supplier'])->name('supplier');

    // Doctor Settings
    Route::get('adddoctor', [AdddoctorController::class, 'adddoctor'])->name('adddoctor');
    Route::get('doctorspecialization', [DoctorspecializationController::class, 'doctorspecialization'])->name('doctorspecialization');
    Route::get('doctorconsultationfee', [DoctorconsultationfeeController::class, 'doctorconsultationfee'])->name('doctorconsultationfee');

    // Ward Settings
    Route::get('wardfloor', [WardfloorController::class, 'wardfloor'])->name('wardfloor');
    Route::get('bedorroomnumber', [BedorroomnumberController::class, 'bedorroomnumber'])->name('bedorroomnumber');
    Route::get('wardtype', [WardtypeController::class, 'wardtype'])->name('wardtype');

    Route::get('/generalsetting', [GeneralsettingController::class, 'generalsetting'])->name('generalsetting');
    Route::get('/themesetting', [ThemesettingController::class, 'themesetting'])->name('themesetting');

    Route::controller(UserController::class)
        ->group(function () {
            Route::get('usercreateoredit', 'usercreateoredit')->name('usercreateoredit');
            Route::get('userchangepassword', 'userchangepassword')->name('userchangepassword');
            Route::get('userrole', 'userrole')->name('userrole');
            Route::get('permission/{id}', 'permission')->name('permission');

        });

    Route::get('logininfo', [LogininfoController::class, 'logininfo'])->name('logininfo');
    Route::get('tracking', [TrackingController::class, 'tracking'])->name('tracking');

    // Need to check
    Route::resources([
        //configuration
        'adminconfigurationweb' => AdminconfigurationwebController::class,
        'adminconfigurationkey' => AdminconfigurationkeyController::class,
        'color' => ColorController::class,
    ]);

    // System Info
    Route::controller(UserController::class)
        ->group(function () {
            Route::get('/systeminfo', 'systeminfo')->name('systeminfo');
            Route::get('/cacheclear', 'cacheclear')->name('cacheclear');
        });
});
