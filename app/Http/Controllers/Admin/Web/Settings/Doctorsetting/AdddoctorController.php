<?php

namespace App\Http\Controllers\Admin\Web\Settings\Doctorsetting;

use App\Http\Controllers\Controller;

class AdddoctorController extends Controller
{
    public function adddoctor()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Doctor') || !auth()->user()->can('Add-doctor')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.doctorsetting.adddoctor.adddoctor');
    }
}
