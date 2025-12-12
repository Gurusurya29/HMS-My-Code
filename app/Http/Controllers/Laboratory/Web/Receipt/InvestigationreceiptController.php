<?php

namespace App\Http\Controllers\Laboratory\Web\Receipt;

use App\Http\Controllers\Controller;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Numbertowords;

class InvestigationreceiptController extends Controller
{
    public function investigationreceipt()
    {
        return view('laboratory.receipt.investigationreceipt');
    }

    public function investigationreceipthistory()
    {
        return view('laboratory.receipt.investigationreceipthistory');
    }

    public function printreceiptentry(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        return view('laboratory.receipt.investigationreceiptentryprint', compact('receipt', 'amount_in_words'));
    }

}
