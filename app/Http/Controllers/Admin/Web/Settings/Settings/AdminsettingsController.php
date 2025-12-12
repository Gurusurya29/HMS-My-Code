<?php

namespace App\Http\Controllers\Admin\Web\Settings\Settings;

use App\Http\Controllers\Controller;

class AdminsettingsController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Settings')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.settings.settings');
    }

}
