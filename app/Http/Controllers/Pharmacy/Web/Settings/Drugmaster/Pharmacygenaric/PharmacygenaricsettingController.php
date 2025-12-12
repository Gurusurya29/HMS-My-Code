<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings\Drugmaster\Pharmacygenaric;

use App\Http\Controllers\Controller;

class PharmacygenaricsettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.drugmaster.pharmacygenaric.index');
    }
}
