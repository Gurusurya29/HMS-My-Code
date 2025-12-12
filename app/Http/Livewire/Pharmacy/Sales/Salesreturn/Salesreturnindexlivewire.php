<?php

namespace App\Http\Livewire\Pharmacy\Sales\Salesreturn;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturn;
use Livewire\Component;

class Salesreturnindexlivewire extends Component
{
    use datatableLivewireTrait;
    public $showdata;

    protected function databind($sr_id, $type)
    {
        $this->showdata = Pharmsalesreturn::find($sr_id);
    }

    public function printsalesreturn(Pharmsalesreturn $salereturn)
    {
        $this->dispatch('printsalesreturn', $salereturn->id);
    }

    public function render()
    {
        $salesreturn = Pharmsalesreturn::query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.sales.salesreturn.salesreturnindexlivewire',
            compact('salesreturn'));
    }
}
