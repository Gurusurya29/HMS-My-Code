<?php

namespace App\Http\Livewire\Pharmacy\Report\Sales;

use App\Export\Pharmacy\Report\Sales\PharmsalesentryitemExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Salesitemreportindexlivewire extends Component
{
    use reportlivewireTrait;

    public $product_id, $customer_id;
    protected $listeners = ['productselected', 'productdeselected', 'patientselected'];

    public function export()
    {
        $sales = $this->query()->get();
        return Excel::download(new PharmsalesentryitemExport($sales), 'salesentryitem.xls');
    }

    public function pdf()
    {
        $sales = $this->query()->get();
        $total_sale = $this->query()->sum('total');
        $pdf = PDF::loadView('livewire.pharmacy.report.sales.salesitempdf', compact('sales','total_sale'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "salesentryitem.pdf");
    }

    public function productselected($id)
    {
        $this->product_id = $id;
    }

    public function productdeselected()
    {
        $this->product_id = null;
    }

    public function patientselected($id)
    {
        $this->customer_id = $id;
    }

    protected function query()
    {
        return Pharmsalesentryitem::where(fn($query) => ($this->product_id) ? $query->where('pharmacyproduct_id', $this->product_id) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->whereHas('pharmsalesentry', fn(Builder $q) =>
                $q->where(fn($query) => ($this->customer_id) ?
                    $query->where('patient_id', $this->customer_id)
                    : '')
            );
    }

    public function resetPage()
    {
        $this->dispatch('resetData');
        $this->dispatch('cleanupfields');
        $this->product_id = null;
        $this->customer_id = null;
    }

    public function render()
    {
        $saleentry = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $total_sale = $this->query()->sum('total');

        return view('livewire.pharmacy.report.sales.salesitemreportindexlivewire', compact('saleentry', 'total_sale'));
    }
}
