<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchasereturn;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Pharmacy\Purchase\Purchasereturn\Pharmpurchasereturn;
use Livewire\Component;

class Purchasereturnindexlivewire extends Component
{
    use datatableLivewireTrait;
    public $showdata;

    protected function databind($pharmpurchasereturn_id, $type)
    {
        $this->showdata = Pharmpurchasereturn::find($pharmpurchasereturn_id);
    }
    public function printpurchasereturn(Pharmpurchasereturn $purchasereturn)
    {
        $this->dispatch('printpurchasereturn', $purchasereturn->id);
    }
    public function render()
    {
        $purchasereturn = Pharmpurchasereturn::query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.purchase.purchasereturn.purchasereturnindexlivewire',
            compact('purchasereturn'));
    }
}
