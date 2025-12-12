<?php

namespace App\Http\Controllers\Admin\Web\Settings\Ipsetting;

use App\Http\Controllers\Controller;

class IpservicecategoryController extends Controller
{
    public function ipservicecategory()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('In-Patient') || !auth()->user()->can('IP-service-category')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.ipsetting.ipservicecategory.ipservicecategory');
    }
}
