<?php

namespace App\Http\Livewire\Laboratory\Laboratory\Patienthistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Laboratory\Laboratory\Labpatient;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Laboratorypatienthistorylivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata = [];

    protected function databind($labpatientid, $type)
    {
        if ($type == 'edit') {
            $labpatient = Labpatient::find($labpatientid);
            $this->name = $labpatient->name;
            $this->note = $labpatient->note;
            $this->active = $labpatient->active;
            $this->labpatient_id = $labpatientid;
        } else {
            $this->showdata = Labpatient::find($labpatientid);
        }
    }

    public function render()
    {
        $labpatient = Labpatient::query()
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('maintype', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('subtype', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.laboratory.laboratory.patienthistory.laboratorypatienthistorylivewire', compact('labpatient'));
    }
}
