<?php

namespace App\Http\Controllers\Admin\Web\Settings\Doctorsetting;

use App\Http\Controllers\Controller;

class DoctorspecializationController extends Controller
{
    public function doctorspecialization()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Doctor') || !auth()->user()->can('Doctor-specialization')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.doctorsetting.doctorspecialization.doctorspecialization');
    }
}
