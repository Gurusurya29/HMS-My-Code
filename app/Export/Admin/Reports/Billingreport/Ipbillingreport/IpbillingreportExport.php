<?php

namespace App\Export\Admin\Reports\Billingreport\Ipbillingreport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IpbillingreportExport implements FromView
{

    // a place to store the team dependency
    private $ipbilling;

    // use constructor to handle dependency injection
    public function __construct($ipbilling)
    {
        $this->ipbilling = $ipbilling;
    }

    public function view(): View
    {
        return view('livewire.admin.reports.billingreports.ipbillingreport.ipbillingreportpdf', [
            'ipbilling' => $this->ipbilling,
        ]);
    }
}
