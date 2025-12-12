<?php

namespace App\Export\Admin\Reports\Accountreport\Hospitalstatementreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HospitalstatementreportExport implements FromView
{

    // a place to store the team dependency
    private $hospitalstatement;

    // use constructor to handle dependency injection
    public function __construct($hospitalstatement)
    {
        $this->hospitalstatement = $hospitalstatement;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.accountreports.hospitalstatementreport.hospitalstatementreportpdf', [
            'hospitalstatement' => $this->hospitalstatement,
        ]);
    }
}
