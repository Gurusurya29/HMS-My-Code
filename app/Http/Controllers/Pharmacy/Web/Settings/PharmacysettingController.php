<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings;

use App\Http\Controllers\Controller;

class PharmacysettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.mainmenu');
    }

    public function pharmacyadduser()
    {
        return view('pharmacy.settings.usersetting.adduser.addpharmacyuser');
    }

    public function pharmacychangepassword()
    {
        return view('pharmacy.settings.usersetting.changepassword.pharmacychangepassword');
    }

}
