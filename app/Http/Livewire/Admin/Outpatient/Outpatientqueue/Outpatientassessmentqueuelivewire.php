<?php

namespace App\Http\Livewire\Admin\Outpatient\Outpatientqueue;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Outpatient\Outpatient;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Outpatientassessmentqueuelivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata = [];

    protected function databind($outpatient_id, $type)
    {
        if ($type == 'show') {
            $this->showdata = Outpatient::find($outpatient_id);
        }
    }

    public function render()
    {
        $outpatient = Outpatient::with('patient', 'patientvisit', 'doctor', 'doctorspecialization')->where('active', true)
            ->whereNull('is_doctorattended')
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('patientvisit', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctorspecialization', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.outpatient.outpatientqueue.outpatientassessmentqueuelivewire',
            compact('outpatient'));
    }
}
