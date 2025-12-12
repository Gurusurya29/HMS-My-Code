<?php

namespace App\Http\Controllers\Admin\Web\Settings\Patientregisterationsetting;

use App\Http\Controllers\Controller;

class ReferencemasterController extends Controller
{
    public function referencemaster()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Patient-Registration') || !auth()->user()->can('Referance')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.patientregisterationsetting.referencemaster.referencemaster');
    }
}
