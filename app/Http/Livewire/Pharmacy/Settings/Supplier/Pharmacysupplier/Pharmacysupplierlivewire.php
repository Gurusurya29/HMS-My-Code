<?php

namespace App\Http\Livewire\Pharmacy\Settings\Supplier\Pharmacysupplier;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Supplier\Supplier;
use Livewire\Component;

class Pharmacysupplierlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $showdata;
    public $searchTerm;

    protected $listeners = ['formreset'];

    protected $rules = [
        'searchTerm' => 'nullable',
    ];

    protected function databind($supplierid, $type)
    {
        if ($type == 'edit') {
            $supplier = Supplier::find($supplierid);
            $this->dispatch('supplier-edit', $supplier);
        } else {
            $this->showdata = Supplier::find($supplierid);
        }
    }

    public function formreset()
    {
        $this->resetValidation();
    }

    public function render()
    {
        $supplier = Supplier::query()
            ->where('is_pharmacy', true)
            ->where(function ($query) {
                $query->where('company_person_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('company_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('contact_mobile_no', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('contact_phone_no', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.supplier.pharmacysupplier.pharmacysupplierlivewire',
            compact('supplier'));
    }
}
