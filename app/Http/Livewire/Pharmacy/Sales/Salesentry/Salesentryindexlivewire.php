<?php

namespace App\Http\Livewire\Pharmacy\Sales\Salesentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Salesentryindexlivewire extends Component
{
    use datatableLivewireTrait;
    public $showdata;

    protected function databind($se_id, $type)
    {
        $this->showdata = Pharmsalesentry::find($se_id);
    }

    public function printsalesentry(Pharmsalesentry $salesentry)
    {
        $this->dispatch('printsalesentry', $salesentry->id);
    }

    public function render()
    {
        $salesentry = Pharmsalesentry::query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%');
            })->orWhereHas('patient', fn(Builder $q) =>
            $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
        )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.sales.salesentry.salesentryindexlivewire',
            compact('salesentry'));
    }
}
