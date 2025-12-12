<?php

namespace App\Http\Livewire\Admin\Reports\Outpatientreports\Doctorwiseopvisit;

use App\Export\Admin\Reports\Outpatientreport\Doctorwiseopvisitreport\DoctorwiseopvisitreportExport;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Doctorwiseopvisitreportlivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $from_date, $to_date;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $paginationlength = 10;
    public $doctor_data = [], $doctorspecialization_data = [];
    public $doctor_id, $doctorspecialization_id;

    public function mount()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
        $this->doctor_data = Doctor::where('active', true)->pluck('name', 'id');
        $this->doctorspecialization_data = Doctorspecialization::where('active', true)->pluck('name', 'id');
    }

    public function updatepagination()
    {
        $this->resetPage();
    }
    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function clear()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
        $this->doctor_id = '';
        $this->doctorspecialization_id = '';
        $this->resetPage();
    }

    public function export()
    {
        $patientvisit = $this->query()->get();
        return Excel::download(new DoctorwiseopvisitreportExport($patientvisit), 'patientvisit.xls');
    }

    public function pdf()
    {
        $patientvisit = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.outpatientreports.doctorwiseopvisit.doctorwiseopvisitreportpdf', compact('patientvisit'))->output();
        return response()->streamDownload(fn() => print($pdf), "patientvisit.pdf");
    }

    protected function query()
    {
        $doctor_id = $this->doctor_id;
        $doctorspecialization_id = $this->doctorspecialization_id;
        return Patientvisit::where('visit_category_id', 1)
            ->when($doctor_id, function ($query, $doctor_id) {
                $query->where('doctor_id', $doctor_id);
            })
            ->when($doctorspecialization_id, function ($query, $doctorspecialization_id) {
                $query->where('doctorspecialization_id', $doctorspecialization_id);
            })
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $patientvisit = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $doctorname = $this->doctor_id ? Doctor::find($this->doctor_id)->name : 'None';
        $specializationname = $this->doctorspecialization_id ? Doctorspecialization::find($this->doctorspecialization_id)->name : 'None';

        return view('livewire.admin.reports.outpatientreports.doctorwiseopvisit.doctorwiseopvisitreportlivewire', compact('patientvisit', 'doctorname', 'specializationname'));
    }
}
