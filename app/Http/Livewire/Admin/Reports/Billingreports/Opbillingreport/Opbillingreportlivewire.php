<?php

namespace App\Http\Livewire\Admin\Reports\Billingreports\Opbillingreport;

use App\Export\Admin\Reports\Billingreport\Opbillingreport\OpbillingreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Opbillingreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $opbilling = $this->query()->get();
        return Excel::download(new OpbillingreportExport($opbilling), 'opbilling.xls');
    }

    public function pdf()
    {
        $opbilling = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.billingreports.opbillingreport.opbillingreportpdf', compact('opbilling'))->output();
        return response()->streamDownload(fn() => print($pdf), "opbilling.pdf");
    }

    protected function query()
    {
        return Opbillinglist::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
            );
    }

    public function render()
    {
        $opbilling = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $grand_total = $this->query()->sum('grand_total');

        return view('livewire.admin.reports.billingreports.opbillingreport.opbillingreportlivewire', compact('opbilling', 'grand_total'));
    }

}
