<?php

namespace App\Http\Livewire\Pharmacy\Common\Pharmacyproductbatch;

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use Carbon\Carbon;
use Livewire\Component;

class Searchpharmacyproductbatchlivewire extends Component
{
    public $highlightIndex = 0, $batch, $batchlist = [],
    $isbatchselected = false, $product_id = null, $type, $supplier_id,
    $supplier_dependent = null;

    protected $listeners = [
        'productselected',
        'productdeselected' => 'productselected',
        'cleanupfields' => 'resetData',
        'supplierselected',
    ];

    public function mount($type = null, $supplier_dependent = null)
    {
        $type ? $this->type = $type : '';
        $supplier_dependent ? $this->supplier_dependent = $supplier_dependent : '';
    }

    public function supplierselected($supplier)
    {
        $this->supplier_id = $supplier;
    }

    protected function rules()
    {
        return [
            'batch' => 'required',
        ];
    }

    public function productselected($product_id)
    {
        if ($product_id) {
            $this->product_id = $product_id;
            $this->isbatchselected = false;
            $this->batchlist = Pharmpurchaseentryitem::where('pharmacyproduct_id', $this->product_id)
                ->where('quantity', '!=', 0)
                ->where(fn($query) => ($this->supplier_dependent) ? $query->where('supplier_id', $this->supplier_id) : '')
                ->where(fn($query) => ($this->type == "sales") ? $query->where('expiry_date', '>', Carbon::now()) : '')
                ->latest()
                ->get();
            if (count($this->batchlist) > 0) {
                $this->batch = $this->batchlist[0]->batch . '       Q-' . $this->batchlist[0]->quantity . '       ' . Carbon::parse($this->batchlist[0]->expiry_date)->format('d-m-Y');
            }
        } else {
            $this->batch = null;
            $this->product_id = null;
        }
    }

    public function resetData()
    {
        $this->batch = '';
        $this->highlightIndex = 0;
        $this->dispatch('batchdeselected', $id = null);
        $this->isbatchselected = true;
        $this->batchlist = Pharmpurchaseentryitem::where('pharmacyproduct_id', $this->product_id)
            ->where('quantity', '!=', 0)
            ->where(fn($query) => ($this->supplier_dependent) ? $query->where('supplier_id', $this->supplier_id) : '')
            ->where(fn($query) => ($this->type == "sales") ? $query->where('expiry_date', '>', Carbon::now()) : '')
            ->latest()
            ->get();
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->batchlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function updatedBatch()
    {
        $this->isbatchselected = false;
        if ($this->batch) {
            $this->batchlist = Pharmpurchaseentryitem::where('pharmacyproduct_id', $this->product_id)
                ->where('quantity', '!=', 0)
                ->where(function ($batch) {
                    $batch->where('batch', 'like', '%' . $this->batch . '%');
                })
                ->where(fn($query) => ($this->type == "sales") ? $query->where('expiry_date', '>', Carbon::now()) : '')
                ->latest()
                ->get();
        } else {
            $this->resetData();
        }
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->batchlist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectBatch()
    {
        $batch = $this->batchlist[$this->highlightIndex] ?? null;
        if ($batch) {
            $batchdetail = $this->batchlist[$this->highlightIndex];
            $this->selecthisbatch($batchdetail->id, $batchdetail->batch, $batchdetail->quantity, $batchdetail->expiry_date);
        }
    }

    public function selecthisbatch($id, $name, $q, $date)
    {
        $this->isbatchselected = true;
        $this->batch = $name . '       Q-' . $q . '       ' . Carbon::parse($date)->format('d-m-Y');
        $this->dispatch('batchselected', $id);
    }

    public function render()
    {
        return view('livewire.pharmacy.common.pharmacyproductbatch.searchpharmacyproductbatchlivewire');
    }
}
