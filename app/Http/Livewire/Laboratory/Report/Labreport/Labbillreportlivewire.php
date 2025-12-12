<?php

namespace App\Http\Livewire\Laboratory\Report\Labreport;

use App\Export\Inverstigation\Laboratory\LabbillreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Laboratory\Laboratory\Labpatient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Labbillreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $labpatient = $this->query()->get();
        return Excel::download(new LabbillreportExport($labpatient), 'labpatient.xls');
    }

    public function pdf()
    {
        $labpatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.laboratory.report.labreport.labbillreportpdf', compact('labpatient'))->output();
        return response()->streamDownload(fn() => print($pdf), "labpatient.pdf");
    }

    protected function query()
    {
        return Labpatient::where('is_billgenerated', true)
            ->with('labpatientlist', fn(Builder $q) =>
                $q->whereNotNull('is_movedtobill')
            )
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    )

            )
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
    }

    public function render()
    {
        $labpatient = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $grand_total = $this->query()->sum('grand_total');

        return view('livewire.laboratory.report.labreport.labbillreportlivewire',
            compact('labpatient', 'grand_total'));
    }
}
