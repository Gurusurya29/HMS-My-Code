<?php

namespace App\Http\Livewire\Admin\Reports\Inpatientreports\Dischargedpatientreport;

use App\Export\Admin\Reports\Inpatientreport\Dischargedpatientreport\DischargedpatientreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Dischargedpatientreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $dischargedpatient = $this->query()->get();
        return Excel::download(new DischargedpatientreportExport($dischargedpatient), 'dischargedpatient.xls');
    }

    public function pdf()
    {
        $dischargedpatient = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.inpatientreports.dischargedpatientreport.dischargedpatientreportpdf', compact('dischargedpatient'))->output();
        return response()->streamDownload(fn() => print($pdf), "dischargedpatient.pdf");
    }

    protected function query()
    {
        return Inpatient::where(fn($q) =>
            $q->whereHasMorph('dsspecialable', '*', fn(Builder $query) =>
                $query->where('is_patientdischarged', true)
                    ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
                    ->whereHas('patient', fn(Builder $q) =>
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
            )
        )->whereNotNull('is_patientdischarged')
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $dischargedpatient = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.inpatientreports.dischargedpatientreport.dischargedpatientreportlivewire', compact('dischargedpatient'));
    }
}
