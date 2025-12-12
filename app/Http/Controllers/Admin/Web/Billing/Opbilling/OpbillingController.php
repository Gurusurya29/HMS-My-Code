<?php

namespace App\Http\Controllers\Admin\Web\Billing\Opbilling;

use App\Http\Controllers\Controller;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Numbertowords;

class OpbillingController extends Controller
{
    public function opbilling()
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('OP-Billing')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.opbilling.opbilling');
    }

    public function opbillingaddservice($opbilling_uuid)
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('OP-Billing') || !auth()->user()->can('Opbill')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.opbilling.opbillingaddservice', compact('opbilling_uuid'));
    }

    public function opbillpayment($opbilling_uuid)
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('OP-Billing') || !auth()->user()->can('Oppaybill')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.opbilling.opbillpayment', compact('opbilling_uuid'));
    }

    public function printopreceipt(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        return view('admin.billing.opbilling.oppaymentreceipt', compact('receipt', 'amount_in_words'));
    }

    public function printbillinglist(Opbillinglist $opbillinglist)
    {
        return view('admin.billing.opbilling.opbillinglistpdf', compact('opbillinglist'));
    }
}
