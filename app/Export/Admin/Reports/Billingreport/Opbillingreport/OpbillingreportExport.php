<?php

namespace App\Export\Admin\Reports\Billingreport\Opbillingreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OpbillingreportExport implements FromView
{

    // a place to store the team dependency
    private $opbilling;

    // use constructor to handle dependency injection
    public function __construct($opbilling)
    {
        $this->opbilling = $opbilling;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.billingreports.opbillingreport.opbillingreportpdf', [
            'opbilling' => $this->opbilling,
        ]);
    }
}
