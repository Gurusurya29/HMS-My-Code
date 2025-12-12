<?php

namespace App\Http\Controllers\Admin\Web\Reports\Outpatientreports;

use App\Http\Controllers\Controller;

class OutpatientreportsController extends Controller
{
    public function outpatientreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Outpatient Report-Menu') || !auth()->user()->can('Outpatient-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.outpatientreports.outpatientreport.outpatientreport');
    }

    public function doctorwiseopvisitreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Outpatient Report-Menu') || !auth()->user()->can('Doctor Wise OP Visit-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.outpatientreports.doctorwiseopvisit.doctorwiseopvisitreport');
    }

    public function doctorwiseopbillreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Outpatient Report-Menu') || !auth()->user()->can('Doctor Wise OP Bill-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.outpatientreports.doctorwiseopbill.doctorwiseopbillreport');
    }
}
