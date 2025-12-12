<?php

namespace App\Http\Controllers\Laboratory\Web\Xray\Homepage;

use App\Http\Controllers\Controller;

class XrayhomepageController extends Controller
{
    public function xrayhomepage()
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.homepage.xrayhomepage');
    }

    public function xraypatientwalkin()
    {
        if ($this->xraypermission()) {
            return redirect()->back();
        }
        return view('laboratory.xray.patientwalkin.xraypatientwalkin');
    }

    protected function xraypermission()
    {
        if (!auth()->guard('laboratory')->user()->access_xray) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return true;
        }
    }

}
