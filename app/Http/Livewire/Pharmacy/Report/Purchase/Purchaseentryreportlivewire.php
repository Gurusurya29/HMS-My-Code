<?php

namespace App\Http\Livewire\Pharmacy\Report\Purchase;

use App\Export\Pharmacy\Report\Purchase\PurchaseentryitemExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Purchaseentryreportlivewire extends Component
{
    use reportlivewireTrait;

    public $product_id;

    protected $listeners = ['productselected'];

    public function export()
    {
        $pharmacypurchaseentryitem = $this->query()->get();
        return Excel::download(new PurchaseentryitemExport($pharmacypurchaseentryitem), 'pharmacypurchaseentryitem.xls');
    }

    public function pdf()
    {
        $pharmacypurchaseentryitem = $this->query()->get();
        $totalamt = round($this->query()->sum('total'));
        $pdf = PDF::loadView('livewire.pharmacy.report.purchase.purchaseentryitempdf', compact('pharmacypurchaseentryitem', 'totalamt'))
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
        return Pharmpurchaseentryitem::where(fn($query) => ($this->product_id) ? $query->where('pharmacyproduct_id', $this->product_id) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
    }

    public function resetPage()
    {
        $this->product_id = null;
        $this->dispatch('cleanupfields');
    }

    public function render()
    {
        $pharmacypurchaseentryitem = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $totalamt = round($this->query()->sum('total'));

        return view('livewire.pharmacy.report.purchase.purchaseentryreportlivewire', compact('pharmacypurchaseentryitem', 'totalamt'));
    }
}
