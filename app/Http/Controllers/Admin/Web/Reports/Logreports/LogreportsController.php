<?php

namespace App\Http\Controllers\Admin\Web\Reports\Logreports;

use App\Http\Controllers\Controller;

class LogreportsController extends Controller
{
    public function loginlogsreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Log Report-Menu') || !auth()->user()->can('Loginlogs-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.logreports.loginlogsreport.loginlogsreport');
    }

    public function trackinglogsreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Log Report-Menu') || !auth()->user()->can('Trackinglogs-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.logreports.trackinglogsreport.trackinglogsreport');
    }
}
