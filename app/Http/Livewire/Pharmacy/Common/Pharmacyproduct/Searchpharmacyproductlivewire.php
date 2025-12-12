<?php

namespace App\Http\Livewire\Pharmacy\Common\Pharmacyproduct;

use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Supplier\Supplierpharmacyproduct;
use Livewire\Component;

class Searchpharmacyproductlivewire extends Component
{
    public $product, $pharmacyproductlist, $highlightIndex, $isrproductselected = false;
    public $supplier_id, $supplierproduct_ids = [], $supplier_dependent, $required;
    public $ignoreids = [];

    protected $listeners = [
        'cleanupfields' => 'resetData',
        'supplierselected',
        'updateignoreids' => 'updateignoreids',
    ];

    public function mount($supplier_dependent = null, $supplier_id = null, $required = true, $ignoreids = [])
    {
        $this->resetData();
        $supplier_dependent ? $this->supplier_dependent = $supplier_dependent : '';
        $supplier_id ? $this->supplierselected($supplier_id) : '';
        $this->required = !$required ? false : true;
        if (sizeof($ignoreids) > 0) {
            $this->ignoreids = $ignoreids;
        }
    }

    public function resetData()
    {
        $this->product = '';
        $this->pharmacyproductlist = [];
        $this->highlightIndex = 0;
        $this->dispatch('productdeselected', $id = null);
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->pharmacyproductlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->pharmacyproductlist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function updatedProduct()
    {
        $this->isrproductselected = false;
        if ($this->product) {
            $this->pharmacyproductlist = Pharmacyproduct::where(fn($query) => sizeof($this->ignoreids) > 0 ? $query->whereNotIn('id', $this->ignoreids) : '')
                ->where(function ($product) {
                    $product->where('name', 'like', '%' . $this->product . '%');
                })->orWhereHas('pharmacycategoryname', function ($productcategory) {
                $productcategory->where('name', 'like', '%' . $this->product . '%');
            })
                ->where(fn($query) => ($this->supplier_dependent) ? $query->whereIn('id', $this->supplierproduct_ids) : '')
                ->get();
        } else {
            $this->resetData();
        }
    }

    public function updateignoreids($ignoreids)
    {
        $this->ignoreids = $ignoreids;
    }

    public function selectProduct()
    {
        $product = $this->pharmacyproductlist[$this->highlightIndex] ?? null;
        if ($product) {
            $higlightproduct = $this->pharmacyproductlist[$this->highlightIndex];
            $this->selecthisproduct($higlightproduct->id, $higlightproduct->name);
        }
    }

    public function supplierselected($supplier)
    {
        $this->supplier_id = $supplier;
        $this->supplier_dependent = true;
        $this->supplierproduct_ids = Supplierpharmacyproduct::where('supplier_id', $supplier)
            ->pluck('pharmacyproduct_id');
    }

    public function selecthisproduct($id, $name)
    {
        $this->isrproductselected = true;
        $this->product = $name;
        $this->dispach('productselected', $id);
    }

    public function render()
    {
        return view('livewire.pharmacy.common.pharmacyproduct.searchpharmacyproductlivewire');
    }
}
