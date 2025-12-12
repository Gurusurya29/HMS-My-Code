<?php

namespace App\Http\Controllers\Admin\Web\Account\Paymentvoucher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Miscellaneous\Numbertowords;

class PaymentvoucherController extends Controller
{
    public function paymentvoucherentry()
    {
        if (!auth()->user()->can('Paymentvoucher') && !auth()->user()->can('Paymentvoucher-entry')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.account.paymentvoucher.paymentvoucherentry.paymentvoucher');
    }

    public function paymentvoucherhistory()
    {
        if (!auth()->user()->can('Paymentvoucher') && !auth()->user()->can('Paymentvoucher-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.account.paymentvoucher.paymentvoucherhistory.paymentvoucherhistory');
    }

    public function paymentvoucherprint(Paymentvoucher $paymentvoucher)
    {
        $amount_in_words = Numbertowords::numbertowords($paymentvoucher->paid_amount);
        return view('admin.account.paymentvoucher.paymentvoucherentryprint.paymentvoucherentryprint', compact('paymentvoucher', 'amount_in_words'));
    }
}
