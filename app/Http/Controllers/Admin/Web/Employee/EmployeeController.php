<?php

namespace App\Http\Controllers\Admin\Web\Employee;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function addemployee()
    {
        if (!auth()->user()->can('Settings') || !auth()->user()->can('Employee')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.employee.addemployee.index');
    }
}
