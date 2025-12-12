<?php

namespace App\Http\Controllers\Admin\Web\Reports\Inpatientreports;

use App\Http\Controllers\Controller;

class InpatientreportsController extends Controller
{
    public function inpatientreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Inpatient Report-Menu') || !auth()->user()->can('Inpatient-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.inpatientreports.inpatientreport.inpatientreport');
    }

    public function scheduledsurgeryreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Inpatient Report-Menu') || !auth()->user()->can('Scheduled Surgery-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.inpatientreports.scheduledsurgery.scheduledsurgeryreport');
    }

    public function completedsurgeryreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Inpatient Report-Menu') || !auth()->user()->can('Completed Surgery-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.inpatientreports.completedsurgery.completedsurgeryreport');
    }

    public function dischargedpatientreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Inpatient Report-Menu') || !auth()->user()->can('Dischargedpatient-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.inpatientreports.dischargedpatient.dischargedpatientreport');
    }
}
