<?php

namespace App\Http\Livewire\Admin\Inpatient\Inpatientqueue;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Inpatientqueuelivewire extends Component
{
    use datatableLivewireTrait;

    public $inpatient_id;
    public $doctor_id, $doctorlist;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->doctorlist = Doctor::where('active', true)->get();
    }

    public function initiatedischarge()
    {
        $this->dispatch('initiatedischarge');
    }

    public function printbarcode($inpatient_id)
    {
        $this->dispatch('printipbarcode', $inpatient_id);
    }

    protected function databind($inpatient_id, $type)
    {
        if ($type == 'edit') {
            $inpatient = Inpatient::find($inpatient_id);
            $this->showdata = $inpatient;
            $this->name = $inpatient->name;
            $this->note = $inpatient->note;
        } else {
            $this->showdata = Inpatient::find($inpatient_id);
        }
    }

    public function formreset()
    {
        $this->note = null;
        $this->resetValidation();
    }

    public function render()
    {
        $inpatient = Inpatient::with('patient', 'ipadmission', 'patientvisit')->where('active', true)
            ->whereNull('is_patientdischarged')
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('patientvisit.doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('patientvisit.doctorspecialization', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('ipadmission.wardtype', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('ipadmission.bedorroomnumber', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.inpatient.inpatientqueue.inpatientqueuelivewire',
            compact('inpatient'));
    }
}
