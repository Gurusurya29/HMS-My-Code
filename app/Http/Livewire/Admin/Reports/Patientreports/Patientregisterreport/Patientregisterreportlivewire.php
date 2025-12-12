<?php

namespace App\Http\Livewire\Admin\Reports\Patientreports\Patientregisterreport;

use App\Export\Admin\Reports\Patientreport\Patientregisterreport\PatientregisterreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Patient\Auth\Patient;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class Patientregisterreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $patient = $this->query()->get();
        return Excel::download(new PatientregisterreportExport($patient), 'patient.xls');
    }

    public function pdf()
    {
        $patient = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.patientreports.patientregisterreport.patientregisterreportpdf', compact('patient'))->output();
        return response()->streamDownload(fn() => print($pdf), "patient.pdf");
    }

    protected function query()
    {
        return Patient::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('uhid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $patient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.patientreports.patientregisterreport.patientregisterreportlivewire', compact('patient'));
    }

}
