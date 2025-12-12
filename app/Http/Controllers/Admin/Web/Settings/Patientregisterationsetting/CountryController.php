<?php

namespace App\Http\Controllers\Admin\Web\Settings\Patientregisterationsetting;

use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function country()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Patient-Registration') || !auth()->user()->can('Country')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.patientregisterationsetting.country.country');
    }
}
