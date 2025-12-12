<?php

namespace App\Export\Inverstigation\Xray;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class XraybillreportExport implements FromView
{

    // a place to store the team dependency
    private $xraypatient;

    // use constructor to handle dependency injection
    public function __construct($xraypatient)
    {
        $this->xraypatient = $xraypatient;
    }

    public function view(): View
    {
        return view('livewire.laboratory.report.xrayreport.xraybillreportpdf', [
            'xraypatient' => $this->xraypatient,
        ]);
    }
}
