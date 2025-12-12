<?php

namespace App\Http\Livewire\Laboratory\Xray\Patienthistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Laboratory\Xray\Xraypatient;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Xrayoratorypatienthistorylivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata = [];

    protected function databind($xraypatientid, $type)
    {
        if ($type == 'edit') {
            $xraypatient = Xraypatient::find($xraypatientid);
            $this->name = $xraypatient->name;
            $this->note = $xraypatient->note;
            $this->active = $xraypatient->active;
            $this->xraypatient_id = $xraypatientid;
        } else {
            $this->showdata = Xraypatient::find($xraypatientid);
        }
    }

    public function downloadFile($xraypatient_uniqid, $file_name)
    {
        $file = storage_path('app/public/laboratory/xraypatient/' . $xraypatient_uniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function render()
    {
        $xraypatient = Xraypatient::query()
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

        return view('livewire.laboratory.xray.patienthistory.xrayoratorypatienthistorylivewire',
            compact('xraypatient'));
    }
}
