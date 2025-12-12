<?php

namespace App\Http\Livewire\Admin\Reports\Accountreports\Hospitalstatementreport;

use App\Export\Admin\Reports\Accountreport\Hospitalstatementreport\HospitalstatementreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Account\Hospital\Hospitalstatement;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Hospitalstatementreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $hospitalstatement = $this->query()->get();
        return Excel::download(new HospitalstatementreportExport($hospitalstatement), 'hospitalstatement.xls');
    }

    public function pdf()
    {
        $hospitalstatement = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.accountreports.hospitalstatementreport.hospitalstatementreportpdf', compact('hospitalstatement'))->output();
        return response()->streamDownload(fn() => print($pdf), "hospitalstatement.pdf");
    }

    protected function query()
    {
        return Hospitalstatement::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('statement_ref_id', 'like', '%' . $this->searchTerm . '%')
            )
        ;
    }

    public function render()
    {
        $hospitalstatement = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        $balance_statement_debit = round($this->query()->sum('debit'), 2);
        $balance_statement_credit = round($this->query()->sum('credit'), 2);
        $balance = round($this->query()->sum('debit') - $this->query()->sum('credit'), 2);

        return view('livewire.admin.reports.accountreports.hospitalstatementreport.hospitalstatementreportlivewire', compact('hospitalstatement', 'balance', 'balance_statement_debit', 'balance_statement_credit'));
    }

}
