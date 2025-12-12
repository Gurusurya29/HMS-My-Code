<?php

namespace App\Http\Livewire\Laboratory\Report\Xrayreport;

use App\Export\Inverstigation\Xray\XraypatientExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Laboratory\Xray\Xraypatient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Xrayreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $xraypatient = $this->query()->get();
        return Excel::download(new XraypatientExport($xraypatient), 'xraypatient.xls');
    }

    public function pdf()
    {
        $xraypatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.laboratory.report.xrayreport.xraypatientpdf', compact('xraypatient'))->output();
        return response()->streamDownload(fn() => print($pdf), "xraypatient.pdf");
    }

    protected function query()
    {
        return Xraypatient::where('is_billgenerated', true)
            ->with('xraypatientlist', fn(Builder $q) =>
                $q->whereNotNull('is_movedtobill')
            )
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('xraypatientlist', fn(Builder $q) =>
                        $q->where('xrayinvestigation_name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $xraypatient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.laboratory.report.xrayreport.xrayreportlivewire', compact('xraypatient'));
    }
}
