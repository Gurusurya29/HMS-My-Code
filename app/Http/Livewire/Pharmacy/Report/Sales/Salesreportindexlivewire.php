<?php

namespace App\Http\Livewire\Pharmacy\Report\Sales;

use App\Export\Pharmacy\Report\Sales\PharmsalesentryExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Salesreportindexlivewire extends Component
{
    use reportlivewireTrait;
    public $customer_id;
    protected $listeners = ['patientselected'];

    public function export()
    {
        $sales = $this->query()->get();
        return Excel::download(new PharmsalesentryExport($sales), 'sales.xls');
    }

    public function patientselected($id)
    {
        $this->customer_id = $id;
    }

    public function pdf()
    {
        $sales = $this->query()->get();
        $totalsales = $this->query()->sum('grand_total');
        $pdf = PDF::loadView('livewire.pharmacy.report.sales.salespdf', compact('sales', 'totalsales'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "sales.pdf");
    }

    protected function query()
    {
        return Pharmsalesentry::where(fn($query) => ($this->customer_id) ? $query->where('patient_id', $this->customer_id) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
    }

    public function resetPage()
    {
        $this->dispatch('resetData');
        $this->customer_id = null;
    }

    public function render()
    {
        $sales = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $totalsales = $this->query()->sum('grand_total');

        return view('livewire.pharmacy.report.sales.salesreportindexlivewire', compact('sales', 'totalsales'));
    }
}
