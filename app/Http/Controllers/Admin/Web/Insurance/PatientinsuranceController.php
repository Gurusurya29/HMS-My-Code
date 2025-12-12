<?php

namespace App\Http\Controllers\Admin\Web\Insurance;

use App\Http\Controllers\Controller;

class PatientinsuranceController extends Controller
{
    public function patientinsurancelist()
    {
        if (!auth()->user()->can('Insurance') && !auth()->user()->can('Insurance-list')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.insurance.patientinsurance.patientinsurancelist.patientinsurancelist');
    }

    public function patientinsurance($patientinsurance_uuid, $type)
    {
        if (!auth()->user()->can('Insurance') && !auth()->user()->can('Insurance-list') || !auth()->user()->can('Insurance-process')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.insurance.patientinsurance.patientinsurancecreate.patientinsurance', compact('patientinsurance_uuid', 'type'));
    }

    public function patientinsurancehistory()
    {
        if (!auth()->user()->can('Insurance') && !auth()->user()->can('Insurance-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.insurance.patientinsurance.patientinsurancehistory.patientinsurancehistory');
    }

}
