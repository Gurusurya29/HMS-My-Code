<?php

namespace App\Http\Controllers\Pharmacy\Web\Sales;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Numbertowords;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;

class PharmacysalesentryController extends Controller
{
    public function index()
    {
        return view('pharmacy.sales.salesentry.index');
    }

    public function createorhms($prescriptionuuid = null)
    {
        return view('pharmacy.sales.salesentry.create', compact('prescriptionuuid'));
    }

    public function salesentryprint(Pharmsalesentry $salesentry)
    {
        $amount_in_words = Numbertowords::numbertowords($salesentry->grand_total);
        return view('pharmacy.sales.salesentry.salesentryprint', compact('salesentry', 'amount_in_words'));
    }
}
