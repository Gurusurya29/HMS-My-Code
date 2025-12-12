<?php

namespace App\Http\Livewire\Admin\Reports\Outpatientreports\Doctorwiseopbill;

use App\Export\Admin\Reports\Outpatientreport\Doctorwiseopbillreport\DoctorwiseopbillreportExport;
use App\Models\Admin\Outpatient\Outpatient;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Doctorwiseopbillreportlivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $from_date, $to_date;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $paginationlength = 10;
    public $searchTerm = null;

    public function mount()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
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
        $doctorlist = $this->query()->get();
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        return Excel::download(new DoctorwiseopbillreportExport($doctorlist, $from_date, $to_date), 'doctorlist.xls');
    }

    public function pdf()
    {
        $doctorlist = $this->query()->get();
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        $pdf = PDF::loadView('livewire.admin.reports.outpatientreports.doctorwiseopbill.doctorwiseopbillreportpdf', compact('doctorlist', 'from_date', 'to_date'))->output();
        return response()->streamDownload(fn() => print($pdf), "doctorlist.pdf");
    }

    protected function query()
    {
        return Doctor::withCount([
            'patientvisit',
            'patientvisit as visit_count' => fn(Builder $query) => $query->whereBetween('created_at', [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59'])->where('visitable_type', Outpatient::class),
        ])
            ->where('active', true)
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $doctorlist = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.outpatientreports.doctorwiseopbill.doctorwiseopbillreportlivewire', compact('doctorlist'));
    }
}
