<?php

namespace App\Http\Livewire\Admin\Reports\Outpatientreports\Outpatientreport;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\Outpatient\Outpatient;
use Illuminate\Contracts\Database\Query\Builder;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Export\Admin\Reports\Outpatientreport\Outpatientreport\OutpatientreportExport;

class Outpatientreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $outpatient = $this->query()->get();
        return Excel::download(new OutpatientreportExport($outpatient), 'outpatient.xls');
    }

    public function pdf()
    {
        $outpatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.outpatientreports.outpatientreport.outpatientreportpdf', compact('outpatient'))->output();
        return response()->streamDownload(fn() => print($pdf), "outpatient.pdf");
    }

    protected function query()
    {
        return Outpatient::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctorspecialization', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('patientvisit.reference', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $outpatient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.outpatientreports.outpatientreport.outpatientreportlivewire', compact('outpatient'));
    }
}
