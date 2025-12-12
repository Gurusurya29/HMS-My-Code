<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings\Branch;

use App\Http\Controllers\Controller;

class PharmacybranchsettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.branch.pharmbranch.index');
    }
}
