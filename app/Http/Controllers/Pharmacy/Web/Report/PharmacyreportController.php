<?php

namespace App\Http\Controllers\Pharmacy\Web\Report;

use App\Http\Controllers\Controller;

class PharmacyreportController extends Controller
{
    public function index()
    {
        return view('pharmacy.report.index');
    }

    public function purchasereportindex()
    {
        return view('pharmacy.report.purchase.purchasereportindex');
    }

    public function purchaseentryindex()
    {
        return view('pharmacy.report.purchase.purchaseentryindex');
    }

    public function purchaseitemreturn()
    {
        return view('pharmacy.report.purchase.purchaseitemreturn');
    }

    public function salesreportindex()
    {
        return view('pharmacy.report.sale.salesreportindex');
    }

    public function salesitemreportindex()
    {
        return view('pharmacy.report.sale.salesitemreportindex');
    }

    public function salesitemreturn()
    {
        return view('pharmacy.report.sale.salesitemreturn');
    }

    public function productreportindex()
    {
        return view('pharmacy.report.product.productreportindex');
    }

    public function productexpiryreport()
    {
        return view('pharmacy.report.product.productexpiryreport');
    }

    public function receiptreportindex()
    {
        return view('pharmacy.report.receipt.receiptreportindex');
    }

    public function paymentvoucher()
    {
        return view('pharmacy.report.paymentvoucher.paymentvoucherreportindex');
    }
}
