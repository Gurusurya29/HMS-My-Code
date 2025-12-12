<?php

namespace App\Http\Controllers\Admin\Web\Settings\Wardsetting;

use App\Http\Controllers\Controller;

class WardtypeController extends Controller
{
    public function wardtype()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Ward') || !auth()->user()->can('Ward-type')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.wardsetting.wardtype.wardtype');
    }
}
