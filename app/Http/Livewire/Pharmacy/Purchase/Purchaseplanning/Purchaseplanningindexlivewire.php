<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseplanning;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Pharmacy\Purchase\Purchaseplanning\Pharmpurchaseplan;
use Livewire\Component;

class Purchaseplanningindexlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    protected $listeners = ['refreshthisparent' => '$refresh'];
    public $showdata, $search;

    protected function rules()
    {
        return [
            'search' => 'required',
        ];
    }

    protected function databind($pp, $type)
    {
        $this->showdata = Pharmpurchaseplan::find($pp);
    }

    public function render()
    {
        $pharmplanning = Pharmpurchaseplan::query()
            ->where(function ($query) {
                $query->where('supplier_companyname', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('supplier_mobile_no', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('supplier_contact_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('planning_date', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.purchase.purchaseplanning.purchaseplanningindexlivewire',
            compact('pharmplanning'));
    }
}
