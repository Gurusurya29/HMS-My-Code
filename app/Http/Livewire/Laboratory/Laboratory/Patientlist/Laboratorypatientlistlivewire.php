<?php

namespace App\Http\Livewire\Laboratory\Laboratory\Patientlist;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Laboratory\Laboratory\Labpatient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Laboratorypatientlistlivewire extends Component
{
    use datatableLivewireTrait;

    // public $showdata = [];
    public $name;
    public $note;
    public $active;
    public $labpatient_id;
    public $showdata;

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
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->where(
                fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('maintype', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('subtype', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas(
                        'patient',
                        fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view(
            'livewire.laboratory.laboratory.patientlist.laboratorypatientlistlivewire',
            compact('labpatient')
        );
    }
}
