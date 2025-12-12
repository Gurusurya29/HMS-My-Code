<?php

namespace App\Http\Controllers\Admin\Web\Settings\Opsetting;

use App\Http\Controllers\Controller;

class DiagnosismasterController extends Controller
{
    public function diagnosismaster()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Out-Patient') || !auth()->user()->can('Diagnosis')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.opsetting.diagnosismaster.diagnosismaster');
    }
}
