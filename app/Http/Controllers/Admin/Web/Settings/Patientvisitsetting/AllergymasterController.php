<?php

namespace App\Http\Controllers\Admin\Web\Settings\Patientvisitsetting;

use App\Http\Controllers\Controller;

class AllergymasterController extends Controller
{
    public function allergymaster()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Patient-Visit') || !auth()->user()->can('Allergy')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.patientvisitsetting.allergymaster.allergymaster');
    }
}
