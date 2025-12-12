<?php

namespace App\Http\Controllers\Admin\Web\Billing\Billdiscount;

use App\Http\Controllers\Controller;

class BilldiscountController extends Controller
{
    public function billdiscount()
    {
        if (!auth()->user()->can('Billing') && !auth()->user()->can('Bill discount/cancel') && !auth()->user()->can('Bill discount-entry')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.billdiscount.billdiscountentry.billdiscount');
    }

    public function billdiscounthistory()
    {
        if (!auth()->user()->can('Billing') && !auth()->user()->can('Bill discount/cancel') && !auth()->user()->can('Bill discount-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.billing.billdiscount.billdiscounthistory.billdiscounthistory');
    }
}
