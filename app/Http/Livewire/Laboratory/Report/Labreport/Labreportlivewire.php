<?php

namespace App\Http\Livewire\Laboratory\Report\Labreport;

use App\Export\Inverstigation\Laboratory\LabpatientExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Laboratory\Laboratory\Labpatient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Labreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $labpatient = $this->query()->get();
        return Excel::download(new LabpatientExport($labpatient), 'labpatient.xls');
    }

    public function pdf()
    {
        $labpatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.laboratory.report.labreport.labpatientpdf', compact('labpatient'))->output();
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
                    ->orWhereHas('labpatientlist', fn(Builder $q) =>
                        $q->where('labinvestigation_name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $labpatient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.laboratory.report.labreport.labreportlivewire', compact('labpatient'));
    }
}
