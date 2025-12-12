<?php

namespace App\Http\Controllers\Admin\Web\Emr;

use App\Http\Controllers\Controller;

class EmrController extends Controller
{
    public function emr()
    {
        if (!auth()->user()->can('Emr')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.emr.index');
    }

}
