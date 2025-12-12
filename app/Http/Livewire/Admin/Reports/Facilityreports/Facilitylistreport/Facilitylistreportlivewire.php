<?php

namespace App\Http\Livewire\Admin\Reports\Facilityreports\Facilitylistreport;

use App\Export\Admin\Reports\Facilityreport\Facilitylistreport\FacilitylistreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Facility\Facility;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Facilitylistreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $facilitylist = $this->query()->get();
        return Excel::download(new FacilitylistreportExport($facilitylist), 'facilitylist.xls');
    }

    public function pdf()
    {
        $facilitylist = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.facilityreports.facilitylistreport.facilitylistreportpdf', compact('facilitylist'))->output();
        return response()->streamDownload(fn() => print($pdf), "facilitylist.pdf");
    }

    protected function query()
    {
        return Facility::where('active', true)
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('asset_custodian', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $facilitylist = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.facilityreports.facilitylistreport.facilitylistreportlivewire', compact('facilitylist'));
    }

}
