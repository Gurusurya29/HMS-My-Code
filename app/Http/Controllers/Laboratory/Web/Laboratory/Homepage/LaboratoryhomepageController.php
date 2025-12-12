<?php

namespace App\Http\Controllers\Laboratory\Web\Laboratory\Homepage;

use App\Http\Controllers\Controller;

class LaboratoryhomepageController extends Controller
{
    public function laboratoryhomepage()
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.homepage.laboratoryhomepage');
    }

    public function laboratorypatientwalkin()
    {
        if ($this->labpermission()) {
            return redirect()->back();
        }
        return view('laboratory.laboratory.patientwalkin.laboratorypatientwalkin');
    }

    protected function labpermission()
    {
        if (!auth()->guard('laboratory')->user()->access_lab) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return true;
        }
    }
}
