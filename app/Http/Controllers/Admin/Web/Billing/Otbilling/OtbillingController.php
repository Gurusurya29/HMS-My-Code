<?php

namespace App\Http\Controllers\Admin\Web\Billing\Otbilling;

use App\Http\Controllers\Controller;
use App\Models\Admin\Billing\Otbilling\Otbilling;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Numbertowords;

class OtbillingController extends Controller
{
    public function otbilling()
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('OT-Billing')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.otbilling.otbilling');
    }

    public function otbillingservice($otbilling_uuid)
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('OT-Billing') || !auth()->user()->can('Otbill')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.otbilling.otbillingservice', compact('otbilling_uuid'));
    }

    public function otbillpayment($otbilling_uuid)
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('OT-Billing') || !auth()->user()->can('Otpaybill')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.otbilling.otbillpayment', compact('otbilling_uuid'));
    }

    public function otpaymentreceiptprint(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        return view('admin.billing.otbilling.otpaymentreceipt', compact('receipt', 'amount_in_words'));
    }

    public function printotbill(Otbilling $otbilling)
    {
        $amount_in_words = Numbertowords::numbertowords($otbilling->grand_total);
        return view('admin.billing.otbilling.otbillingpdf', compact('otbilling', 'amount_in_words'));
    }
}
