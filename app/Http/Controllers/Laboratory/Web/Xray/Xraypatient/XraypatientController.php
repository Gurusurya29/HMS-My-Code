<?php

namespace App\Http\Controllers\Laboratory\Web\Xray\Xraypatient;

use App\Http\Controllers\Controller;
use App\Models\Laboratory\Xray\Xraypatient;

class XraypatientController extends Controller
{

    public function xraypatientlist()
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patientlist.xraypatientlist');
    }

    public function xraypatientmovetobill($uuid)
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patientlist.xraypatientmovetobill', compact('uuid'));
    }

    public function xraybillingprint($uuid)
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        $xraypatient = Xraypatient::where('uuid', $uuid)->first();
        return view('laboratory.xray.patientlist.xraybilling', compact('xraypatient'));
    }

    public function xraysample($uuid)
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patientlist.xraysample', compact('uuid'));
    }

    public function xrayresultentry($uuid)
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patientlist.xrayresultentry', compact('uuid'));
    }

    public function xraydelivery($uuid)
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patientlist.xraydelivery', compact('uuid'));
    }

    public function xrayprint($uuid)
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        $xraypatient = Xraypatient::where('uuid', $uuid)->first();
        return view('laboratory.xray.patientlist.xrayprint', compact('xraypatient'));
    }

    public function xraypatienthistory()
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patienthistory.xraypatienthistory');
    }

    protected function xraypermission()
    {
        if (!auth()->guard('laboratory')->user()->access_xray) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return true;
        }
    }
}
