<?php

namespace App\Http\Livewire\Admin\Patientregistration\Patientregistration;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Http\Livewire\Livewirehelper\Patientregistration\patientregistrationLivewireTrait;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use Livewire\Component;
use Livewire\WithFileUploads;

class Patientregistrationlivewire extends Component
{
    use WithFileUploads;
    use datatableLivewireTrait, miscellaneousLivewireTrait, patientregistrationLivewireTrait;

    public function mount()
    {
        $this->countrylist = Country::where('active', true)->pluck('name', 'id');
        $this->statelist = State::where('active', true)->pluck('name', 'id');
        $this->country_id = Country::where('code', 'IN')->first()->id;
        $this->state_id = State::where('code', 'TN')->first()->id;
    }

    public function render()
    {

        return view('livewire.admin.patientregistration.patientregistration.patientregistrationlivewire');
    }
}
