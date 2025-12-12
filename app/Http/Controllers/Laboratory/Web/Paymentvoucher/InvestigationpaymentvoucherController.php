<?php

namespace App\Http\Controllers\Laboratory\Web\Paymentvoucher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Miscellaneous\Numbertowords;

class InvestigationpaymentvoucherController extends Controller
{
    public function investigationpaymentvoucherentry()
    {
        return view('laboratory.paymentvoucher.investigationpaymentvoucherentry.investigationpaymentvoucher');
    }

    public function investigationpaymentvoucherhistory()
    {
        return view('laboratory.paymentvoucher.investigationpaymentvoucherhistory.investigationpaymentvoucherhistory');
    }

    public function investigationvoucherprint(Paymentvoucher $investigationvoucher)
    {
        $amount_in_words = Numbertowords::numbertowords($investigationvoucher->paid_amount);
        return view('laboratory.paymentvoucher.investigationpaymentvoucherprint.investigationpaymentvoucherprint', compact('investigationvoucher', 'amount_in_words'));
    }
}
