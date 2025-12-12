<?php

namespace App\Http\Livewire\Admin\Reports\Logreports\Loginlogsreport;

use App\Export\Admin\Reports\Logreport\Loginlogsreport\LoginlogsreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Settings\Tracking\Logininfo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Loginlogsreportlivewire extends Component
{
    use reportlivewireTrait;

    public function export()
    {
        $loginlogs = $this->query()->get();
        return Excel::download(new LoginlogsreportExport($loginlogs), 'loginlogs.xls');
    }

    public function pdf()
    {
        $loginlogs = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.logreports.loginlogsreport.loginlogsreportpdf', compact('loginlogs'))->output();
        return response()->streamDownload(fn() => print($pdf), "loginlogs.pdf");
    }

    protected function query()
    {
        return Logininfo::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('device', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('browser', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('platform', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('type', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('logininfoable', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('usertype', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $loginlogs = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.reports.logreports.loginlogsreport.loginlogsreportlivewire', compact('loginlogs'));
    }

}
