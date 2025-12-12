<?php

namespace App\Export\Admin\Reports\Accountreport\Billdiscountreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BilldiscountreportExport implements FromView
{

    // a place to store the team dependency
    private $billdiscount;

    // use constructor to handle dependency injection
    public function __construct($billdiscount)
    {
        $this->billdiscount = $billdiscount;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.accountreports.billdiscountreport.billdiscountreportpdf', [
            'billdiscount' => $this->billdiscount,
        ]);
    }
}
