<?php

namespace App\Http\Livewire\Admin\Patientregistration\Patientvisit;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
use App\Models\Admin\Settings\Patientvisitsetting\Allergymaster;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
class Patientvisitlivewire extends Component
{
     use WithPagination;
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $last_name, $phone, $email, $sex, $age, $dob, $patient_id;
    public $patient_uhid, $aadharid, $fatherorhusband, $contact_person_name, $contact_person_phone;
    public $doctor_id, $doctorspecialization_id, $complaint_note;
    public $billing_type, $insurancecompany_id, $tpaname_id, $tpaidno, $policyno;
    public $country_id, $state_id, $patient_hospital_id, $reference_id, $address, $note;
    public $temperature, $bloodpressure, $height, $weight, $pulserate, $respiratoryrate;
    public $spo_two, $painscaleone, $visit_category_id, $patient_visittype, $wardtype_id, $character, $visit_note;
    public $alcohol, $tobacco, $smoking, $others;
    public $countrylist = [], $statelist = [];

    public $doctorspecialization;
    public $allergy_data = [], $currentcomplaints_data = [], $doctor_data = [], $doctorspecialization_data = [], $insurancecompany_data = [];
    public $allergy, $currentcomplaints;
    public $wardtype_data;

    public $patient_selected, $searchpatientlist = [], $referencelist = [];

    public function hydrate()
    {
        $this->dispatch('loadaAllergySelect2Hydrate');
        $this->dispatch('loadCurrentcomplaintsSelect2Hydrate');
    }

    public function mount()
    {
        $this->currentcomplaints_data = Currentcomplaints::where('active', true)->get();
        $this->allergy_data = Allergymaster::where('active', true)->get();
        $this->doctor_data = Doctor::where('active', true)->pluck('name', 'id');
        $this->doctorspecialization_data = Doctorspecialization::where('active', true)->pluck('name', 'id');
        $this->insurancecompany_data = Insurancecompany::where('active', true)->pluck('name', 'id');
        $this->wardtype_data = Wardtype::where('active', true)->where('ward_category', 1)->pluck('name', 'id');
        $this->referencelist = Reference::where('active', true)->pluck('name', 'id');
        $this->visit_category_id = 1;
        $this->patient_visittype = 1;
        $this->billing_type = 1;
    }

    protected function rules()
    {
        return [
            // Patient Visit
            'doctor_id' => 'required|numeric',
            'doctorspecialization_id' => 'required|numeric',
            'complaint_note' => 'nullable|string|min:3|max:255',
            'visit_category_id' => 'required|numeric|not_in:0',
            'patient_visittype' => 'required|numeric',
            'wardtype_id' => 'nullable',
            'temperature' => 'nullable|string|min:1|max:70',
            'bloodpressure' => 'nullable|string|min:1|max:70',
            'height' => 'nullable|string|min:1|max:70',
            'weight' => 'nullable|string|min:1|max:70',
            'pulserate' => 'nullable|string|min:1|max:70',
            'respiratoryrate' => 'nullable|string|min:1|max:70',
            'spo_two' => 'nullable|string|min:1|max:70',
            'painscaleone' => 'nullable|numeric|not_in:0',
            'reference_id' => 'nullable|numeric|not_in:0',
            'character' => 'nullable|string|min:3|max:70',
            'billing_type' => 'nullable|numeric',
            'insurancecompany_id' => 'nullable|numeric',
            'tpaname_id' => 'nullable|numeric',
            'tpaidno' => 'nullable|string|min:3|max:70',
            'policyno' => 'nullable|string|min:3|max:70',
            'alcohol' => 'nullable',
            'tobacco' => 'nullable',
            'smoking' => 'nullable',
            'others' => 'nullable|string|min:3|max:70',
            'visit_note' => 'nullable',
        ];
    }

    protected function messages()
    {
        return [
            'wardtype_id.required_if' => 'Select Ward type.',
        ];
    }

    public function searchpatient()
    {
        if ($this->patient_selected) {
            $this->searchpatientlist = Patient::where(function ($query) {
                $query->where('name', 'like', '%' . $this->patient_selected . '%')
                    ->orWhere('phone', 'like', '%' . $this->patient_selected . '%')
                    ->orWhere('aadharid', 'like', '%' . $this->patient_selected . '%')
                    ->orWhere('uhid', 'like', '%' . $this->patient_selected . '%');
            })
                ->take(10)
                ->get();
        }
    }

