<?php

namespace App\Http\Livewire\Admin\Reports\Patientreports\Patientvisitreport;

use App\Export\Admin\Reports\Patientreport\Patientvisitreport\PatientvisitreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Patient\Patientvisit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Patientvisitreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $patientvisit = $this->query()->get();
        return Excel::download(new PatientvisitreportExport($patientvisit), 'patientvisit.xls');
    }

    public function pdf()
    {
        $patientvisit = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.patientreports.patientvisitreport.patientvisitreportpdf', compact('patientvisit'))->output();
        return response()->streamDownload(fn() => print($pdf), "patientvisit.pdf");
    }

    protected function query()
    {
        return Patientvisit::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
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
                    ->orWhereHas('reference', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $patientvisit = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.patientreports.patientvisitreport.patientvisitreportlivewire', compact('patientvisit'));
    }

}
