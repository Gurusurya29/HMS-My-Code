<?php

namespace App\Http\Livewire\Admin\Insurance\Patientinsurance\Patientinsurancehistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Insurance\Patientinsurance;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Patientinsurancehistorylivewire extends Component
{
    use datatableLivewireTrait;
    public $showdata;

    protected function databind($patientinsuranceid, $type)
    {
        if ($type == 'show') {
            $this->showdata = Patientinsurance::find($patientinsuranceid);
        }
    }

    public function render()
    {
        $patientinsurance = Patientinsurance::with('patient')->where('active', true)
            ->where('stage', 6)
            ->where(fn($q) =>
                $q->whereHas('patient', fn(Builder $q) =>
                    $q->where('name', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                )
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.insurance.patientinsurance.patientinsurancehistory.patientinsurancehistorylivewire',
            compact('patientinsurance'));
    }
}
