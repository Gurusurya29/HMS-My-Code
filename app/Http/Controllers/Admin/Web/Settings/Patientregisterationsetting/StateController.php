<?php

namespace App\Http\Controllers\Admin\Web\Settings\Patientregisterationsetting;

use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function states()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Patient-Registration') || !auth()->user()->can('State')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.patientregisterationsetting.states.states');
    }
}
