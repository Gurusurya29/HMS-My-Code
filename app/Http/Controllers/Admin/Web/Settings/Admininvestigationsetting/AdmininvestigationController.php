<?php

namespace App\Http\Controllers\Admin\Web\Settings\Admininvestigationsetting;

use App\Http\Controllers\Controller;

class AdmininvestigationController extends Controller
{
    public function adminlabinvestigation()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Investigation') || !auth()->user()->can('Investigation-name')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.admininvestigationsettings.labinvestigation.labinvestigation');
    }

    public function adminlabinvestigationgroup()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Investigation') || !auth()->user()->can('Investigation-group')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.admininvestigationsettings.labinvestigationgroup.labinvestigationgroup');
    }

    public function adminlabunit()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Investigation') || !auth()->user()->can('Unit')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.admininvestigationsettings.labunit.labunit');
    }

    public function adminlabtestmethod()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('Investigation') || !auth()->user()->can('Test-method')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.admininvestigationsettings.labtestmethod.labtestmethod');
    }
}
