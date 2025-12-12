<?php

namespace App\Http\Controllers\Laboratory\Web\Scan\Homepage;

use App\Http\Controllers\Controller;

class ScanhomepageController extends Controller
{
    public function scanhomepage()
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.homepage.scanhomepage');
    }

    public function scanpatientwalkin()
    {
        if ($this->scanpermission()) {
            return redirect()->back();
        }
        return view('laboratory.scan.patientwalkin.scanpatientwalkin');
    }

    protected function scanpermission()
    {
        if (!auth()->guard('laboratory')->user()->access_scan) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return true;
        }
    }

}
