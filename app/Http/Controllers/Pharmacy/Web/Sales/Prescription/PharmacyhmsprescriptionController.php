<?php

namespace App\Http\Controllers\Pharmacy\Web\Sales\Prescription;

use App\Http\Controllers\Controller;

class PharmacyhmsprescriptionController extends Controller
{
    public function index()
    {
        return view('pharmacy.sales.prescription.index');
    }
}
