<?php

namespace App\Http\Controllers\Admin\Web\Reports\Patientreports;

use App\Http\Controllers\Controller;

class PatientreportsController extends Controller
{
    public function patientregisterreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Patient Report-Menu') || !auth()->user()->can('Patientregistration-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.patientreports.patientregisterreport.patientregisterreport');
    }

    public function patientvisitreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Patient Report-Menu') || !auth()->user()->can('Patientvisit-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.patientreports.patientvisitreport.patientvisitreport');
    }
}
