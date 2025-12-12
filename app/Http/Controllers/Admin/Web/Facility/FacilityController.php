<?php

namespace App\Http\Controllers\Admin\Web\Facility;

use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    public function facility()
    {
        if (!auth()->user()->can('Facility')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.facility.facility');
    }
}
