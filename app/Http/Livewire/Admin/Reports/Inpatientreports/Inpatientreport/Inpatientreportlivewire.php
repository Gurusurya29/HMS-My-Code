<?php

namespace App\Http\Livewire\Admin\Reports\Inpatientreports\Inpatientreport;

use App\Export\Admin\Reports\Inpatientreport\Inpatientreport\InpatientreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Inpatientreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $inpatient = $this->query()->get();
        return Excel::download(new InpatientreportExport($inpatient), 'inpatient.xls');
    }

    public function pdf()
    {
        $inpatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.inpatientreports.inpatientreport.inpatientreportpdf', compact('inpatient'))->output();
        return response()->streamDownload(fn() => print($pdf), "inpatient.pdf");
    }

    protected function query()
    {
        return Inpatient::has('ipadmission')->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->whereHas('patient', fn(Builder $q) =>
                    $q->where('name', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                )
                    ->orWhereHas('ipadmission', fn(Builder $q) =>
                        $q->where('attender_name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('attender_phone', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('ipadmission.wardtype', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('ipadmission.bedorroomnumber', fn(Builder $q) =>
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
        $inpatient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.inpatientreports.inpatientreport.inpatientreportlivewire', compact('inpatient'));
    }
}
