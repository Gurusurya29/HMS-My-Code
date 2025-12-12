<?php

namespace App\Http\Livewire\Pharmacy\Expense\Expenseentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Pharmacy\Expense\Pharmacyexpenseentry;
use Livewire\Component;

class Expenseentryindexlivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata = false;

    protected function databind($pharmacyexpenseentry_id, $type)
    {
        $this->showdata = Pharmacyexpenseentry::find($pharmacyexpenseentry_id);
    }

    public function printotreceiptlist(Pharmacyexpenseentry $expenseentry)
    {
        $this->dispatch('printotreceiptlist', $expenseentry->id);
    }

    public function render()
    {
        $pharmacyexpenseentry = Pharmacyexpenseentry::query()
            ->where(function ($query) {
                $query->where('party_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('expense_value', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('mobile_number', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.expense.expenseentry.expenseentryindexlivewire', compact('pharmacyexpenseentry'));
    }
}
