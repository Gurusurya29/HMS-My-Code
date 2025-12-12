<?php

namespace App\Http\Controllers\Laboratory\Web\Settings;

use App\Http\Controllers\Controller;

class LaboratorysettingController extends Controller
{
    public function index()
    {
        return view('laboratory.settings.mainmenu');
    }

    public function laboratoryadduser()
    {
        if (auth()->guard('laboratory')->user()->role !== 'superadmin') {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.settings.usersetting.adduser.addlaboratoryuser');
    }

    public function laboratorychangepassword()
    {
        return view('laboratory.settings.usersetting.changepassword.laboratorychangepassword');
    }
}
