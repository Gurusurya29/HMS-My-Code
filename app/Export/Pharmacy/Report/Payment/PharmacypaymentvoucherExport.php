<?php

namespace App\Export\Pharmacy\Report\Payment;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PharmacypaymentvoucherExport implements FromView
{

    // a place to store the team dependency
    private $paymentvoucher;

    // use constructor to handle dependency injection
    public function __construct($paymentvoucher)
    {
        $this->paymentvoucher = $paymentvoucher;
    }

    public function view(): View
    {
        return view('livewire.pharmacy.report.paymentvoucher.paymentvoucherpdf', [
            'paymentvoucher' => $this->paymentvoucher,
        ]);
    }
}
