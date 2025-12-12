<?php

namespace App\Export\Pharmacy\Report\Receipt;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PharmacyreceiptentryExport implements FromView
{

    // a place to store the team dependency
    private $receiptentry;

    // use constructor to handle dependency injection
    public function __construct($receiptentry)
    {
        $this->receiptentry = $receiptentry;
    }

    public function view(): View
    {
        return view('livewire.pharmacy.report.receipt.receiptpdf', [
            'receiptentry' => $this->receiptentry,
        ]);
    }
}
