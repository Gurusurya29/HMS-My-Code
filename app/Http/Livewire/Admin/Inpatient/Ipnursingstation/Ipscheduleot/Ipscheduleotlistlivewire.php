<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipnursingstation\Ipscheduleot;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use Livewire\Component;

class Ipscheduleotlistlivewire extends Component
{
    use datatableLivewireTrait;
    public $inpatient;
    public $showdata;

    public function mount($inpatient_uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
    }
    protected function databind($otscheduleid, $type)
    {
        $this->showdata = Otschedule::find($otscheduleid);
    }

    public function downloadFile($otscheduleuniqid, $file_name)
    {
        $file = storage_path('app/public/admin/otschedule/' . $otscheduleuniqid . '/' . $file_name);

        return response()->download($file);
    }
    public function render()
    {
        $otschedulelist = Otschedule::where('inpatient_id', $this->inpatient->id)
            ->where(function ($query) {
                $query->where('surgery_name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.inpatient.ipnursingstation.ipscheduleot.ipscheduleotlistlivewire', compact('otschedulelist'));
    }
}
