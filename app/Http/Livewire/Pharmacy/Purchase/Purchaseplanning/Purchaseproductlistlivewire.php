<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseplanning;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmreqproduct;
use Livewire\Component;

class Purchaseproductlistlivewire extends Component
{
    use datatableLivewireTrait;

    public $type;

    protected $listeners = [
        'requested_product_created' => '$refresh',
    ];

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        if ($this->type == 'outofstock') {
            $products = Pharmacyproduct::query()
                ->where('stock', 0)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationlength, ['*'], $this->type)
                ->onEachSide(1);
        } else if ($this->type == 'aboutto') {
            $products = Pharmacyproduct::query()
                ->where('stock_required', true)
                ->whereRaw('min_stock >= stock')
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationlength, ['*'], $this->type)
                ->onEachSide(1);
        } else if ($this->type == 'required') {
            $products = Pharmreqproduct::query()
                ->where('active', true)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchTerm . '%');
                })
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationlength, ['*'], $this->type)
                ->onEachSide(1);
        }

        return view('livewire.pharmacy.purchase.purchaseplanning.purchaseproductlistlivewire', compact('products'));
    }
}
