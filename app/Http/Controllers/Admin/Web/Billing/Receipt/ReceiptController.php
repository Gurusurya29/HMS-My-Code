<?php

namespace App\Http\Controllers\Admin\Web\Billing\Receipt;

use App\Http\Controllers\Controller;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Numbertowords;

class ReceiptController extends Controller
{
    public function receipt()
    {
        if (!auth()->user()->can('Billing') && !auth()->user()->can('Receipt') && !auth()->user()->can('Receipt-entry')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.receipt.receiptentry.receipt');
    }

    public function receipthistory()
    {
        if (!auth()->user()->can('Billing') && !auth()->user()->can('Receipt') && !auth()->user()->can('Receipt-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.receipt.receipthistory.receipthistory');
    }

    public function printreceiptentry(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        return view('admin.billing.receipt.receiptentryprint.receiptentryprint', compact('receipt', 'amount_in_words'));
    }
}
