<?php

namespace App\Http\Livewire\Admin\Reports\Billingreports\Ipbillingreport;

use App\Export\Admin\Reports\Billingreport\Ipbillingreport\IpbillingreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Ipbillingreportlivewire extends Component
{

    use reportlivewireTrait;

    public function export()
    {
        $ipbilling = $this->query()->get();
        return Excel::download(new IpbillingreportExport($ipbilling), 'ipbilling.xls');
    }

    public function pdf()
    {
        $ipbilling = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.billingreports.ipbillingreport.ipbillingreportpdf', compact('ipbilling'))->output();
        return response()->streamDownload(fn() => print($pdf), "ipbilling.pdf");
    }

    protected function query()
    {
        return Ipbilling::whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function render()
    {
        $ipbilling = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $grand_total = $this->query()->sum('grand_total');

        return view('livewire.admin.reports.billingreports.ipbillingreport.ipbillingreportlivewire', compact('ipbilling', 'grand_total'));
    }

}
