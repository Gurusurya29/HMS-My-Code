<?php

namespace App\Export\Admin\Reports\Accountreport\Supplierstatementreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SupplierstatementreportExport implements FromView
{

    // a place to store the team dependency
    private $supplierstatement;

    // use constructor to handle dependency injection
    public function __construct($supplierstatement)
    {
        $this->supplierstatement = $supplierstatement;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.accountreports.supplierstatementreport.supplierstatementreportpdf', [
            'supplierstatement' => $this->supplierstatement,
        ]);
    }
}
