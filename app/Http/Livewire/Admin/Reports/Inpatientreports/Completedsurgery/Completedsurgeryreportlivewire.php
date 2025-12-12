<?php

namespace App\Http\Livewire\Admin\Reports\Inpatientreports\Completedsurgery;

use App\Export\Admin\Reports\Inpatientreport\Completedsurgeryreport\CompletedsurgeryreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Completedsurgeryreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $otschedulelist = $this->query()->get();
        return Excel::download(new CompletedsurgeryreportExport($otschedulelist), 'otschedulelist.xls');
    }

    public function pdf()
    {
        $otschedulelist = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.inpatientreports.completedsurgery.completedsurgeryreportpdf', compact('otschedulelist'))->output();
        return response()->streamDownload(fn() => print($pdf), "otschedulelist.pdf");
    }

    protected function query()
    {
        return Otschedule::with('patient')
            ->where('is_otactive', true)
            ->whereNotNull('is_movetoip')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($query) =>
                $query->where('surgery_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $otschedulelist = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.inpatientreports.completedsurgery.completedsurgeryreportlivewire', compact('otschedulelist'));
    }
}
