<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipassesmentlist;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipassesment;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;

class Ipassesmentlistlivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata, $inpatient;

    public function mount($uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $uuid)->first();
    }

    protected function databind($ipassesmentid, $type)
    {
        $this->showdata = Ipassesment::find($ipassesmentid);
    }

    public function downloadFile($ip_uniqid, $file_name)
    {
        $file = storage_path('app/public/admin/ipassesment/' . $ip_uniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function printipprescription(Ipassesment $ipassessment)
    {
        $this->dispatch('printipprescription', $ipassessment->id);
    }

    public function printipinvestigation(Ipassesment $ipassessment)
    {
        $this->dispatch('printipinvestigation', $ipassessment->id);
    }
    public function printipinvestigationresult(Ipassesment $ipassessment)
    {
        $this->dispatch('printipinvestigationresult', $ipassessment->id);
    }

    public function render()
    {
        $ipassesment = Ipassesment::where('active', true)
            ->where('inpatient_id', $this->inpatient->id)
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.inpatient.ipassesmentlist.ipassesmentlistlivewire',
            compact('ipassesment'));
    }
}
