<?php

namespace App\Http\Livewire\Admin\Patientregistration\Patientvisithistory\Patientvisithistoryedit;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Outpatient\Outpatient;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientvisitsetting\Allergymaster;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Patientvisithistoryeditlivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $patient_uhid, $name, $phone, $dob, $email, $aadharid;
    public $patient_id, $patientvisit_id, $patient_visittype, $wardtype_id;
    public $doctor_id, $doctorspecialization_id, $complaint_note;
    public $billing_type, $insurancecompany_id, $tpaname_id, $tpaidno, $policyno;
    public $temperature, $bloodpressure, $height, $weight, $pulserate, $respiratoryrate;
    public $spo_two, $painscaleone, $visit_category_id, $character;
    public $alcohol, $tobacco, $smoking, $others, $visit_note;

    public $doctorspecialization;
    public $allergy_data = [], $currentcomplaints_data = [], $doctor_data = [], $doctorspecialization_data = [], $insurancecompany_data = [];
    public $allergy, $currentcomplaints;
    public $wardtype_data;

    public $patient_selected, $searchpatientlist = [];

    public function mount($uuid)
    {
        $this->currentcomplaints_data = Currentcomplaints::where('active', true)->get();
        $this->allergy_data = Allergymaster::where('active', true)->get();
        $this->doctor_data = Doctor::where('active', true)->pluck('name', 'id');
        $this->doctorspecialization_data = Doctorspecialization::where('active', true)->pluck('name', 'id');
        $this->insurancecompany_data = Insurancecompany::where('active', true)->pluck('name', 'id');
        $this->wardtype_data = Wardtype::where('active', true)->where('ward_category', 1)->pluck('name', 'id');

        $patientvisit = Patientvisit::where('uuid', $uuid)->first();
        $this->patientvisit_id = $patientvisit->id;
        $this->doctor_id = $patientvisit->doctor_id;
        $this->doctorspecialization_id = $patientvisit->doctorspecialization_id;
        $this->complaint_note = $patientvisit->complaint_note;
        $this->visit_category_id = $patientvisit->visit_category_id;
        $this->patient_visittype = $patientvisit->patient_visittype;
        $this->wardtype_id = $patientvisit->wardtype_id;

        $this->temperature = $patientvisit->temperature;
        $this->bloodpressure = $patientvisit->bloodpressure;
        $this->height = $patientvisit->height;
        $this->weight = $patientvisit->weight;
        $this->pulserate = $patientvisit->pulserate;
        $this->respiratoryrate = $patientvisit->respiratoryrate;
        $this->spo_two = $patientvisit->spo_two;
        $this->painscaleone = $patientvisit->painscaleone;
        $this->character = $patientvisit->character;
        $this->billing_type = $patientvisit->billing_type;
        $this->insurancecompany_id = $patientvisit->insurancecompany_id;
        $this->tpaname_id = $patientvisit->tpaname_id;
        $this->tpaidno = $patientvisit->tpaidno;
        $this->policyno = $patientvisit->policyno;
        $this->alcohol = $patientvisit->alcohol;
        $this->tobacco = $patientvisit->tobacco;
        $this->smoking = $patientvisit->smoking;
        $this->others = $patientvisit->others;
        $this->visit_note = $patientvisit->visit_note;
        $this->currentcomplaints = $patientvisit->currentcomplaints->pluck('id');
        $this->allergy = $patientvisit->allergymaster->pluck('id');
        $patient = Patient::find($patientvisit->patient_id);
        $this->patient_id = $patient->id;
        $this->patient_uhid = $patient->uhid;
        $this->name = $patient->name;
        $this->phone = $patient->phone;
        $this->email = $patient->email;
        $this->phone = $patient->phone;
        $this->dob = $patient->dob;
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

    public function hydrate()
    {
        $this->dispatch('loadaAllergySelect2Hydrate');
        $this->dispatch('loadCurrentcomplaintsSelect2Hydrate');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();

        try {
            DB::beginTransaction();
            if ($this->patientvisit_id) {

                $patientvisit = Patientvisit::find($this->patientvisit_id);
                $patient = Patient::find($this->patient_id);
                $patientvisit->update($validatedData);
                $user->patientvisitupdatable()->save($patientvisit);

                $this->visitcategory($user, $patient, $patientvisit);
                $patientvisit->allergymaster()->sync($this->allergy);
                $patientvisit->currentcomplaints()->sync($this->currentcomplaints);

                Helper::trackmessage($user, $patient, 'patient_createoredit', session()->getId(), 'WEB', 'Update Patient Visit Entry');
                $this->toaster('success', ' Patient Visit Entry Updated Successfully!!');
                DB::commit();
                $this->formreset();
                $this->redirect('/admin/patientvisithistory');
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
                $outpatient = Outpatient::where('patientvisit_id', $patientvisit->id)->first();
                if ($outpatient != null) {
                    $outpatient->update(['doctor_id' => $patientvisit->doctor_id,
                        'doctorspecialization_id' => $patientvisit->doctorspecialization_id]);

                    $user->outpatientupdatable()->save($outpatient);
                    $patientvisit->visitable()->associate($outpatient)->save();
                    $opbilling = Opbilling::where('patientvisit_id', $patientvisit->id)->first();
                    $opbilling->update(['total' => 0,
                        'due' => 0,
                        'paid' => 0,
                        'discount' => 0,
                        'advance' => 0]);

                    $user->opbillingupdatable()->save($opbilling);

                } else {
                    $outpatient = $user->outpatientcreatable()
                        ->create([
                            'patient_id' => $patient->id,
                            'patientvisit_id' => $patientvisit->id,
                        ]);
                    $patientvisit->visitable()->associate($outpatient)->save();
                    $user->opbillingcreatable()
                        ->create([
                            'patient_id' => $patient->id,
                            'patientvisit_id' => $patientvisit->id,

                        ]);
                }

                Log::info('Log not found' . $this->visit_category_id);

                break;
            case 2:
                $inpatient = Inpatient::where('patientvisit_id', $patientvisit->id)->first();
                if ($inpatient != null) {
                    $inpatient->update(['doctor_id' => $patientvisit->doctor_id,
                        'doctorspecialization_id' => $patientvisit->doctorspecialization_id]);
                    $user->inpatientupdatable()->save($inpatient);
                    $patientvisit->visitable()->associate($inpatient)->save();
                } else {
                    $inpatient = $user->inpatientcreatable()
                        ->create([
                            'patient_id' => $patient->id,
                            'patientvisit_id' => $patientvisit->id,
                            'doctor_id' => $patientvisit->doctor_id,
                            'doctorspecialization_id' => $patientvisit->doctorspecialization_id,
                        ]);
                    $patientvisit->visitable()->associate($inpatient)->save();
                }

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
        $this->patient_id = $this->doctor_id = $this->doctorspecialization_id = $this->complaint_note =
        $this->temperature = $this->bloodpressure =
        $this->height = $this->weight = $this->pulserate = $this->respiratoryrate = $this->spo_two = $this->painscaleone =
        $this->visit_category_id = $this->character = $this->alcohol = $this->tobacco = $this->smoking = $this->others =
        $this->billing_type = $this->insurancecompany_id = $this->tpaname_id = $this->tpaidno =
        $this->policyno = $this->allergy = $this->currentcomplaints = $this->doctorspecialization = $this->visit_note = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.patientregistration.patientvisithistory.patientvisithistoryedit.patientvisithistoryeditlivewire');
    }
}
