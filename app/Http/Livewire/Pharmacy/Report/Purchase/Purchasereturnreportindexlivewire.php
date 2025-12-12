<?php

namespace App\Http\Livewire\Pharmacy\Report\Purchase;

use App\Export\Pharmacy\Report\Purchase\PurchaseentryreturnitemExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Purchase\Purchasereturn\Purchasereturnitem;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Purchasereturnreportindexlivewire extends Component
{
    use reportlivewireTrait;

    public $product_id;

    protected $listeners = ['productselected'];

    public function export()
    {
        $pharmacypurchasereturnitem = $this->query()->get();
        return Excel::download(new PurchaseentryreturnitemExport($pharmacypurchasereturnitem), 'pharmacypurchasereturnitem.xls');
    }

    public function pdf()
    {
        $pharmacypurchasereturnitem = $this->query()->get();
        $pdf = PDF::loadView('livewire.pharmacy.report.purchase.purchasereturnreport', compact('pharmacypurchasereturnitem'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "purchaseentryitempdf.pdf");
    }

    public function productselected($id)
    {
        $this->product_id = $id;
    }

    protected function query()
    {
        return Purchasereturnitem::where(fn($query) => ($this->product_id) ? $query->where('pharmacyproduct_id', $this->product_id) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function resetPage()
    {
        $this->product_id = null;
        $this->dispatch('cleanupfields');
    }

    public function render()
    {
        $pharmacypurchasereturnitem = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.report.purchase.purchasereturnreportindexlivewire', compact('pharmacypurchasereturnitem'));
    }
}
