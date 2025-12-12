<?php

namespace App\Http\Livewire\Laboratory\Report\Scanreport;

use App\Export\Inverstigation\Scan\ScanpatientExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Laboratory\Scan\Scanpatient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Scanreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $scanpatient = $this->query()->get();
        return Excel::download(new ScanpatientExport($scanpatient), 'scanpatient.xls');
    }

    public function pdf()
    {
        $scanpatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.laboratory.report.scanreport.scanpatientpdf', compact('scanpatient'))->output();
        return response()->streamDownload(fn() => print($pdf), "scanpatient.pdf");
    }

    protected function query()
    {
        return Scanpatient::where('is_billgenerated', true)
            ->with('scanpatientlist', fn(Builder $q) =>
                $q->whereNotNull('is_movedtobill')
            )
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('scanpatientlist', fn(Builder $q) =>
                        $q->where('scaninvestigation_name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $scanpatient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.laboratory.report.scanreport.scanreportlivewire', compact('scanpatient'));
    }
}
