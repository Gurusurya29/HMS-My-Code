<?php

namespace App\Http\Controllers\Admin\Web\Reports;

use App\Http\Controllers\Controller;

class AdminreportsController extends Controller
{
    public function adminreports()
    {
        if (!auth()->user()->can('Reports')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.reports.adminreports');
    }
}
