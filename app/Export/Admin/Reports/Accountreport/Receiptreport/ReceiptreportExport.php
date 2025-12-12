<?php

namespace App\Export\Admin\Reports\Accountreport\Receiptreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReceiptreportExport implements FromView
{

    // a place to store the team dependency
    private $receipt;

    // use constructor to handle dependency injection
    public function __construct($receipt)
    {
        $this->receipt = $receipt;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.accountreports.receiptreport.receiptreportpdf', [
            'receipt' => $this->receipt,
        ]);
    }
}
