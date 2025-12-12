<?php

namespace App\Http\Controllers\Pharmacy\Web\Purchase\Purchaseentry;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;

class PharmacypurchaseentryController extends Controller
{
    public function index()
    {
        return view('pharmacy.purchase.purchaseentry.index');
    }

    public function create()
    {
        return view('pharmacy.purchase.purchaseentry.create');
    }

    public function purchaseentryreceiptprint(Pharmpurchaseentry $purchaseentry)
    {
        return view('pharmacy.purchase.purchaseentry.purchaseentryreceipt', compact('purchaseentry'));
    }

}
