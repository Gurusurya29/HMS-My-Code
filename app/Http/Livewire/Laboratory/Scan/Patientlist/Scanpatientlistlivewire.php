<?php

namespace App\Http\Livewire\Laboratory\Scan\Patientlist;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Laboratory\Scan\Scanpatient;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Scanpatientlistlivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata = [];

    protected function databind($scanpatientid, $type)
    {
        if ($type == 'edit') {
            $scanpatient = Scanpatient::find($scanpatientid);
            $this->name = $scanpatient->name;
            $this->note = $scanpatient->note;
            $this->active = $scanpatient->active;
            $this->scanpatient_id = $scanpatientid;
        } else {
            $this->showdata = Scanpatient::find($scanpatientid);
        }
    }

    public function downloadFile($scanpatient_uniqid, $file_name)
    {
        $file = storage_path('app/public/laboratory/scanpatient/' . $scanpatient_uniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function render()
    {
        $scanpatient = Scanpatient::query()
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
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

        return view('livewire.laboratory.scan.patientlist.scanpatientlistlivewire', compact('scanpatient'));
    }
}
