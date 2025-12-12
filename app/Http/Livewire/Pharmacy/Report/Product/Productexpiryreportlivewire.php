<?php

namespace App\Http\Livewire\Pharmacy\Report\Product;

use App\Export\Pharmacy\Report\Product\PharmproductexpiryExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Productexpiryreportlivewire extends Component
{
    use reportlivewireTrait;

    public $product_id;
    protected $listeners = ['productselected', 'productdeselected', 'patientselected'];

    public function export()
    {
        $productexpiry = $this->query()->get();
        return Excel::download(new PharmproductexpiryExport($productexpiry), 'productexpiry.xls');
    }

    public function pdf()
    {
        $productexpiry = $this->query()->get();
        $pdf = PDF::loadView('livewire.pharmacy.report.product.productexpirypdf', compact('productexpiry'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "productexpiry.pdf");
    }

    public function productselected($id)
    {
        $this->product_id = $id;
    }

    public function productdeselected()
    {
        $this->product_id = null;
    }

    protected function query()
    {
        return Pharmpurchaseentryitem::where(fn($query) => ($this->product_id) ? $query->where('pharmacyproduct_id', $this->product_id) : '')
            ->whereBetween('expiry_date', [$this->from_date, $this->to_date])
            ->orderBy($this->sortColumnName, $this->sortDirection);
    }

    public function resetPage()
    {
        $this->dispatch('cleanupfields');
        $this->product_id = null;
    }

    public function render()
    {
        $productexpiry = $this->query()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.report.product.productexpiryreportlivewire', compact('productexpiry'));
    }
}
