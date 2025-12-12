<?php

namespace App\Http\Controllers\Pharmacy\Web\Receipt;

use App\Http\Controllers\Controller;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Numbertowords;

class PharmacyreceiptController extends Controller
{
    public function pharmacyreceipt()
    {
        return view('pharmacy.receipt.pharmacyreceipt');
    }

    public function pharmacyreceipthistory()
    {
        return view('pharmacy.receipt.pharmacyreceipthistory');
    }

    public function printreceiptentry(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        return view('pharmacy.receipt.pharmacyreceiptentryprint', compact('receipt', 'amount_in_words'));
    }
}
