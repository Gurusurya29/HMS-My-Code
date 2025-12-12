<?php

namespace App\Http\Livewire\Pharmacy\Report\Purchase;

use App\Export\Pharmacy\Report\Purchase\PurchaseentryExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Purchasereportindexlivewire extends Component
{
    use reportlivewireTrait;

    public $supplier_id;

    protected $listeners = ['supplierselected'];

    public function export()
    {
        $pharmacypurchaseentry = $this->query()->get();
        return Excel::download(new PurchaseentryExport($pharmacypurchaseentry), 'pharmacypurchaseentry.xls');
    }

    public function supplierselected($supplier_id)
    {
        $this->supplier_id = $supplier_id;
    }

    public function pdf()
    {
        $pharmacypurchaseentry = $this->query()->get();
        $totalamt = $this->query()->sum('grand_total');

        $pdf = PDF::loadView('livewire.pharmacy.report.purchase.purchaserepdf', compact('pharmacypurchaseentry','totalamt'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "pharmacypurchaseentry.pdf");
    }

    protected function query()
    {
        return Pharmpurchaseentry::where(fn($query) => ($this->supplier_id) ? $query->where('supplier_id', $this->supplier_id) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
    }

    public function resetPage()
    {
        $this->dispatch('resetData');
        $this->supplier_id = null;
    }

    public function render()
    {
        $pharmacypurchaseentry = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $totalamt = $this->query()->sum('grand_total');

        return view('livewire.pharmacy.report.purchase.purchasereportindexlivewire', compact('pharmacypurchaseentry','totalamt'));
    }
}
