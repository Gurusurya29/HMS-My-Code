<?php

namespace App\Http\Livewire\Admin\Outpatient\Opassessment\Opassessmentgynecologist;

use App\Http\Livewire\Livewirehelper\Laboratory\labsyncLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Opassessmentgynecologistlivewire extends Component
{
    use WithFileUploads;
    use UploadTrait;
    use miscellaneousLivewireTrait;
    use labsyncLivewireTrait;

    public $currentcomplaint_data = [], $physicalexam_data = [], $diagnosismaster_data = [], $labinvestigation_data = [], $scaninvestigation_data = [], $xrayinvestigation_data = [];
    public $is_labinvestigationemergency = false, $is_scaninvestigationemergency = false, $is_xrayinvestigationemergency = false;
    public $currentcomplaint, $physicalexam, $diagnosismaster, $labinvestigation, $scaninvestigation, $xrayinvestigation;
    public $currentcomplaint_note, $physicalexam_note, $diagnosis_note,
    $labinvestigation_note, $labinvestigation_file, $templabinvestigation_file, $scaninvestigation_note, $scaninvestigation_file, $tempscaninvestigation_file, $xrayinvestigation_note, $xrayinvestigation_file, $tempxrayinvestigation_file, $prescription_note, $prescription_file, $tempprescription_file,
    $pasthistory_note, $nutritionalscreening_note, $physicalexamination_note, $generalexamination_note, $provisionaldiagnosis_note,
    $planofcare_note, $systemicexamfinding_note, $dietadvice_note, $nextvisit_date, $doctor_note, $abdominalexamination_note,
    $nervoussystemexamination_note, $perrectalexamination_note, $pervaginalexamination_note;

    public $is_pallor = false, $is_cyanosis = false, $is_icterus = false, $is_clubbing = false, $is_pedaledema = false, $is_anasarca = false, $functional_assesment;

    public $searchquery, $pharmacyproduct, $prescriptionlist = [], $drug_name, $drug_sku, $is_prescriptionemergency = false;

    public $user, $outpatient, $requesttype, $is_movetoip = false, $movetoipconfirm = false;

    protected $listeners = ['formreset'];

    public function hydrate()
    {
        $this->dispatch('loadCurrentcomplaintsSelect2Hydrate');
        $this->dispatch('loadPhysicalexamSelect2Hydrate');
        $this->dispatch('loadDiagnosismasterSelect2Hydrate');
        $this->dispatch('loadLabinvestigationSelect2Hydrate');
        $this->dispatch('loadScaninvestigationSelect2Hydrate');
        $this->dispatch('loadXrayinvestigationSelect2Hydrate');
    }

    public function mount($outpatient, $requesttype)
    {
        $this->user = auth()->user();
        $this->outpatient = $outpatient;
        $this->requesttype = $requesttype;
        $this->currentcomplaint = $outpatient->patientvisit->currentcomplaintsSelect;
        $this->currentcomplaint_note = $outpatient->patientvisit->complaint_note;
        $this->currentcomplaint_data = Currentcomplaints::where('active', true)->get();
        $this->physicalexam_data = Physicalexam::where('active', true)->get();
        $this->diagnosismaster_data = Diagnosismaster::where('active', true)->get();
        $this->labinvestigation_data = Labinvestigation::where('active', true)
            ->whereHas('labinvestigationgroup', function (Builder $query) {
                $query->where('labinvestigationtype', 1);
            })->get();
        $this->scaninvestigation_data = Labinvestigation::where('active', true)
            ->whereHas('labinvestigationgroup', function (Builder $query) {
                $query->where('labinvestigationtype', 2);
            })->get();
        $this->xrayinvestigation_data = Labinvestigation::where('active', true)
            ->whereHas('labinvestigationgroup', function (Builder $query) {
                $query->where('labinvestigationtype', 3);
            })->get();

        if ($outpatient->specialable) {
            $this->currentcomplaint = $outpatient->specialable->currentcomplaints->pluck('id');
            $this->physicalexam = $outpatient->specialable->physicalexam->pluck('id');
            $this->diagnosismaster = $outpatient->specialable->diagnosismaster->pluck('id');
            $this->labinvestigation = $outpatient->specialable->labinvestigation->pluck('id');
            $this->scaninvestigation = $outpatient->specialable->scaninvestigation->pluck('id');
            $this->xrayinvestigation = $outpatient->specialable->xrayinvestigation->pluck('id');
            $this->currentcomplaint_note = $outpatient->specialable->currentcomplaint_note;
            $this->physicalexam_note = $outpatient->specialable->physicalexam_note;
            $this->diagnosis_note = $outpatient->specialable->diagnosis_note;

            $this->labinvestigation_note = $outpatient->specialable->labinvestigation_note;
            $this->templabinvestigation_file = $outpatient->specialable->labinvestigation_file;
            $this->scaninvestigation_note = $outpatient->specialable->scaninvestigation_note;
            $this->tempscaninvestigation_file = $outpatient->specialable->scaninvestigation_file;

            $this->xrayinvestigation_note = $outpatient->specialable->xrayinvestigation_note;
            $this->tempxrayinvestigation_file = $outpatient->specialable->xrayinvestigation_file;
            $this->prescription_note = $outpatient->specialable->prescription_note;
            $this->tempprescription_file = $outpatient->specialable->prescription_file;

            $this->pasthistory_note = $outpatient->specialable->pasthistory_note;
            $this->nutritionalscreening_note = $outpatient->specialable->nutritionalscreening_note;
            $this->physicalexamination_note = $outpatient->specialable->physicalexamination_note;
            $this->generalexamination_note = $outpatient->specialable->generalexamination_note;
            $this->provisionaldiagnosis_note = $outpatient->specialable->provisionaldiagnosis_note;
            $this->planofcare_note = $outpatient->specialable->planofcare_note;

            $this->abdominalexamination_note = $outpatient->specialable->abdominalexamination_note;
            $this->nervoussystemexamination_note = $outpatient->specialable->nervoussystemexamination_note;
            $this->perrectalexamination_note = $outpatient->specialable->perrectalexamination_note;
            $this->pervaginalexamination_note = $outpatient->specialable->pervaginalexamination_note;

            $this->is_pallor = $outpatient->specialable->is_pallor;
            $this->is_cyanosis = $outpatient->specialable->is_cyanosis;
            $this->is_icterus = $outpatient->specialable->is_icterus;
            $this->is_clubbing = $outpatient->specialable->is_clubbing;
            $this->is_pedaledema = $outpatient->specialable->is_pedaledema;
            $this->is_anasarca = $outpatient->specialable->is_anasarca;
            $this->functional_assesment = $outpatient->specialable->functional_assesment;

            $this->systemicexamfinding_note = $outpatient->specialable->systemicexamfinding_note;
            $this->dietadvice_note = $outpatient->specialable->dietadvice_note;

            $this->nextvisit_date = $outpatient->specialable->nextvisit_date;
            $this->is_movetoip = $outpatient->is_movetoip;
            $this->doctor_note = $outpatient->specialable->doctor_note;

            $this->is_labinvestigationemergency = $outpatient->specialable->labable?->is_emergency;
            $this->is_scaninvestigationemergency = $outpatient->specialable->scanable?->is_emergency;
            $this->is_xrayinvestigationemergency = $outpatient->specialable->xrayable?->is_emergency;
            if ($outpatient->prescriptionable) {
                $this->is_prescriptionemergency = $outpatient->prescriptionable->is_emergency;
                $prescriptionlist_data = $outpatient->prescriptionable->prescriptionlist;
                $arr = [];
                foreach ($prescriptionlist_data as $key => $value) {
                    array_push($arr, [
                        'patient_id' => $value->patient_id,
                        'prescription_id' => $value->prescription_id,
                        'pharmacyproduct_id' => $value->pharmacyproduct_id,
                        'drug_name' => $value->drug_name,
                        'drug_sku' => $value->drug_sku,
                        'morning' => $value->morning,
                        'afternoon' => $value->afternoon,
                        'evening' => $value->evening,
                        'night' => $value->night,
                        'before_food' => $value->before_food,
                        'after_food' => $value->after_food,
                        'count' => $value->count,
                    ]);
                }

                $this->prescriptionlist = $arr;
            }
        }
    }

    protected function rules()
    {
        return [
            'currentcomplaint_note' => 'nullable|string|max:250',
            'physicalexam_note' => 'nullable|string|max:250',
            'diagnosis_note' => 'nullable|string|max:250',
            'labinvestigation_note' => 'nullable|string|max:250',
            'scaninvestigation_note' => 'nullable|string|max:250',
            'xrayinvestigation_note' => 'nullable|string|max:250',
            'prescription_note' => 'nullable|string|max:250',

            'labinvestigation_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'scaninvestigation_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'xrayinvestigation_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'prescription_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

            'pasthistory_note' => 'nullable|string|min:2|max:250',
            'nutritionalscreening_note' => 'nullable|string|min:2|max:250',
            'physicalexamination_note' => 'nullable|string|min:2|max:250',
            'generalexamination_note' => 'nullable|string|min:2|max:250',
            'provisionaldiagnosis_note' => 'nullable|string|min:2|max:250',
            'planofcare_note' => 'nullable|string|min:2|max:250',
            'systemicexamfinding_note' => 'nullable|string|min:2|max:250',
            'dietadvice_note' => 'nullable|string|min:2|max:250',
            'abdominalexamination_note' => 'nullable|string|min:2|max:250',
            'nervoussystemexamination_note' => 'nullable|string|min:2|max:250',
            'perrectalexamination_note' => 'nullable|string|min:2|max:250',
            'pervaginalexamination_note' => 'nullable|string|min:2|max:250',

            'is_pallor' => 'nullable|boolean',
            'is_cyanosis' => 'nullable|boolean',
            'is_icterus' => 'nullable|boolean',
            'is_clubbing' => 'nullable|boolean',
            'is_pedaledema' => 'nullable|boolean',
            'is_anasarca' => 'nullable|boolean',
            'functional_assesment' => 'nullable|boolean',

            'nextvisit_date' => 'nullable|date',
            'doctor_note' => 'nullable|string|max:250',

            'is_labinvestigationemergency' => 'nullable|boolean',
            'is_scaninvestigationemergency' => 'nullable|boolean',
            'is_xrayinvestigationemergency' => 'nullable|boolean',

            'prescriptionlist.*.drug_name' => 'required',
            'prescriptionlist.*.drug_sku' => 'required',
            'prescriptionlist.*.morning' => 'nullable',
            'prescriptionlist.*.afternoon' => 'nullable',
            'prescriptionlist.*.evening' => 'nullable',
            'prescriptionlist.*.night' => 'nullable',
            'prescriptionlist.*.before_food' => 'nullable',
            'prescriptionlist.*.after_food' => 'nullable',
            'prescriptionlist.*.count' => 'required',
            'is_prescriptionemergency' => 'required|boolean',

        ];
    }

    protected function messages()
    {
        return [
            'prescriptionlist.*.count.required' => 'Field is required',
        ];
    }

    public function updatedSearchquery()
    {
        $this->pharmacyproduct = Pharmacyproduct::where('active', true)
            ->whereNotIn('id', collect($this->prescriptionlist)->pluck('pharmacyproduct_id')->toArray())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function additem(Pharmacyproduct $pharmacyproduct)
    {
        if ($pharmacyproduct) {
            $this->prescriptionlist[] = [
                'pharmacyproduct_id' => $pharmacyproduct->id,
                'drug_name' => $pharmacyproduct->name,
                'drug_sku' => $pharmacyproduct->product_sku,
            ];
        }
        $this->searchquery = '';
        $this->pharmacyproduct = [];
    }

    public function removeitem($key)
    {
        unset($this->prescriptionlist[$key]);
    }

    public function Updatedmovetoipconfirm()
    {
        $this->dispatch('openconfirmmovetoip');
    }

    public function confirmmovetoip()
    {
        $this->is_movetoip = true;
        $this->dispatch('closeconfirmmovemodal');
    }

    public function cancelmovetoip()
    {
        $this->is_movetoip = false;
        $this->movetoipconfirm = false;
        $this->dispatch('closeconfirmmovemodal');
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->labinvestigation_file) {
            $validatedData['labinvestigation_file'] = $this->uploadfile($this->outpatient->specialable ? $this->outpatient->specialable->id : null, $this->labinvestigation_file, '/admin/outpatient/' . $this->outpatient->uniqid, 'App\Models\Admin\Outpatient\Gynecology\Opgynecology', 'labinvestigation_file');
        } elseif ($this->templabinvestigation_file) {
            $validatedData['labinvestigation_file'] = $this->templabinvestigation_file;
        }
        if ($this->scaninvestigation_file) {
            $validatedData['scaninvestigation_file'] = $this->uploadfile($this->outpatient->specialable ? $this->outpatient->specialable->id : null, $this->scaninvestigation_file, '/admin/outpatient/' . $this->outpatient->uniqid, 'App\Models\Admin\Outpatient\Gynecology\Opgynecology', 'scaninvestigation_file');
        } elseif ($this->tempscaninvestigation_file) {
            $validatedData['scaninvestigation_file'] = $this->tempscaninvestigation_file;
        }
        if ($this->xrayinvestigation_file) {
            $validatedData['xrayinvestigation_file'] = $this->uploadfile($this->outpatient->specialable ? $this->outpatient->specialable->id : null, $this->xrayinvestigation_file, '/admin/outpatient/' . $this->outpatient->uniqid, 'App\Models\Admin\Outpatient\Gynecology\Opgynecology', 'xrayinvestigation_file');
        } elseif ($this->tempxrayinvestigation_file) {
            $validatedData['xrayinvestigation_file'] = $this->tempxrayinvestigation_file;
        }
        if ($this->prescription_file) {
            $validatedData['prescription_file'] = $this->uploadfile($this->outpatient->specialable ? $this->outpatient->specialable->id : null, $this->prescription_file, '/admin/outpatient/' . $this->outpatient->uniqid, 'App\Models\Admin\Outpatient\Gynecology\Opgynecology', 'prescription_file');
        } elseif ($this->tempprescription_file) {
            $validatedData['prescription_file'] = $this->temptempprescription_file;
        }

        try {
            DB::beginTransaction();
            if ($this->outpatient->specialable) {
                $opgynecology = $this->outpatient->specialable;
                $opgynecology->update($validatedData);
                $this->user->opgynecologyupdatable()->save($opgynecology);
                $this->multiselectsync($opgynecology);

                if ($this->outpatient->prescriptionable) {
                    if ($this->is_prescriptionemergency != $this->outpatient->prescriptionable->is_emergency) {
                        $this->outpatient->prescriptionable->update(['is_emergency' => $this->is_prescriptionemergency]);
                    }
                    $prescription = $this->outpatient->prescriptionable;
                    $prescription->prescriptionlist()->delete();
                    $this->prescriptioncreate($prescription);
                } else {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->outpatient->patient_id,
                        'doctor_id' => $this->outpatient->patientvisit->doctor_id,
                        'maintype' => 'OUT PATIENT',
                        'subtype' => $this->outpatient->doctorspecialization->name . ' Out Patient',
                        'is_emergency' => $this->is_prescriptionemergency,
                    ]);
                    $prescription->prescriptionable()
                        ->associate($this->outpatient)
                        ->subprescriptionable()
                        ->associate($opgynecology)
                        ->save();
                    $this->prescriptioncreate($prescription);
                }
                if ($this->is_movetoip && ($this->outpatient->inpatient == null)) {
                    $this->outpatient->update([
                        'is_movetoip' => $this->is_movetoip,
                    ]);
                    $inpatient = $this->user->inpatientcreatable()
                        ->create([
                            'patient_id' => $this->outpatient->patient_id,
                            'patientvisit_id' => $this->outpatient->patientvisit_id,
                            'doctor_id' => $this->outpatient->doctor_id,
                            'doctorspecialization_id' => $this->outpatient->doctorspecialization_id,
                            'outpatient_id' => $this->outpatient->id,
                        ]);
                }
                Helper::trackmessage($this->user, $opgynecology, 'patientassesment_createoredit', session()->getId(), 'WEB', 'Patient Assessment Created');

                $this->toaster('success', 'Patient Assessment Updated Successfully!!');
            } else {

                $validatedData['patient_id'] = $this->outpatient->patient_id;
                $validatedData['patientvisit_id'] = $this->outpatient->patientvisit_id;
                $validatedData['doctor_id'] = $this->outpatient->doctor_id;
                $validatedData['doctorspecialization_id'] = $this->outpatient->doctorspecialization_id;
                $opgynecology = $this->user->opgynecologycreatable()
                    ->create($validatedData);
                $this->user->emrcreatable()->make([
                    'patient_id' => $this->outpatient->patient->id,
                    'doctor_id' => $this->outpatient->patientvisit->doctor_id,
                    'type' => 'Out Patient',
                ])
                    ->emrable()
                    ->associate($this->outpatient)
                    ->save();
                if ($this->prescriptionlist) {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->outpatient->patient_id,
                        'doctor_id' => $this->outpatient->patientvisit->doctor_id,
                        'maintype' => 'OUT PATIENT',
                        'subtype' => $this->outpatient->doctorspecialization->name . ' Out Patient',
                        'is_emergency' => $this->is_prescriptionemergency,
                    ]);
                    $prescription->prescriptionable()
                        ->associate($this->outpatient)
                        ->subprescriptionable()
                        ->associate($opgynecology)
                        ->save();
                    $this->prescriptioncreate($prescription);
                }

                $this->multiselectsync($opgynecology);
                $this->outpatient->update([
                    'is_movetoip' => $this->is_movetoip,
                    'is_doctorattended' => Carbon::now(),
                ]);
                $this->outpatient->specialable()->associate($opgynecology)
                    ->save();
                if ($this->is_movetoip) {
                    $inpatient = $this->user->inpatientcreatable()
                        ->create([
                            'patient_id' => $this->outpatient->patient_id,
                            'patientvisit_id' => $this->outpatient->patientvisit_id,
                            'doctor_id' => $this->outpatient->doctor_id,
                            'doctorspecialization_id' => $this->outpatient->doctorspecialization_id,
                            'outpatient_id' => $this->outpatient->id,
                        ]);
                }

                Helper::trackmessage($this->user, $opgynecology, 'patient_createoredit', session()->getId(), 'WEB', 'Patient Assessment Created');
                $this->toaster('success', 'Patient Assessment Created Successfully!!');
            }

            DB::commit();
            $this->formreset();
            if ($this->requesttype) {
                return redirect()->route('outpatienthistory');
            } else {
                return redirect()->route('outpatientqueue');
            }
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_patient_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_patient_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_patient_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function multiselectsync($opgynecology)
    {
        $opgynecology->currentcomplaints()->sync($this->currentcomplaint);
        $opgynecology->physicalexam()->sync($this->physicalexam);
        $opgynecology->diagnosismaster()->sync($this->diagnosismaster);

        $this->labinvestigationsync($this->labinvestigation, $this->user, $this->outpatient->patient_id, $opgynecology, 'OP', 'OP Gnecology', $this->is_labinvestigationemergency);
        $this->scaninvestigationsync($this->scaninvestigation, $this->user, $this->outpatient->patient_id, $opgynecology, 'OP', 'OP Gnecology', $this->is_scaninvestigationemergency);
        $this->xrayinvestigationsync($this->xrayinvestigation, $this->user, $this->outpatient->patient_id, $opgynecology, 'OP', 'OP Gnecology', $this->is_xrayinvestigationemergency);
    }

    protected function prescriptioncreate($prescription)
    {
        foreach ($this->prescriptionlist as $key => $eachprescription) {
            $this->user->prescriptionlistcreatable()->create([
                'patient_id' => $this->outpatient->patient->id,
                'prescription_id' => $prescription->id,
                'pharmacyproduct_id' => $eachprescription['pharmacyproduct_id'],
                'drug_name' => $eachprescription['drug_name'],
                'drug_sku' => $eachprescription['drug_sku'],
                'morning' => array_key_exists('morning', $eachprescription) ? $eachprescription['morning'] : false,
                'afternoon' => array_key_exists('afternoon', $eachprescription) ? $eachprescription['afternoon'] : false,
                'evening' => array_key_exists('evening', $eachprescription) ? $eachprescription['evening'] : false,
                'night' => array_key_exists('night', $eachprescription) ? $eachprescription['night'] : false,
                'before_food' => array_key_exists('before_food', $eachprescription) ? $eachprescription['before_food'] : false,
                'after_food' => array_key_exists('after_food', $eachprescription) ? $eachprescription['after_food'] : false,
                'count' => $eachprescription['count'],
            ]);
        }
    }
    public function formreset()
    {

        $this->currentcomplaint = $this->physicalexam = $this->diagnosismaster = $this->labinvestigation = $this->scaninvestigation = $this->xrayinvestigation =
        $this->currentcomplaint_note = $this->physicalexam_note = $this->diagnosis_note =
        $this->labinvestigation_note = $this->labinvestigation_file = $this->scaninvestigation_note = $this->scaninvestigation_file =
        $this->xrayinvestigation_note = $this->xrayinvestigation_file = $this->prescription_note = $this->prescription_file =
        $this->pasthistory_note = $this->nutritionalscreening_note = $this->physicalexamination_note =
        $this->generalexamination_note = $this->provisionaldiagnosis_note = $this->planofcare_note =
        $this->systemicexamfinding_note = $this->dietadvice_note = $this->is_prescriptionemergency =
        $this->nextvisit_date = $this->doctor_note = $this->is_labinvestigationemergency = $this->is_scaninvestigationemergency = $this->is_xrayinvestigationemergency = null;

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.outpatient.opassessment.opassessmentgynecologist.opassessmentgynecologistlivewire');
    }
}
