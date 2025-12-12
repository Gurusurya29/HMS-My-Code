<?php

namespace App\Export\Inverstigation\Scan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ScanbillreportExport implements FromView
{

    // a place to store the team dependency
    private $scanpatient;

    // use constructor to handle dependency injection
    public function __construct($scanpatient)
    {
        $this->scanpatient = $scanpatient;
    }

    public function view(): View
    {
        return view('livewire.laboratory.report.scanreport.scanbillreportpdf', [
            'scanpatient' => $this->scanpatient,
        ]);
    }
}
