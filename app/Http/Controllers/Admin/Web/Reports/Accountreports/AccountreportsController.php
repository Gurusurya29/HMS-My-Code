<?php

namespace App\Http\Controllers\Admin\Web\Reports\Accountreports;

use App\Http\Controllers\Controller;

class AccountreportsController extends Controller
{
    public function adminreceiptreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Receipt-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.receiptreport.receiptreport');
    }

    public function adminpaymentvoucherreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Paymentvoucher-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.paymentvoucherreport.paymentvoucherreport');
    }

    public function adminbilldiscountreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Billdiscount-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.billdiscountreport.billdiscountreport');
    }

    public function hospitalstatementreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Hospital Ledger-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.hospitalstatementreport.hospitalstatementreport');
    }

    public function patientstatementreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Patient Ledger-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.patientstatementreport.patientstatementreport');
    }

    public function employeestatementreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Employee Ledger-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.employeestatementreport.employeestatementreport');
    }

    public function supplierstatementreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Finance Report-Menu') || !auth()->user()->can('Supplier Ledger-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.accountreports.supplierstatementreport.supplierstatementreport');
    }

}
