<?php

namespace App\Http\Livewire\Livewirehelper\Patientregistration;

use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

trait patientregistrationLivewireTrait
{
    public $salutation, $name, $last_name, $phone, $email, $gender, $age, $dob, $patient_id;
    public $patient_uhid, $aadharid, $parentorguardian, $contact_person_name, $contact_person_phone;
    public $marital_status, $spouse_name, $door_no, $area, $city, $pincode, $occupation;
    public $country_id, $state_id, $patient_hospital_id, $note, $blood_group;
    public $avatar = null, $existingavatar;
    public $countrylist = [], $statelist = [];

    public function mount()
    {
        $this->countrylist = Country::where('active', true)->pluck('name', 'id');
        $this->statelist = State::where('active', true)->pluck('name', 'id');
        $this->country_id = Country::where('code', 'IN')->first()->id;
        $this->state_id = State::where('code', 'TN')->first()->id;
    }

    protected function rules()
    {
        return [
            // Patient Data
            'salutation' => 'nullable|numeric',
            'name' => 'required|string|max:70',
            'last_name' => 'nullable|string|min:1|max:70',
            'email' => 'nullable|email',
            'phone' => 'required|numeric', // |digits:10
            'gender' => 'required|numeric|not_in:0',
            'age' => 'required|numeric|max:150',
            'avatar' => 'nullable|image|max:1024',
            'dob' => 'nullable|date',
            'blood_group' => 'nullable|numeric|not_in:0',
            'aadharid' => 'nullable|numeric|digits:12',
            'parentorguardian' => 'nullable|string|max:150',
            'contact_person_name' => 'nullable|string|max:150',
            'contact_person_phone' => 'nullable|numeric|digits:10',
            'country_id' => 'nullable|numeric',
            'state_id' => 'nullable|numeric',
            'patient_hospital_id' => 'nullable',
            'marital_status' => 'nullable|numeric',
            'spouse_name' => 'nullable|string|min:1|max:70',
            'occupation' => 'nullable',
            'door_no' => 'nullable|string|min:1|max:70',
            'area' => 'nullable|string|min:1|max:70',
            'city' => 'nullable|string|min:1|max:70',
            'pincode' => 'nullable|numeric|digits:6',
            'note' => 'nullable|max:255',
        ];
    }

    public function Updateddob()
    {
        $this->age = Carbon::parse($this->dob)->age;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if (auth()->check()) {
            $user = auth()->user();
        } else if (auth()->guard('pharmacy')->check()) {
            $user = auth()->guard('pharmacy')->user();
        } else if (auth()->guard('laboratory')->check()) {
            $user = auth()->guard('laboratory')->user();
        }
        $validatedData['salutation'] = $validatedData['salutation'] ? $validatedData['salutation'] : null;
        try {

            DB::beginTransaction();
            if ($this->patient_id) {
                $patient = Patient::find($this->patient_id);
                $patient->update($validatedData);
                $user->patientupdatable()->save($patient);
                Helper::trackmessage($user, $patient, 'patient_createoredit', session()->getId(), 'WEB', 'Patient Updated');
                // $this->toaster('success', 'Patient Updated Successfully!!');
                toast('Patient Updated Successfully!!');
            } else {
                $validatedData['advance_amount'] = 0;
                $patient = $user->patientcreatable()->create($validatedData);
                $user->emrcreatable()->make([
                    'patient_id' => $patient->id,
                    'type' => 'Patient Registration',
                ])
                    ->emrable()
                    ->associate($patient)
                    ->save();
                Helper::trackmessage($user, $patient, 'patient_createoredit', session()->getId(), 'WEB', 'Patient Created');
                 $this->toaster('success', 'Patient Created Successfully!!');
                //   toast('Patient Created Successfully!!');
            }

            if ($validatedData['avatar']) {
                ($patient->avatar) ? Storage::delete('public/' . $patient->avatar) : '';
                $saveimage = Image::make($validatedData['avatar'])
                    ->resize(150, 150)
                    ->encode('jpg', 90)
                    ->stream();

                $patient->avatar = $path = 'patient/image/userprofile/' . time() . '.jpg';
                Storage::disk('public')->put($path, $saveimage, 'public');
                $patient->save();
            }

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function formreset()
    {
        $this->salutation = $this->name = $this->last_name = $this->email = $this->phone = $this->gender = $this->age =
        $this->dob = $this->aadharid = $this->patient_uhid = $this->patient_id = $this->parentorguardian =
        $this->contact_person_name = $this->contact_person_phone = $this->country_id = $this->state_id =
        $this->patient_hospital_id = $this->marital_status = $this->blood_group = $this->spouse_name =
        $this->door_no = $this->area = $this->city = $this->pincode = $this->avatar =
        $this->existingavatar = $this->occupation = $this->note = null;

        $this->resetValidation();
    }
}
