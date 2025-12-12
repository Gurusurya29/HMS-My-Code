<?php

namespace App\Http\Controllers\Admin\Web\Patientregistration;

use App\Http\Controllers\Controller;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Patient\Auth\Patient;

class PatientregistrationController extends Controller
{
    public function patientregistration()
    {
        if (!auth()->user()->can('Registration') && !auth()->user()->can('Patientregistration') && !auth()->user()->can('Patientvisitentry')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");

        }
        return view('admin.patientregistration.patientregistration.patientregistration');
    }

    public function patientmasterlist()
    {
        if (!auth()->user()->can('Registration') || !auth()->user()->can('Patientmasterlist')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.patientregistration.patientmasterlist.patientmasterlist');
    }

    public function patientappointment()
    {
        return view('admin.patientregistration.patientappointment.patientappointment');
    }

    public function patientvisithistory()
    {
        if (!auth()->user()->can('Registration') && !auth()->user()->can('Patientregistration') && !auth()->user()->can('Patientvisithistory')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.patientregistration.patientvisithistory.patientvisithistory');
    }

    public function patientvisithistoryedit($uuid)
    {
        return view('admin.patientregistration.patientvisithistory.patientvisitedit.patientvisitedit', compact('uuid'));
    }

    public function inpatientlist()
    {
        if (!auth()->user()->can('Registration') && !auth()->user()->can('Patientregistration') && !auth()->user()->can('Inpatientlist')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.patientregistration.inpatientlist.inpatientlist');
    }

    public function printlabel(Patient $patient)
    {
        return view('admin.patientregistration.patientmasterlist.patientprintlabel', compact('patient'));
    }
    public function printtoken(Patientvisit $patientvisit)
    {
        return view('admin.patientregistration.patientvisithistory.patientprinttoken', compact('patientvisit'));
    }
}
