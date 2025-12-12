<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Side Nav Start
            'Dashboard' => 'side_nav',
            'Registration' => 'side_nav',
            'Billing' => 'side_nav',
            'Paymentvoucher' => 'side_nav',
            'Insurance' => 'side_nav',
            'Outpatient' => 'side_nav',
            'Inpatient' => 'side_nav',
            'Operationtheatre' => 'side_nav',
            'Wardmanagement' => 'side_nav',
            'Emr' => 'side_nav',
            'Humanresource' => 'side_nav',
            'Facility' => 'side_nav',
            'Reports' => 'side_nav',
            'Settings' => 'side_nav',
            // Registration
            'Patientregistration' => 'registration_subnav',
            'Patientmasterlist' => 'registration_subnav',

            'Patientvisitentry' => 'newpatientregistration_tab',
            'Patientvisithistory' => 'newpatientregistration_tab',
            'Inpatientlist' => 'newpatientregistration_tab',

            'Patientvisithistory-view' => 'patientvisithistory',
            'Patientvisithistory-edit' => 'patientvisithistory',

            'Patientmasterlist-view' => 'patientmasterlist',
            'Patientmasterlist-edit' => 'patientmasterlist',
            // Billing
            'OP-Billing' => 'billing_subnav',
            'IP-Billing' => 'billing_subnav',
            'OT-Billing' => 'billing_subnav',
            'Receipt' => 'billing_subnav',
            'Bill discount/cancel' => 'billing_subnav',
            // OP-Billing
            'Opbill' => 'opbilling',
            'Oppaybill' => 'opbilling',
            // IP-Billing
            'Ipbill' => 'ipbilling',
            'Ippaybill' => 'ipbilling',
            // OT-Billing
            'Otbill' => 'otbilling',
            'Otpaybill' => 'otbilling',
            //Receipt
            'Receipt-history' => 'receipt_tab',
            'Receipt-entry' => 'receipt_tab',
            //Bill discount
            'Bill discount-history' => 'billdiscount_tab',
            'Bill discount-entry' => 'billdiscount_tab',
            //Paymentvoucher
            'Paymentvoucher-history' => 'paymentvoucher_tab',
            'Paymentvoucher-entry' => 'paymentvoucher_tab',
            //Insurance
            'Insurance-history' => 'insurance_tab',
            'Insurance-list' => 'insurance_tab',
            'Insurance-process' => 'insurance_tab',
            //Outpatient
            'Outpatient-list' => 'outpatient_tab',
            'Outpatient-visitentry' => 'outpatient_tab',
            'Outpatient-history' => 'outpatient_tab',
            // Outpatient-list
            'Outpatient-assesment' => 'outpatient_list',
            'Outpatient-view' => 'outpatient_list',
            // Outpatient-history
            'Outpatienthistory-assesment' => 'outpatient_history',
            'Outpatienthistory-view' => 'outpatient_history',
            'Outpatienthistory-print' => 'outpatient_history',
            //Inpatient
            'Inpatient-list' => 'inpatient_tab',
            'Inpatient-visitentry' => 'inpatient_tab',
            'Inpatient-history' => 'inpatient_tab',
            // Inpatient-list
            'Inpatient-admission' => 'inpatient_list',
            'Inpatient-nursingstation' => 'inpatient_list',
            'Inpatient-discharge' => 'inpatient_list',
            //Inpatient-nursingstation
            'IP-services' => 'inpatient_nursingstation',
            'IP-assesment' => 'inpatient_nursingstation',
            'IP-patienttransfer' => 'inpatient_nursingstation',
            'IP-otschedule' => 'inpatient_nursingstation',
            // Inpatient-history
            'Inpatienthistory-view' => 'inpatient_history',
            'Inpatienthistory-dischargeprint' => 'inpatient_history',
            //Operationtheatre
            'OT-Calendar' => 'operationtheatre_tab',
            'OT-Schedule' => 'operationtheatre_tab',
            'OT-history' => 'operationtheatre_tab',
            // OT-Schedule
            'OT-New_Surgery' => 'ot_schedule',
            'OT-Surgerydetails' => 'ot_schedule',
            'OT-Surgerynotes' => 'ot_schedule',
            'OT-MovetoIP' => 'ot_schedule',
            'OT-View' => 'ot_schedule',
            // OT-history
            'OT-Historyview' => 'ot_history',
            // Wardmanagement
            'Ward-availability' => 'wardmanagement_tab',
            'Ward-typestatus' => 'wardmanagement_tab',
            'Ward-floorstatus' => 'wardmanagement_tab',
            'Ward-housekeeping' => 'wardmanagement_tab',
            'Ward-blockbed' => 'wardmanagement_tab',
            // Facility
            'Add-Facility' => 'facility',
            'View-Facility' => 'facility',
            'Edit-Facility' => 'facility',

            // Reports
            'Patient Report-Menu' => 'reports_menu',
            'Outpatient Report-Menu' => 'reports_menu',
            'Inpatient Report-Menu' => 'reports_menu',
            'Billing Report-Menu' => 'reports_menu',
            'Finance Report-Menu' => 'reports_menu',
            'Facility Report-Menu' => 'reports_menu',
            'Log Report-Menu' => 'reports_menu',

            // Patien Reports
            'Patientregistration-report' => 'patient_report_menu',
            'Patientvisit-report' => 'patient_report_menu',
            // Out Patient Report
            'Outpatient-report' => 'outpatient_report_menu',
            'Doctor Wise OP Visit-report' => 'outpatient_report_menu',
            'Doctor Wise OP Bill-report' => 'outpatient_report_menu',
            // In Patient Report
            'Inpatient-report' => 'inpatient_report_menu',
            'Scheduled Surgery-report' => 'inpatient_report_menu',
            'Completed Surgery-report' => 'inpatient_report_menu',
            'Dischargedpatient-report' => 'inpatient_report_menu',
            // Billing Report
            'OP Billing-report' => 'billing_report_menu',
            'IP Billing-report' => 'billing_report_menu',
            'OT Billing-report' => 'billing_report_menu',
            // Finance Report
            'Receipt-report' => 'finance_report_menu',
            'Paymentvoucher-report' => 'finance_report_menu',
            'Billdiscount-report' => 'finance_report_menu',
            'Hospital Ledger-report' => 'finance_report_menu',
            'Patient Ledger-report' => 'finance_report_menu',
            'Employee Ledger-report' => 'finance_report_menu',
            'Supplier Ledger-report' => 'finance_report_menu',
            // Facility Report
            'Facilitylist-report' => 'facility_report_menu',
            // Log Report
            'Loginlogs-report' => 'log_report_menu',
            'Trackinglogs-report' => 'log_report_menu',

            // Settings
            'Patient-Registration' => 'settings_menu',
            'Patient-Visit' => 'settings_menu',
            'Out-Patient' => 'settings_menu',
            'In-Patient' => 'settings_menu',
            'Doctor' => 'settings_menu',
            'Ward' => 'settings_menu',
            'Supplier-Menu' => 'settings_menu',
            'Investigation' => 'settings_menu',
            'Pharmacy' => 'settings_menu',
            'User' => 'settings_menu',
            'Employee' => 'settings_menu',
            'General-Menu' => 'settings_menu',
            'Logs' => 'settings_menu',
            // Settings Patient-Registration
            'Referance' => 'settings_patientreg',
            'Country' => 'settings_patientreg',
            'State' => 'settings_patientreg',
            // Settings Patient-Visit
            'Allergy' => 'settings_patientvisit',
            'Current-complaints' => 'settings_patientvisit',
            'Insurance-company' => 'settings_patientvisit',
            // Settings Out Patient
            'Diagnosis' => 'settings_outpatient',
            'Physical-and-general' => 'settings_outpatient',
            'OP-billing-services' => 'settings_outpatient',
            // Settings In Patient
            'IP-treatment' => 'settings_inpatient',
            'IP-service-category' => 'settings_inpatient',
            'IP-billing-services' => 'settings_inpatient',
            // Settings Doctor
            'Add-doctor' => 'settings_doctor',
            'Doctor-specialization' => 'settings_doctor',
            // Settings Ward
            'Ward-type' => 'settings_ward',
            'Ward-floor/block' => 'settings_ward',
            'Bed-or-room-number' => 'settings_ward',
            // Settings Supplier
            'Supplier' => 'settings_supplier',
            // Settings Investigation
            'Investigation-name' => 'settings_investigation',
            'Investigation-group' => 'settings_investigation',
            'Unit' => 'settings_investigation',
            'Test-method' => 'settings_investigation',
            // Settings Pharmacy
            'Pharmacy-master' => 'settings_pharmacy',
            // Settings User
            'Add-user' => 'settings_user',
            'Change-password' => 'settings_user',
            'User-role' => 'settings_user',
            // Settings Employee
            'Add-employee' => 'settings_employee',
            // Settings General
            'General' => 'settings_general',
            // Settings Logs
            'Login-logs' => 'settings_logs',
            'Tracking-logs' => 'settings_logs',
            // Settings Referance
            'Add-referance' => 'settings_patientreg_referance',
            'View-referance' => 'settings_patientreg_referance',
            'Edit-referance' => 'settings_patientreg_referance',
            // Settings Country
            'Add-country' => 'settings_patientreg_country',
            'View-country' => 'settings_patientreg_country',
            'Edit-country' => 'settings_patientreg_country',
            // Settings State
            'Add-state' => 'settings_patientreg_state',
            'View-state' => 'settings_patientreg_state',
            'Edit-state' => 'settings_patientreg_state',
            // Settings Allergy
            'Add-allergy' => 'settings_patientvisit_allergy',
            'View-allergy' => 'settings_patientvisit_allergy',
            'Edit-allergy' => 'settings_patientvisit_allergy',
            // Settings Current Complaints
            'Add-currentcomplaints' => 'settings_patientvisit_currentcomplaints',
            'View-currentcomplaints' => 'settings_patientvisit_currentcomplaints',
            'Edit-currentcomplaints' => 'settings_patientvisit_currentcomplaints',
            // Settings Insurance Company
            'Add-insurancecompany' => 'settings_patientvisit_insurancecompany',
            'View-insurancecompany' => 'settings_patientvisit_insurancecompany',
            'Edit-insurancecompany' => 'settings_patientvisit_insurancecompany',
            // Settings Diagnosis
            'Add-diagnosis' => 'settings_outpatient_diagnosis',
            'View-diagnosis' => 'settings_outpatient_diagnosis',
            'Edit-diagnosis' => 'settings_outpatient_diagnosis',
            // Settings Physical & General Examination
            'Add-physicalandgeneral' => 'settings_outpatient_physicalandgeneral',
            'View-physicalandgeneral' => 'settings_outpatient_physicalandgeneral',
            'Edit-physicalandgeneral' => 'settings_outpatient_physicalandgeneral',
            // Settings OP Billing Services
            'Add-opbillingservices' => 'settings_outpatient_opbillingservices',
            'View-opbillingservices' => 'settings_outpatient_opbillingservices',
            'Edit-opbillingservices' => 'settings_outpatient_opbillingservices',
            // Settings IP Treatment
            'Add-iptreatment' => 'settings_inpatient_iptreatment',
            'View-iptreatment' => 'settings_inpatient_iptreatment',
            'Edit-iptreatment' => 'settings_inpatient_iptreatment',
            // Settings IP Service Category
            'Add-ipservicecategory' => 'settings_inpatient_ipservicecategory',
            'View-ipservicecategory' => 'settings_inpatient_ipservicecategory',
            'Edit-ipservicecategory' => 'settings_inpatient_ipservicecategory',
            // Settings IP Billing Services
            'Add-ipbillingservices' => 'settings_inpatient_ipbillingservices',
            'View-ipbillingservices' => 'settings_inpatient_ipbillingservices',
            'Edit-ipbillingservices' => 'settings_inpatient_ipbillingservices',
            // Settings Add Doctor
            'Add-newdoctor' => 'settings_doctor_adddoctor',
            'View-doctor' => 'settings_doctor_adddoctor',
            'Edit-doctor' => 'settings_doctor_adddoctor',
            // Settings Ward Type
            'Add-wardtype' => 'settings_ward_wardtype',
            'View-wardtype' => 'settings_ward_wardtype',
            'Edit-wardtype' => 'settings_ward_wardtype',
            // Settings Ward Floor/Block
            'Add-wardfloor/block' => 'settings_ward_wardfloor/block',
            'View-wardfloor/block' => 'settings_ward_wardfloor/block',
            'Edit-wardfloor/block' => 'settings_ward_wardfloor/block',
            // Settings Bed Or Room Number
            'Add-bed/roomnumber' => 'settings_ward_bed/roomnumber',
            'View-bed/roomnumber' => 'settings_ward_bed/roomnumber',
            'Edit-bed/roomnumber' => 'settings_ward_bed/roomnumber',
            // Settings Supplier
            'Add-supplier' => 'settings_supplier_addsupplier',
            'View-supplier' => 'settings_supplier_addsupplier',
            'Edit-supplier' => 'settings_supplier_addsupplier',
            // Settings Pharmacy master
            'Pharmacy-category' => 'settings_pharmacymaster',
            'Pharmacy-drugmaster' => 'settings_pharmacymaster',
            'Pharmacy-product' => 'settings_pharmacymaster',
            // Settings Add User
            'Add-newuser' => 'settings_user_adduser',
            'View-user' => 'settings_user_adduser',
            'Edit-user' => 'settings_user_adduser',
            // Settings User Role
            'Add-userrole' => 'settings_user_userrole',
            'Assignpermission-userrole' => 'settings_user_userrole',
            'View-userrole' => 'settings_user_userrole',
            'Edit-userrole' => 'settings_user_userrole',
            // Settings Add Employee
            'Add-newemployee' => 'settings_employee_addemployee',
            'View-employee' => 'settings_employee_addemployee',
            'Edit-employee' => 'settings_employee_addemployee',

        ];

        foreach ($permissions as $key => $value) {
            Permission::create(['name' => $key, 'permissionsheading' => $value]);
        }
    }
}
