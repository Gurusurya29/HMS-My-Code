<?php

namespace App\Http\Livewire\Admin\Outpatient\Outpatienthistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Outpatient\Outpatient;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Outpatienthistorylivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata;

    protected function databind($patientid, $type)
    {
        $this->showdata = Outpatient::find($patientid);
    }

    public function downloadFile($op_uniqid, $file_name)
    {
        $file = storage_path('app/public/admin/outpatient/' . $op_uniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }
    public function printprescription(Outpatient $outpatient)
    {
        $this->dispatch('printprescription', $outpatient->id);
    }

    public function printassessment(Outpatient $outpatient)
    {
        $this->dispatch('printassessment', $outpatient->id);
    }
    public function opprintinvestigation(Outpatient $outpatient)
    {
        $this->dispatch('opprintinvestigation', $outpatient->id);
    }
    public function opprintinvestigationresult(Outpatient $outpatient)
    {
        $this->dispatch('opprintinvestigationresult', $outpatient->id);
    }
    public function render()
    {
        $outpatient = Outpatient::with('patient', 'patientvisit', 'doctor', 'doctorspecialization')->where('active', true)
            ->whereNotNull('is_doctorattended')
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

        return view('livewire.admin.outpatient.outpatienthistory.outpatienthistorylivewire',
            compact('outpatient'));
    }
}
