<?php

namespace App\Export\Inverstigation\Receipt;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReceiptreportExport implements FromView
{

    // a place to store the team dependency
    private $receiptreport;

    // use constructor to handle dependency injection
    public function __construct($receiptreport)
    {
        $this->receiptreport = $receiptreport;
    }

    public function view(): View
    {
        return view('livewire.laboratory.report.receiptreport.receiptreportpdf', [
            'receiptreport' => $this->receiptreport,
        ]);
    }
}
