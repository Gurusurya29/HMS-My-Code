<?php

namespace App\Http\Controllers\Admin\Web\Settings\Tracking;

use App\Http\Controllers\Controller;

class LogininfoController extends Controller
{

    public function logininfo()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Logs') || !auth()->user()->can('Login-logs')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.tracking.logininfo');
    }

}
