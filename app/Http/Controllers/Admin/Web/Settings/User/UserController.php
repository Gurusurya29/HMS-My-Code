<?php

namespace App\Http\Controllers\Admin\Web\Settings\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function usercreateoredit()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('User') || !auth()->user()->can('Add-user')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.user.user.usercreateoredit');
    }

    public function userchangepassword()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('User') || !auth()->user()->can('Change-password')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.user.changepassword.userchangepassword');
    }

    public function userrole()
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('User') || !auth()->user()->can('User-role')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.user.role.userrole');
    }

    public function permission($id)
    {
        if (!auth()->user()->can('Settings') && !auth()->user()->can('User') && !auth()->user()->can('Add-user') || !auth()->user()->can('Assignpermission-userrole')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.settings.user.role.permission', compact('id'));
    }
}
