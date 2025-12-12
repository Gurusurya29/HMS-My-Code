<?php

namespace App\Http\Livewire\Admin\Settings\Doctorsetting\Adddoctor;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Adddoctorlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $country_id, $state_id, $surname, $department, $designation, $doj, $doctorspecialization_id,
    $doctor_type, $registration_validdays, $no_of_freevisit, $is_surgeon = false, $door_no, $area, $city,
    $pincode, $showinchargememos, $consultation_fee, $emergency_number, $active = false;
    public $countrylist = [], $statelist = [], $doctorspecializationlist = [];
    public $adddoctor_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:doctors,name,' . $this->adddoctor_id,
            'note' => 'nullable|max:255',
            'country_id' => 'nullable|numeric',
            'state_id' => 'nullable|numeric',
            'doctorspecialization_id' => 'nullable|numeric',
            'surname' => 'nullable',
            'department' => 'nullable',
            'designation' => 'nullable',
            'doj' => 'nullable|date',
            'doctor_type' => 'nullable',
            'registration_validdays' => 'nullable',
            'no_of_freevisit' => 'nullable',
            'is_surgeon' => 'nullable',
            'door_no' => 'nullable|string|min:1|max:70',
            'area' => 'nullable|string|min:1|max:70',
            'city' => 'nullable|string|min:1|max:70',
            'pincode' => 'nullable|numeric|digits:6',
            'showinchargememos' => 'nullable',
            'consultation_fee' => 'nullable',
            'emergency_number' => 'nullable|numeric|digits:10',
            'active' => 'nullable|boolean',

        ];
    }

    public function mount()
    {
        $this->countrylist = Country::where('active', true)->pluck('name', 'id');
        $this->statelist = State::where('active', true)->pluck('name', 'id');
        $this->doctorspecializationlist = Doctorspecialization::where('active', true)->pluck('name', 'id');
        $this->country_id = Country::where('code', 'IN')->first()->id;
        $this->state_id = State::where('code', 'TN')->first()->id;
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->adddoctor_id) {
                $adddoctor = Doctor::find($this->adddoctor_id);
                $adddoctor->update($validatedData);
                $user->adddoctorupdatable()->save($adddoctor);
                Helper::trackmessage($user, $adddoctor, 'adddoctor_createoredit', session()->getId(), 'WEB', 'Doctor Updated Successfully');
                $this->toaster('success', 'Doctor Updated Successfully!!');
            } else {
                $validatedData['created_source'] = 'HMS';
                $adddoctor = $user->adddoctorcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $adddoctor, 'adddoctor_createoredit', session()->getId(), 'WEB', 'Doctor Added');
                $this->toaster('success', 'Doctor Added Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_adddoctor_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_adddoctor_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_adddoctor_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($adddoctorid, $type)
    {
        if ($type == 'edit') {
            $adddoctor = Doctor::find($adddoctorid);
            $this->name = $adddoctor->name;
            $this->country_id = $adddoctor->country_id;
            $this->state_id = $adddoctor->state_id;
            $this->doctorspecialization_id = $adddoctor->doctorspecialization_id;
            $this->surname = $adddoctor->surname;
            $this->department = $adddoctor->department;
            $this->designation = $adddoctor->designation;
            $this->doj = $adddoctor->doj;
            $this->doctor_type = $adddoctor->doctor_type;
            $this->registration_validdays = $adddoctor->registration_validdays;
            $this->no_of_freevisit = $adddoctor->no_of_freevisit;
            $this->is_surgeon = $adddoctor->is_surgeon;
            $this->door_no = $adddoctor->door_no;
            $this->area = $adddoctor->area;
            $this->city = $adddoctor->city;
            $this->pincode = $adddoctor->pincode;
            $this->showinchargememos = $adddoctor->showinchargememos;
            $this->consultation_fee = $adddoctor->consultation_fee;
            $this->emergency_number = $adddoctor->emergency_number;
            $this->active = $adddoctor->active;
            $this->note = $adddoctor->note;
            $this->adddoctor_id = $adddoctorid;
        } else {
            $this->showdata = Doctor::find($adddoctorid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->country_id = $this->state_id = $this->doctorspecialization_id =
        $this->surname = $this->department = $this->designation = $this->doj = $this->doctor_type =
        $this->registration_validdays = $this->no_of_freevisit = $this->door_no =
        $this->area = $this->city = $this->pincode = $this->showinchargememos = $this->consultation_fee =
        $this->emergency_number = $this->active = $this->adddoctor_id = null;
        $this->active = $this->is_surgeon = false;
        $this->resetValidation();
    }

    public function render()
    {
        $adddoctor = Doctor::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.doctorsetting.adddoctor.adddoctorlivewire',
            compact('adddoctor'));
    }
}
