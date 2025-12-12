<?php

namespace App\Http\Controllers\Admin\Web\Reports\Facilityreports;

use App\Http\Controllers\Controller;

class FacilityreportsController extends Controller
{
    public function facilitylistreport()
    {
        if (!auth()->user()->can('Reports') && !auth()->user()->can('Facility Report-Menu') || !auth()->user()->can('Facilitylist-report')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.facilityreports.facilitylistreport.facilitylistreport');
    }
}
