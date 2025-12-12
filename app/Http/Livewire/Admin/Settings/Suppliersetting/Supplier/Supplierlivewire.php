<?php

namespace App\Http\Livewire\Admin\Settings\Suppliersetting\Supplier;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Supplier\Supplier;
use Livewire\Component;

class Supplierlivewire extends Component
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
            ->where(function ($query) {
                $query->where('company_person_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('company_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('contact_mobile_no', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('contact_phone_no', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.suppliersetting.supplier.supplierlivewire',
            compact('supplier'));
    }
}
