<?php

namespace App\Http\Controllers\Admin\Web\Settings\Generalsetting;

use App\Http\Controllers\Controller;

class GeneralsettingController extends Controller
{

    public function generalsetting()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('General-Menu') || !auth()->user()->can('General')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.generalsetting.generalsetting.generalsetting');
    }

}
