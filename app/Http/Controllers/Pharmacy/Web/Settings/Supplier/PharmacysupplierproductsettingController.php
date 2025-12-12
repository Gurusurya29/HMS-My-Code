<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings\Supplier;

use App\Http\Controllers\Controller;

class PharmacysupplierproductsettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.supplier.pharmacysupplierproduct.index');
    }

    public function pharmacymapsupplierproduct($supplieruuid)
    {
        if (!auth()->guard('pharmacy')->user()->isAdmin()) {
            toast('You do not have the required authorization.', 'error', 'top-right');
            return redirect()->back();
        }
        return view('pharmacy.settings.supplier.pharmacysupplierproduct.mapproduct', compact('supplieruuid'));
    }
}
