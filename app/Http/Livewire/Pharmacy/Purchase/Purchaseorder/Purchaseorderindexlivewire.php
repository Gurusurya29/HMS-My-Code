<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseorder;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
use Livewire\Component;

class Purchaseorderindexlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    protected $listeners = ['po_statusupdated' => '$refresh'];
    public $showdata, $search;

    protected function rules()
    {
        return [
            'search' => 'required',
        ];
    }

    protected function databind($po, $type)
    {
        $this->showdata = Pharmpurchaseorder::find($po);
    }

    public function printpurchaseorder(Pharmpurchaseorder $purchaseorder)
    {
        $this->dispatch('printpurchaseorder', $purchaseorder->id);
    }

    public function render()
    {
        $pharmorder = Pharmpurchaseorder::query()
            ->where(function ($query) {
                $query->where('supplier_companyname', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('supplier_mobile_no', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('supplier_contact_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('planning_date', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.purchase.purchaseorder.purchaseorderindexlivewire',
            compact('pharmorder'));
    }
}
