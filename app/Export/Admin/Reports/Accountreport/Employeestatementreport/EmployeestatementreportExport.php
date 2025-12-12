<?php

namespace App\Export\Admin\Reports\Accountreport\Employeestatementreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeestatementreportExport implements FromView
{

    // a place to store the team dependency
    private $employeestatement;

    // use constructor to handle dependency injection
    public function __construct($employeestatement)
    {
        $this->employeestatement = $employeestatement;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.accountreports.employeestatementreport.employeestatementreportpdf', [
            'employeestatement' => $this->employeestatement,
        ]);
    }
}
