<?php

namespace App\Http\Controllers\Pharmacy\Web\Paymentvoucher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Miscellaneous\Numbertowords;

class PharmacypaymentvoucherController extends Controller
{
    public function pharmacypaymentvoucherentry()
    {
        return view('pharmacy.paymentvoucher.pharmacypaymentvoucherentry.pharmacypaymentvoucher');
    }

    public function pharmacypaymentvoucherhistory()
    {
        return view('pharmacy.paymentvoucher.pharmacypaymentvoucherhistory.pharmacypaymentvoucherhistory');
    }

    public function pharmacypaymentvoucherprint(Paymentvoucher $pharmacypaymentvoucher)
    {
        $amount_in_words = Numbertowords::numbertowords($pharmacypaymentvoucher->paid_amount);
        return view('pharmacy.paymentvoucher.pharmacypaymentvoucherprint.pharmacypaymentvoucherprint', compact('pharmacypaymentvoucher', 'amount_in_words'));
    }
}
