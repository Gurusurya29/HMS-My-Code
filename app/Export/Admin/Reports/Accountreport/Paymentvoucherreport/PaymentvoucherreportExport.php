<?php

namespace App\Export\Admin\Reports\Accountreport\Paymentvoucherreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentvoucherreportExport implements FromView
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
        return view('livewire.admin.reports.accountreports.paymentvoucherreport.paymentvoucherreportpdf', [
            'paymentvoucher' => $this->paymentvoucher,
        ]);
    }
}
