<?php

namespace App\Http\Controllers\Pharmacy\Web\Purchase\Purchaseplanning;

use App\Http\Controllers\Controller;

class PharmacyplanningController extends Controller
{
    public function index()
    {
        return view('pharmacy.purchase.purchaseplanning.index');
    }

    public function createoredit($purchaseplanninguuid = null)
    {
        return view('pharmacy.purchase.purchaseplanning.createoredit', compact('purchaseplanninguuid'));
    }
}
