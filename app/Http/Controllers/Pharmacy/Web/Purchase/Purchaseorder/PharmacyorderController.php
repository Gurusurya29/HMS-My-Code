<?php

namespace App\Http\Controllers\Pharmacy\Web\Purchase\Purchaseorder;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Numbertowords;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;

class PharmacyorderController extends Controller
{
    public function index()
    {
        return view('pharmacy.purchase.purchaseorder.index');
    }

    public function createoredit($purchaseplanninguuid = null)
    {
        return view('pharmacy.purchase.purchaseplanning.createoredit', compact('purchaseplanninguuid'));
    }
    public function purchaseorderprint(Pharmpurchaseorder $purchaseorder)
    {
        $amount_in_words = Numbertowords::numbertowords($purchaseorder->grand_total);
        return view('pharmacy.purchase.purchaseorder.purchaseorderprint', compact('purchaseorder', 'amount_in_words'));
    }
}
