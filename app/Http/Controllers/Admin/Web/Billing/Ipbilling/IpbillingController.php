<?php

namespace App\Http\Controllers\Admin\Web\Billing\Ipbilling;

use App\Http\Controllers\Controller;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Numbertowords;

class IpbillingController extends Controller
{
    public function ipbilling()
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('IP-Billing')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.ipbilling.ipbilling');
    }

    public function ipbillingservice($ipbilling_uuid)
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('IP-Billing') || !auth()->user()->can('Ipbill')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.ipbilling.ipbillingservice', compact('ipbilling_uuid'));
    }

    public function ipbillpayment($ipbilling_uuid)
    {
        if (!auth()->user()->can('Billing') || !auth()->user()->can('IP-Billing') || !auth()->user()->can('Ippaybill')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.ipbilling.ipbillpayment', compact('ipbilling_uuid'));
    }

    public function ippaymentreceiptprint(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        return view('admin.billing.ipbilling.ippaymentreceipt', compact('receipt', 'amount_in_words'));
    }

    public function printdetailedipbill(Ipbilling $ipbilling)
    {
        $bill_list = $ipbilling->ipbillingservicelist->groupBy('ipservicecategory_name');
        return view('admin.billing.ipbilling.ipdetailedbill', compact('ipbilling', 'bill_list'));
    }

    public function printconsolidatedipbill(Ipbilling $ipbilling)
    {
        $bill_list = $ipbilling->ipbillingservicelist->groupBy('ipservicecategory_name');
        return view('admin.billing.ipbilling.ipconsolidatedbill', compact('ipbilling', 'bill_list'));
    }

}
