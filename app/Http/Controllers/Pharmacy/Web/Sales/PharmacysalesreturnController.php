<?php

namespace App\Http\Controllers\Pharmacy\Web\Sales;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturn;

class PharmacysalesreturnController extends Controller
{
    public function index()
    {
        return view('pharmacy.sales.salesreturn.index');
    }

    public function create()
    {
        return view('pharmacy.sales.salesreturn.create');
    }
    public function salesreturnprint(Pharmsalesreturn $salesreturn)
    {
        return view('pharmacy.sales.salesreturn.salesreturnprint', compact('salesreturn'));
    }
}
