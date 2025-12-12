<?php

namespace App\Http\Controllers\Laboratory\Web\Laboratory\Labpatient;

use App\Http\Controllers\Controller;
use App\Models\Laboratory\Laboratory\Labpatient;

class LabpatientController extends Controller
{

    public function laboratorypatientlist()
    {

        if ($this->labpermission()) {
            return redirect()->back();
        }

        return view('laboratory.laboratory.patientlist.laboratorypatientlist');
    }

    public function labpatientmovetobill($uuid)
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.patientlist.labpatientmovetobill', compact('uuid'));
    }

    public function labbillingprint($uuid)
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        $labpatient = Labpatient::where('uuid', $uuid)
            ->where('is_billgenerated', true)
            ->first();

        return view('laboratory.laboratory.patientlist.labbilling', compact('labpatient'));
    }

    public function labsample($uuid)
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.patientlist.labsample', compact('uuid'));
    }

    public function labresultentry($uuid)
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.patientlist.labresultentry', compact('uuid'));
    }

    public function labdelivery($uuid)
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.patientlist.labdelivery', compact('uuid'));
    }

    public function labprint($uuid)
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        $labpatient = Labpatient::where('uuid', $uuid)->first();
        return view('laboratory.laboratory.patientlist.labprint', compact('labpatient'));
    }

    public function laboratorypatienthistory()
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.patienthistory.laboratorypatienthistory');
    }

    protected function labpermission()
    {
        if (!auth()->guard('laboratory')->user()->access_lab) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return true;
        }
    }
}
