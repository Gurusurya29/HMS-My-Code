<?php

namespace App\Http\Controllers\Admin\Web\Settings\Ipsetting;

use App\Http\Controllers\Controller;

class IptreatmentController extends Controller
{
    public function iptreatment()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('In-Patient') || !auth()->user()->can('IP-treatment')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.ipsetting.iptreatment.iptreatment');
    }
}