    public function selectpatient($patient_id)
    {
        $patient = Patient::find($patient_id);
        $this->patient_id = $patient_id;
        $this->patient_uhid = $patient->uhid;
        $this->name = $patient->name;
        $this->phone = $patient->phone;
        $this->last_name = $patient->last_name;
        $this->email = $patient->email;
        $this->phone = $patient->phone;
        $this->gender = $patient->gender;
        $this->age = $patient->age;
        $this->dob = $patient->dob;
        $this->aadharid = $patient->aadharid;
        $this->fatherorhusband = $patient->fatherorhusband;
        $this->contact_person_name = $patient->contact_person_name;
        $this->contact_person_phone = $patient->contact_person_phone;
        $this->country_id = $patient->country_id;
        $this->state_id = $patient->state_id;
        $this->patient_hospital_id = $patient->patient_hospital_id;
        $this->address = $patient->address;
        $this->note = $patient->note;

        $this->patient_selected = [];
        $this->searchpatientlist = [];
    }

    public function searchpatientfoucs()
    {
        $this->patient_selected = [];
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $validate = $this->validate();
            $validate['wardtype_id'] = $this->wardtype_id ? $this->wardtype_id : null;

            if ($this->patient_id) {
                $patient = Patient::find($this->patient_id);
                $patientvisit = $user->patientvisitcreatable()
                    ->create(array_merge(['patient_id' => $patient->id], $validate));
                $user->emrcreatable()->make([
                    'patient_id' => $patient->id,
                    'doctor_id' => $patientvisit->doctor_id,
                    'type' => 'Patient Visit',
                ])
                    ->emrable()
                    ->associate($patientvisit)
                    ->save();
                $this->visitcategory($user, $patient, $patientvisit);
                $patientvisit->allergymaster()->sync($this->allergy);
                $patientvisit->currentcomplaints()->sync($this->currentcomplaints);

                Helper::trackmessage($user, $patient, 'patient_createoredit', session()->getId(), 'WEB', 'New Patient Visit Entry');
                $this->toaster('success', 'New Patient Visit Entry Created Successfully!!');
                DB::commit();
                $this->formreset();
            } else {
                DB::rollback();
                $this->toaster('error', 'Please Select Valid Patient Details!!');
            }

        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function visitcategory($user, $patient, $patientvisit)
    {
        switch ($this->visit_category_id) {
            case 1:

                $outpatient = $user->outpatientcreatable()
                    ->create([
                        'patient_id' => $patient->id,
                        'patientvisit_id' => $patientvisit->id,
                        'doctor_id' => $patientvisit->doctor_id,
                        'doctorspecialization_id' => $patientvisit->doctorspecialization_id,
                    ]);
                $patientvisit->visitable()->associate($outpatient)->save();

                $user->opbillingcreatable()
                    ->create([
                        'patient_id' => $patient->id,
                        'patientvisit_id' => $patientvisit->id,
                        'total' => 0,
                        'grand_total' => 0,
                        'discount' => 0,
                        'advance' => 0,
                    ]);

                Log::info('Log not found' . $this->visit_category_id);

                break;
            case 2:

                $inpatient = $user->inpatientcreatable()
                    ->create([
                        'patient_id' => $patient->id,
                        'patientvisit_id' => $patientvisit->id,
                        'doctor_id' => $patientvisit->doctor_id,
                        'doctorspecialization_id' => $patientvisit->doctorspecialization_id,
                    ]);

                $patientvisit->visitable()->associate($inpatient)->save();

                Log::info('Log not found' . $this->visit_category_id);
                break;
            case 3:

                // Outpatient::create();
                // Opbilling::create();

                Log::info('Log not found' . $this->visit_category_id);
                break;
            default:
                Log::info('Log not found' . $this->visit_category_id);
        }
    }

    public function formreset()
    {
        $this->name = $this->last_name = $this->email = $this->phone = $this->gender = $this->age = $this->dob = $this->aadharid =
        $this->patient_uhid = $this->patient_id = $this->doctor_id = $this->doctorspecialization_id = $this->complaint_note =
        $this->fatherorhusband = $this->contact_person_name = $this->contact_person_phone = $this->country_id = $this->state_id =
        $this->patient_hospital_id = $this->reference_id = $this->address = $this->temperature = $this->bloodpressure =
        $this->height = $this->weight = $this->pulserate = $this->respiratoryrate = $this->spo_two = $this->painscaleone =
        $this->visit_category_id = $this->wardtype_id = $this->character = $this->alcohol = $this->tobacco = $this->smoking = $this->others =
        $this->billing_type = $this->insurancecompany_id = $this->tpaname_id = $this->tpaidno =
        $this->policyno = $this->allergy = $this->currentcomplaints = $this->doctorspecialization = $this->note = $this->visit_note = $this->patient_visittype = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.patientregistration.patientvisit.patientvisitlivewire');
    }
}
