<?php

namespace App\Http\Controllers\Laboratory\Web\Report;

use App\Http\Controllers\Controller;

class InvestigationreportController extends Controller
{
    public function investigationreport()
    {
        return view('laboratory.report.investigationreport');
    }

    public function labreport()
    {
        if (!auth()->guard('laboratory')->user()->access_lab) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.labreport.labreport');
    }

    public function labbillreport()
    {
        if (!auth()->guard('laboratory')->user()->access_lab) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.labreport.labbillreport');
    }

    public function scanreport()
    {
        if (!auth()->guard('laboratory')->user()->access_scan) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.scanreport.scanreport');
    }

    public function scanbillreport()
    {
        if (!auth()->guard('laboratory')->user()->access_scan) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.scanreport.scanbillreport');
    }

    public function xrayreport()
    {
        if (!auth()->guard('laboratory')->user()->access_xray) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.xrayreport.xrayreport');
    }

    public function xraybillreport()
    {
        if (!auth()->guard('laboratory')->user()->access_xray) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.xrayreport.xraybillreport');
    }

    public function receiptreport()
    {
        if (!auth()->guard('laboratory')->user()->isAdmin()) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.receiptreport.receiptreport');
    }

    public function paymentvoucherreport()
    {
        if (!auth()->guard('laboratory')->user()->isAdmin()) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('laboratory.report.paymentvoucherreport.paymentvoucherreport');
    }

}
