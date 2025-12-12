<?php

namespace App\Http\Controllers\Pharmacy\Web\Purchase\Purchasereturn;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Purchase\Purchasereturn\Pharmpurchasereturn;

class PharmacypurchasereturnController extends Controller
{
    public function index()
    {
        return view('pharmacy.purchase.purchasereturn.index');
    }

    public function create()
    {
        return view('pharmacy.purchase.purchasereturn.create');
    }

    public function purchasereturnprint(Pharmpurchasereturn $purchasereturn)
    {
        return view('pharmacy.purchase.purchasereturn.purchasereturnprint', compact('purchasereturn'));
    }
}
