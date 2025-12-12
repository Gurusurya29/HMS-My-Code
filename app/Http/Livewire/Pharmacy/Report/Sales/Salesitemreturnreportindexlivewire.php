<?php

namespace App\Http\Livewire\Pharmacy\Report\Sales;

use App\Export\Pharmacy\Report\Sales\PharmsalesreturnitemExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturnitem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Salesitemreturnreportindexlivewire extends Component
{
    use reportlivewireTrait;

    public $product_id, $customer_id;
    protected $listeners = ['productselected', 'productdeselected', 'patientselected'];

    public function export()
    {
        $sales = $this->query()->get();
        return Excel::download(new PharmsalesreturnitemExport($sales), 'salesreturnitem.xls');
    }

    public function pdf()
    {
        $sales = $this->query()->get();
        $pdf = PDF::loadView('livewire.pharmacy.report.sales.salesreturnitempdf', compact('sales'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "salesreturnitem.pdf");
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
        return Pharmsalesreturnitem::where(fn($query) => ($this->product_id) ? $query->where('pharmacyproduct_id', $this->product_id) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->whereHas('pharmsalesreturn', fn(Builder $q) =>
                $q->whereHas('patient', fn(Builder $q) =>
                    $q->where(fn($query) => ($this->customer_id) ?
                        $query->where('patient_id', $this->customer_id)
                        : '')
                )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function resetPage()
    {
        $this->dispatch('resetData');
        $this->dispatch('cleanupfields');
        $this->product_id = $this->customer_id = null;
    }

    public function render()
    {
        $salesreturn = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.report.sales.salesitemreturnreportindexlivewire', compact('salesreturn'));
    }
}
