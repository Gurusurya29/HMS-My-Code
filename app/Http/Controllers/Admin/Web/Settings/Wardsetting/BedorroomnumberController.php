<?php

namespace App\Http\Controllers\Admin\Web\Settings\Wardsetting;

use App\Http\Controllers\Controller;

class BedorroomnumberController extends Controller
{
    public function bedorroomnumber()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Ward') || !auth()->user()->can('Bed-or-room-number')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.wardsetting.bedorroomnumber.bedorroomnumber');
    }
}
