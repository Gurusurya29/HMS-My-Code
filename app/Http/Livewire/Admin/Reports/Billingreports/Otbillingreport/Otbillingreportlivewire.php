<?php

namespace App\Http\Livewire\Admin\Reports\Billingreports\Otbillingreport;

use App\Export\Admin\Reports\Billingreport\Otbillingreport\OtbillingreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Billing\Otbilling\Otbilling;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Otbillingreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $otbilling = $this->query()->get();
        return Excel::download(new OtbillingreportExport($otbilling), 'otbilling.xls');
    }

    public function pdf()
    {
        $otbilling = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.billingreports.otbillingreport.otbillingreportpdf', compact('otbilling'))->output();
        return response()->streamDownload(fn() => print($pdf), "otbilling.pdf");
    }

    protected function query()
    {
        return Otbilling::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
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
        $otbilling = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $grand_total = $this->query()->sum('grand_total');

        return view('livewire.admin.reports.billingreports.otbillingreport.otbillingreportlivewire', compact('otbilling', 'grand_total'));
    }

}
