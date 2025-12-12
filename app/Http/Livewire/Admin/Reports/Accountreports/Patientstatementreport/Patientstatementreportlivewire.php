<?php

namespace App\Http\Livewire\Admin\Reports\Accountreports\Patientstatementreport;

use App\Export\Admin\Reports\Accountreport\Patientstatementreport\PatientstatementreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Patient\Auth\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Patientstatementreportlivewire extends Component
{
    use reportlivewireTrait;

    public $searchquery, $patient, $patientlist = [];

    public function updatedSearchquery()
    {
        $this->patientlist = Patient::where('active', true)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uhid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function selectedpatient(Patient $patient)
    {
        $this->patient = $patient;
        $this->searchquery = '';
    }

    public function export()
    {
        $patientstatement = $this->query()->get();
        return Excel::download(new PatientstatementreportExport($patientstatement), 'patientstatement.xls');
    }

    public function pdf()
    {
        $patientstatement = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.accountreports.patientstatementreport.patientstatementreportpdf', compact('patientstatement'))->output();
        return response()->streamDownload(fn() => print($pdf), "patientstatement.pdf");
    }

    protected function query()
    {
        return Patientstatement::where('patient_id', $this->patient->id)->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('statement_ref_id', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        if ($this->patient) {
            $patientstatement = $this->query()
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationlength)
                ->onEachSide(1);
            $balance_statement = $this->query()->get();
            $balance = $balance_statement->sum('debit') - $balance_statement->sum('credit');
        } else {
            $patientstatement = null;
            $balance_statement = [];
            $balance = '';
        }

        return view('livewire.admin.reports.accountreports.patientstatementreport.patientstatementreportlivewire', compact('patientstatement', 'balance', 'balance_statement'));
    }
}
