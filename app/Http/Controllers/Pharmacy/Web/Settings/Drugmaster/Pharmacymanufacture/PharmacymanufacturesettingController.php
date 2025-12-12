<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings\Drugmaster\Pharmacymanufacture;

use App\Http\Controllers\Controller;

class PharmacymanufacturesettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.drugmaster.pharmacymanufacture.index');
    }
}
