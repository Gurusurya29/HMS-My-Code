<?php

namespace App\Http\Controllers\Admin\Web\Reports\Billingreports;

use App\Http\Controllers\Controller;

class BillingreportsController extends Controller
{
    public function opbillingreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Billing Report-Menu') || !auth()->user()->can('OP Billing-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.billingreports.opbillingreport.opbillingreport');
    }

    public function ipbillingreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Billing Report-Menu') || !auth()->user()->can('IP Billing-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.billingreports.ipbillingreport.ipbillingreport');
    }

    public function otbillingreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Billing Report-Menu') || !auth()->user()->can('OT Billing-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.billingreports.otbillingreport.otbillingreport');
    }
}
