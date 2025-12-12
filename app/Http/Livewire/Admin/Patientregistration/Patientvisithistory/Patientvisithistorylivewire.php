<?php

namespace App\Http\Livewire\Admin\Patientregistration\Patientvisithistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Patient\Patientvisit;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Patientvisithistorylivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata;

    protected function databind($patientid, $type)
    {
        $this->showdata = Patientvisit::find($patientid);
    }

    public function printtoken(Patientvisit $patientvisit)
    {
        $this->dispatch('printtoken', $patientvisit->id);
    }

    public function render()
    {
        $patientvisithistory = Patientvisit::with('patient')->where('active', true)
            ->whereHas('patient', function (Builder $query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('token_id', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.patientregistration.patientvisithistory.patientvisithistorylivewire',
            compact('patientvisithistory'));
    }
}
