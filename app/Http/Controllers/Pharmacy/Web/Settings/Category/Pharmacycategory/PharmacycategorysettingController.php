<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings\Category\Pharmacycategory;

use App\Http\Controllers\Controller;

class PharmacycategorysettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.category.pharmacycategory.index');
    }
}
