<?php

namespace App\Export\Inverstigation\Laboratory;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LabbillreportExport implements FromView
{

    // a place to store the team dependency
    private $labpatient;

    // use constructor to handle dependency injection
    public function __construct($labpatient)
    {
        $this->labpatient = $labpatient;
    }

    public function view(): View
    {
        return view('livewire.laboratory.report.labreport.labbillreportpdf', [
            'labpatient' => $this->labpatient,
        ]);
    }
}
