<?php

namespace App\Http\Livewire\Admin\Patientregistration\Inpatientlist;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Inpatient\Ipadmission;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Inpatientlistlivewire extends Component
{
    use datatableLivewireTrait;

    public function render()
    {
        $inpatientlist = Ipadmission::with('patient')->where('active', true)
            ->whereHas('inpatient', function (Builder $query) {
                $query->whereNull('is_patientdischarged');
            })
            ->whereHas('patient', function (Builder $query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.patientregistration.inpatientlist.inpatientlistlivewire',
            compact('inpatientlist'));
    }
}
