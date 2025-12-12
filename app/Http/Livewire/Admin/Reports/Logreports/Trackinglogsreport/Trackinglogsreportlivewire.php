<?php

namespace App\Http\Livewire\Admin\Reports\Logreports\Trackinglogsreport;

use App\Export\Admin\Reports\Logreport\Trackinglogsreport\TrackinglogsreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Settings\Tracking\Tracking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Trackinglogsreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $trackinglogs = $this->query()->get();
        return Excel::download(new TrackinglogsreportExport($trackinglogs), 'trackinglogs.xls');
    }

    public function pdf()
    {
        $trackinglogs = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.logreports.trackinglogsreport.trackinglogsreportpdf', compact('trackinglogs'))->output();
        return response()->streamDownload(fn() => print($pdf), "trackinglogs.pdf");
    }

    protected function query()
    {
        return Tracking::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('trackmsg', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('trackable', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('usertype', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $trackinglogs = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.logreports.trackinglogsreport.trackinglogsreportlivewire', compact('trackinglogs'));
    }

}
