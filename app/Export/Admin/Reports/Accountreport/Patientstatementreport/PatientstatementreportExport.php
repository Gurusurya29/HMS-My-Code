<?php

namespace App\Export\Admin\Reports\Accountreport\Patientstatementreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PatientstatementreportExport implements FromView
{

    // a place to store the team dependency
    private $patientstatement;

    // use constructor to handle dependency injection
    public function __construct($patientstatement)
    {
        $this->patientstatement = $patientstatement;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.accountreports.patientstatementreport.patientstatementreportpdf', [
            'patientstatement' => $this->patientstatement,
        ]);
    }
}
