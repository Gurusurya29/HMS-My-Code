<?php

namespace App\Http\Controllers\Admin\Web\Settings\Ipsetting;

use App\Http\Controllers\Controller;

class IpservicemasterController extends Controller
{
    public function ipservicemaster()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('In-Patient') || !auth()->user()->can('IP-billing-services')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.ipsetting.ipservicemaster.ipservicemaster');
    }
}
