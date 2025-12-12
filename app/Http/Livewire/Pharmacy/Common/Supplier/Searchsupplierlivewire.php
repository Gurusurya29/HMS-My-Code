<?php

namespace App\Http\Livewire\Pharmacy\Common\Supplier;

use App\Models\Admin\Settings\Supplier\Supplier;
use Livewire\Component;

class Searchsupplierlivewire extends Component
{
    public $supplier, $supplierlist = [];
    public $highlightIndex;
    public $issupplierselected = false, $supplier_id;
    protected $listeners = ['resetData'];
    public function mount($supplier_id = null)
    {
        $this->resetData();
        if ($supplier_id) {
            $this->supplier_id = $supplier_id;
            $this->supplier = Supplier::find($supplier_id)->company_name;
            $this->issupplierselected = true;
        }
    }

    public function resetData()
    {
        $this->supplier = '';
        $this->supplierlist = [];
        $this->highlightIndex = 0;
        $this->dispatch('supplierdeselected', $id = null);
    }

    public function updatedSupplier()
    {
        $this->issupplierselected = false;
        $this->supplierlist = Supplier::where(function ($supplier) {
            $supplier->where('company_person_name', 'like', '%' . $this->supplier . '%')
                ->orWhere('company_name', 'like', '%' . $this->supplier . '%')
                ->orWhere('contact_mobile_no', 'like', '%' . $this->supplier . '%')
                ->orWhere('contact_phone_no', 'like', '%' . $this->supplier . '%')
                ->orWhere('email', 'like', '%' . $this->supplier . '%');
        })
            ->where('is_pharmacy', true)
            ->get();
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->supplierlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->supplierlist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectSupplier()
    {
        $supplier = $this->supplierlist[$this->highlightIndex] ?? null;
        if ($supplier) {
            $supplierdetail = $this->supplierlist[$this->highlightIndex];
            $this->selecthissupplier($supplierdetail['id'], $supplierdetail['company_name']);
        }
    }

    public function selecthissupplier($supplier, $name)
    {
        $this->issupplierselected = true;
        $this->supplier = $name;
        $this->dispatch('supplierselected', $supplier);
    }

    public function render()
    {
        return view('livewire.pharmacy.common.supplier.searchsupplierlivewire');
    }
}
