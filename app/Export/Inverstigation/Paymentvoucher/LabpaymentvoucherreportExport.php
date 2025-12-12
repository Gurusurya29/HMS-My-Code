<?php

namespace App\Export\Inverstigation\Paymentvoucher;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LabpaymentvoucherreportExport implements FromView
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
        return view('livewire.laboratory.report.paymentvoucherreport.paymentvoucherreportpdf', [
            'paymentvoucher' => $this->paymentvoucher,
        ]);
    }
}
