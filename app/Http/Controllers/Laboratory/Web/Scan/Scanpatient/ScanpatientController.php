<?php

namespace App\Http\Controllers\Laboratory\Web\Scan\Scanpatient;

use App\Http\Controllers\Controller;
use App\Models\Laboratory\Scan\Scanpatient;

class ScanpatientController extends Controller
{

    public function scanpatientlist()
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patientlist.scanpatientlist');
    }

    public function scanpatientmovetobill($uuid)
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patientlist.scanpatientmovetobill', compact('uuid'));
    }

    public function scanbillingprint($uuid)
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        $scanpatient = Scanpatient::where('uuid', $uuid)->first();
        return view('laboratory.scan.patientlist.scanbilling', compact('scanpatient'));
    }

    public function scansample($uuid)
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patientlist.scansample', compact('uuid'));
    }

    public function scanresultentry($uuid)
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patientlist.scanresultentry', compact('uuid'));
    }

    public function scandelivery($uuid)
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patientlist.scandelivery', compact('uuid'));
    }

    public function scanprint($uuid)
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        $scanpatient = Scanpatient::where('uuid', $uuid)->first();
        return view('laboratory.scan.patientlist.scanprint', compact('scanpatient'));
    }

    public function scanpatienthistory()
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patienthistory.scanpatienthistory');
    }

    protected function scanpermission()
    {
        if (!auth()->guard('laboratory')->user()->access_scan) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return true;
        }
    }
}
