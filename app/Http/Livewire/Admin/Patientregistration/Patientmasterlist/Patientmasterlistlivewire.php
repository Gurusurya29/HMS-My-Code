<?php

namespace App\Http\Livewire\Admin\Patientregistration\Patientmasterlist;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Http\Livewire\Livewirehelper\Patientregistration\patientregistrationLivewireTrait;
use App\Models\Patient\Auth\Patient;
use Livewire\Component;
use Livewire\WithFileUploads;

class Patientmasterlistlivewire extends Component
{
    use WithFileUploads;
    use datatableLivewireTrait, miscellaneousLivewireTrait, patientregistrationLivewireTrait;

    public $showdata;

    protected function databind($patientid, $type)
    {
        if ($type == 'edit') {
            $patient = Patient::find($patientid);
            $this->patient_id = $patientid;
            $this->salutation = $patient->salutation;
            $this->name = $patient->name;
            $this->last_name = $patient->last_name;
            $this->email = $patient->email;
            $this->phone = $patient->phone;
            $this->gender = $patient->gender;
            $this->age = $patient->age;
            $this->dob = $patient->dob;
            $this->occupation = $patient->occupation;
            $this->aadharid = $patient->aadharid;
            $this->patient_uhid = $patient->patient_uhid;
            $this->parentorguardian = $patient->parentorguardian;
            $this->contact_person_name = $patient->contact_person_name;
            $this->contact_person_phone = $patient->contact_person_phone;
            $this->country_id = $patient->country_id;
            $this->state_id = $patient->state_id;
            $this->patient_hospital_id = $patient->patient_hospital_id;
            $this->reference_id = $patient->reference_id;
            $this->blood_group = $patient->blood_group;
            $this->marital_status = $patient->marital_status;
            $this->spouse_name = $patient->spouse_name;
            $this->door_no = $patient->door_no;
            $this->area = $patient->area;
            $this->city = $patient->city;
            $this->pincode = $patient->pincode;
            $this->existingavatar = $patient->avatar;
            $this->note = $patient->note;
        } else {
            $this->showdata = Patient::find($patientid);
        }
    }

    public function printlabel(Patient $patient)
    {
        $this->dispatch('printlabel', $patient->id);
    }

    public function render()
    {
        $patientlist = Patient::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.patientregistration.patientmasterlist.patientmasterlistlivewire',
            compact('patientlist'));
    }
}
