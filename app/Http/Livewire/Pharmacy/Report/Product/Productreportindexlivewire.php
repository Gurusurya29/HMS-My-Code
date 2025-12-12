<?php

namespace App\Http\Livewire\Pharmacy\Report\Product;

use App\Export\Pharmacy\Report\Product\ProductExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmproductinventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class Productreportindexlivewire extends Component
{
    use reportlivewireTrait;

    public $options = 'fastmoving', $searchTerm;

    protected $listeners = ['productselected'];

    public function export()
    {
        $pharmacyproduct = $this->query()->get();
        return Excel::download(new ProductExport($pharmacyproduct), 'pharmacyproduct.xls');
    }

    public function pdf()
    {
        $pharmacyproduct = $this->query()->get();
        $pdf = PDF::loadView('livewire.pharmacy.report.product.salespdf', compact('pharmacyproduct'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "productreport.pdf");
    }

    protected function query()
    {
        return Pharmacyproduct::orderBy($this->sortColumnName, $this->sortDirection)
            ->addSelect(['totalsales' => Pharmproductinventory::selectRaw('sum(quantity) as totalsales')
                    ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
                    ->whereNotNull('pharmsalesentryitem_id')
                    ->whereColumn('pharmacyproduct_id', 'pharmacyproducts.id')
                    ->groupBy('pharmacyproduct_id'),
            ])
            ->addSelect(['returncount' => Pharmproductinventory::selectRaw('sum(quantity) as returncount')
                    ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
                    ->whereNotNull('purchasereturnitem_id')
                    ->whereColumn('pharmacyproduct_id', 'pharmacyproducts.id')
                    ->groupBy('pharmacyproduct_id'),
            ])
            ->addSelect(['salesreturncount' => Pharmproductinventory::selectRaw('sum(quantity) as salesreturncount')
                    ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
                    ->whereNotNull('pharmsalesreturnitem_id')
                    ->whereColumn('pharmacyproduct_id', 'pharmacyproducts.id')
                    ->groupBy('pharmacyproduct_id'),
            ]);
    }

    public function updatedOptions()
    {
        $this->sortColumnName = 'totalsales';
        $this->sortDirection = $this->options == 'slowmoving' ? 'ASC' : 'DESC';
    }

    public function resetPage()
    {
        $this->options = 'fastmoving';
    }

    public function render()
    {
        $pharmacyproduct = $this->query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('hsn', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('product_sku', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('pharmacycategoryname', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    );
            })
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.report.product.productreportindexlivewire', compact('pharmacyproduct'));
    }
}
