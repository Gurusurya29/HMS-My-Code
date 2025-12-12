<?php

namespace App\Http\Livewire\Pharmacy\Sales\Prescription;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Prescription\Prescription;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Prescriptionindexlivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata;

    protected function databind($id)
    {
        $this->showdata = Prescription::find($id);
    }

    public function render()
    {
        $prescription = Prescription::query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    );
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.sales.prescription.prescriptionindexlivewire',
            compact('prescription'));
    }
}
