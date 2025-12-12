<?php

namespace App\Http\Livewire\Admin\Inpatient\Inpatienthistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Inpatienthistorylivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata;

    protected function databind($patientid, $type)
    {
        $this->showdata = Inpatient::find($patientid);
    }
    public function printdischargesummary($inpatient_id)
    {
        $this->dispatch('printdischargesummary', $inpatient_id);
    }
    public function downloadFile($ip_uniqid, $file_name)
    {
        $file = storage_path('app/public/admin/ipassesment/' . $ip_uniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function render()
    {
        $inpatient = Inpatient::with('patient', 'patientvisit', 'ipadmission')->where('active', true)
            ->whereNotNull('is_patientdischarged')
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

        return view('livewire.admin.inpatient.inpatienthistory.inpatienthistorylivewire',
            compact('inpatient'));
    }
}
