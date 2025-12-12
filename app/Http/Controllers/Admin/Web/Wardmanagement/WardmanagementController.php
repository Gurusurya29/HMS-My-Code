<?php

namespace App\Http\Controllers\Admin\Web\Wardmanagement;

use App\Http\Controllers\Controller;

class WardmanagementController extends Controller
{

    public function wardtypemanagement()
    {
        if (!auth()->user()->can('Wardmanagement') && !auth()->user()->can('Ward-typestatus')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.wardmanagement.wardtypemanagement');
    }
    public function wardfloormanagement()
    {
        if (!auth()->user()->can('Wardmanagement') && !auth()->user()->can('Ward-floorstatus')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.wardmanagement.wardfloormanagement');
    }
    public function wardavailability()
    {
        if (!auth()->user()->can('Wardmanagement') && !auth()->user()->can('Ward-availability')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.wardmanagement.wardavailability');
    }
    public function wardhousekeeping()
    {
        if (!auth()->user()->can('Wardmanagement') && !auth()->user()->can('Ward-housekeeping')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.wardmanagement.wardhousekeeping');
    }
    public function wardroomblocked()
    {
        if (!auth()->user()->can('Wardmanagement') && !auth()->user()->can('Ward-blockbed')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.wardmanagement.wardroomblocked');
    }

}
