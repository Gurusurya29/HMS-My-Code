<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipotscheduledlist;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;

class Ipotscheduledlistlivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata, $inpatient;

    public function mount($uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $uuid)->first();
    }

    protected function databind($otscheduleid, $type)
    {
        $this->showdata = Otschedule::find($otscheduleid);
    }

    public function downloadFile($otscheduleuniqid, $file_name)
    {
        $file = storage_path('app/public/admin/otschedule/' . $otscheduleuniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function render()
    {
        $ipotscheduledlist = Otschedule::where('inpatient_id', $this->inpatient->id)
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('surgery_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.inpatient.ipotscheduledlist.ipotscheduledlistlivewire',
            compact('ipotscheduledlist'));
    }
}
