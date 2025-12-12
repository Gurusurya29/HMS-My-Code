<?php

namespace App\Http\Controllers\Pharmacy\Web\Settings\Product;

use App\Http\Controllers\Controller;

class PharmacyproductsettingController extends Controller
{
    public function index()
    {
        return view('pharmacy.settings.product.product.index');
    }

    public function alternativepharmacyproduct($productid)
    {
        if (!auth()->guard('pharmacy')->user()->isAdmin()) {
            toast('You do not have the required authorization.', 'error', 'top-right');
            return redirect()->back();
        }
        return view('pharmacy.settings.product.alternativeproduct.index', compact('productid'));
    }
}
