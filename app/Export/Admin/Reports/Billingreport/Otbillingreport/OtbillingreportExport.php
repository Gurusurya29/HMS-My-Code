<?php

namespace App\Export\Admin\Reports\Billingreport\Otbillingreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OtbillingreportExport implements FromView
{

    // a place to store the team dependency
    private $otbilling;

    // use constructor to handle dependency injection
    public function __construct($otbilling)
    {
        $this->otbilling = $otbilling;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.billingreports.otbillingreport.otbillingreportpdf', [
            'otbilling' => $this->otbilling,
        ]);
    }
}
