<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipnursingstation\Ipassesment;

use App\Http\Livewire\Livewirehelper\Laboratory\labsyncLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipassesment;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Ipassesmentlivewire extends Component
{
    use WithFileUploads;
    use UploadTrait;
    use miscellaneousLivewireTrait;
    use labsyncLivewireTrait;

    public $currentcomplaint_data = [], $diagnosismaster_data = [], $labinvestigation_data = [], $scaninvestigation_data = [], $xrayinvestigation_data = [];
    public $is_labinvestigationemergency = false, $is_scaninvestigationemergency = false, $is_xrayinvestigationemergency = false;
    public $currentcomplaint, $diagnosismaster, $labinvestigation, $scaninvestigation, $xrayinvestigation;
    public $doctorlist, $doctor_id, $currentcomplaint_note, $diagnosis_note,
    $labinvestigation_note, $labinvestigation_file, $templabinvestigation_file, $scaninvestigation_note,
    $scaninvestigation_file, $tempscaninvestigation_file, $xrayinvestigation_note, $xrayinvestigation_file, $tempxrayinvestigation_file,
    $prescription_note, $prescription_file, $tempprescription_file, $dietadvice_note, $doctor_note;

    public $searchquery, $pharmacyproduct, $prescriptionlist = [], $drug_name, $drug_sku, $is_prescriptionemergency = false;

    public $inpatient, $user, $ipassesment_data;

    public function mount($inpatient_uuid, $ipassesment_uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->user = auth()->user();
        $this->doctorlist = Doctor::where('active', true)->get();
        // $this->doctorspecializationlist = Doctorspecialization::where('active', true)->pluck('name', 'id');

        $this->currentcomplaint = $this->inpatient->patientvisit->currentcomplaintsSelect;
        $this->currentcomplaint_note = $this->inpatient->patientvisit->complaint_note;
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

        if ($ipassesment_uuid) {
            $this->ipassesment_data = Ipassesment::where('uuid', $ipassesment_uuid)->first();
            $this->doctor_id = $this->ipassesment_data->doctor_id;
            // $this->doctorspecialization_id = $this->ipassesment_data->doctorspecialization_id;
            $this->currentcomplaint = $this->ipassesment_data->currentcomplaints->pluck('id');
            $this->diagnosismaster = $this->ipassesment_data->diagnosismaster->pluck('id');
            $this->labinvestigation = $this->ipassesment_data->labinvestigation->pluck('id');
            $this->scaninvestigation = $this->ipassesment_data->scaninvestigation->pluck('id');
            $this->xrayinvestigation = $this->ipassesment_data->xrayinvestigation->pluck('id');
            $this->currentcomplaint_note = $this->ipassesment_data->currentcomplaint_note;
            $this->diagnosis_note = $this->ipassesment_data->diagnosis_note;

            $this->labinvestigation_note = $this->ipassesment_data->labinvestigation_note;
            $this->templabinvestigation_file = $this->ipassesment_data->labinvestigation_file;
            $this->scaninvestigation_note = $this->ipassesment_data->scaninvestigation_note;
            $this->tempscaninvestigation_file = $this->ipassesment_data->scaninvestigation_file;

            $this->xrayinvestigation_note = $this->ipassesment_data->xrayinvestigation_note;
            $this->tempxrayinvestigation_file = $this->ipassesment_data->xrayinvestigation_file;
            $this->prescription_note = $this->ipassesment_data->prescription_note;
            $this->tempprescription_file = $this->ipassesment_data->prescription_file;
            $this->dietadvice_note = $this->ipassesment_data->dietadvice_note;
            $this->doctor_note = $this->ipassesment_data->doctor_note;
            $this->is_labinvestigationemergency = $this->ipassesment_data->labable?->is_emergency ?? false;
            $this->is_scaninvestigationemergency = $this->ipassesment_data->scanable?->is_emergency ?? false;
            $this->is_xrayinvestigationemergency = $this->ipassesment_data->xrayable?->is_emergency ?? false;
            if ($this->ipassesment_data->subprescriptionable) {
                $this->is_prescriptionemergency = $this->ipassesment_data->subprescriptionable->is_emergency;
                $prescriptionlist_data = $this->ipassesment_data->subprescriptionable->prescriptionlist;
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

    public function hydrate()
    {
        $this->dispatch('loadCurrentcomplaintsSelect2Hydrate');
        $this->dispatch('loadPhysicalexamSelect2Hydrate');
        $this->dispatch('loadDiagnosismasterSelect2Hydrate');
        $this->dispatch('loadLabinvestigationSelect2Hydrate');
        $this->dispatch('loadScaninvestigationSelect2Hydrate');
        $this->dispatch('loadXrayinvestigationSelect2Hydrate');
        $this->dispatch('loaddoctorSelect2Hydrate');
    }

    protected function rules()
    {
        return [
            'doctor_id' => 'required',
            // 'doctorspecialization_id' => 'required',
            'currentcomplaint_note' => 'nullable|string|max:250',
            'diagnosis_note' => 'nullable|string|max:250',
            'labinvestigation_note' => 'nullable|string|max:250',
            'scaninvestigation_note' => 'nullable|string|max:250',
            'xrayinvestigation_note' => 'nullable|string|max:250',
            'prescription_note' => 'nullable|string|max:250',
            'dietadvice_note' => 'nullable|string|max:250',
            'doctor_note' => 'nullable|string|max:250',

            'labinvestigation_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'scaninvestigation_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'xrayinvestigation_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'prescription_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

            'is_labinvestigationemergency' => 'required|boolean',
            'is_scaninvestigationemergency' => 'required|boolean',
            'is_xrayinvestigationemergency' => 'required|boolean',

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

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->labinvestigation_file) {
            $validatedData['labinvestigation_file'] = $this->uploadfile($this->ipassesment_data->id ?? null, $this->labinvestigation_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Inpatient\Ipassesment', 'labinvestigation_file');
        } elseif ($this->templabinvestigation_file) {
            $validatedData['labinvestigation_file'] = $this->templabinvestigation_file;
        }
        if ($this->scaninvestigation_file) {
            $validatedData['scaninvestigation_file'] = $this->uploadfile($this->ipassesment_data->id ?? null, $this->scaninvestigation_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Inpatient\Ipassesment', 'scaninvestigation_file');
        } elseif ($this->tempscaninvestigation_file) {
            $validatedData['scaninvestigation_file'] = $this->tempscaninvestigation_file;
        }
        if ($this->xrayinvestigation_file) {
            $validatedData['xrayinvestigation_file'] = $this->uploadfile($this->ipassesment_data->id ?? null, $this->xrayinvestigation_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Inpatient\Ipassesment', 'xrayinvestigation_file');
        } elseif ($this->tempxrayinvestigation_file) {
            $validatedData['xrayinvestigation_file'] = $this->tempxrayinvestigation_file;
        }
        if ($this->prescription_file) {
            $validatedData['prescription_file'] = $this->uploadfile($this->ipassesment_data->id ?? null, $this->prescription_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Inpatient\Ipassesment', 'prescription_file');
        } elseif ($this->tempprescription_file) {
            $validatedData['prescription_file'] = $this->temptempprescription_file;
        }

        try {
            DB::beginTransaction();
            if ($this->ipassesment_data) {
                $ipassesment = $this->ipassesment_data;
                $ipassesment->update($validatedData);
                $this->user->ipassesmentupdatable()->save($ipassesment);

                $this->multiselectsync($ipassesment);

                if ($ipassesment->subprescriptionable) {
                    if ($this->is_prescriptionemergency != $ipassesment->subprescriptionable->is_emergeny) {
                        $ipassesment->subprescriptionable->update(['is_emergency' => $this->is_prescriptionemergency]);
                    }
                    $ipassesment->subprescriptionable->prescriptionlist()->delete();
                    $this->prescriptioncreate($ipassesment->subprescriptionable);
                } else {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->inpatient->patient->id,
                        'doctor_id' => $ipassesment->doctor_id,
                        'maintype' => 'IN PATIENT',
                        'subtype' => $this->inpatient->patientvisit->doctorspecialization->name . ' In Patient',
                        'is_emergency' => $this->is_prescriptionemergency,
                    ]);
                    $this->inpatient->prescriptionable()->save($prescription);
                    $ipassesment->subprescriptionable()->save($prescription);
                    $this->prescriptioncreate($prescription);
                }
                Helper::trackmessage($this->user, $ipassesment, 'patientassesment_createoredit', session()->getId(), 'WEB', 'Patient Assessment Created');

                $this->toaster('success', 'Patient Assessment Updated Successfully!!');
            } else {

                $validatedData['patient_id'] = $this->inpatient->patient->id;
                $validatedData['inpatient_id'] = $this->inpatient->id;
                $validatedData['patientvisit_id'] = $this->inpatient->patientvisit->id;
                $ipassesment = $this->user->ipassesmentcreatable()
                    ->create($validatedData);
                if ($this->prescriptionlist) {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->inpatient->patient->id,
                        'doctor_id' => $ipassesment->doctor_id,
                        'maintype' => 'IN PATIENT',
                        'subtype' => $this->inpatient->patientvisit->doctorspecialization->name . ' In Patient',
                        'is_emergency' => $this->is_prescriptionemergency,
                    ]);
                    $this->inpatient->prescriptionable()->save($prescription);
                    $ipassesment->subprescriptionable()->save($prescription);
                    $this->prescriptioncreate($prescription);
                }

                $this->multiselectsync($ipassesment);

                Helper::trackmessage($this->user, $ipassesment, 'patient_createoredit', session()->getId(), 'WEB', 'Patient Assessment Created');
                $this->toaster('success', 'Patient Assessment Created Successfully!!');
            }

            DB::commit();
            $this->formreset();
            return redirect()->route('ipnursingstationservice', $this->inpatient->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_patient_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_patient_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_patient_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function prescriptioncreate($prescription)
    {
        foreach ($this->prescriptionlist as $key => $eachprescription) {
            $this->user->prescriptionlistcreatable()->create([
                'patient_id' => $this->inpatient->patient->id,
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

    protected function multiselectsync($ipassesment)
    {

        $ipassesment->currentcomplaints()->sync($this->currentcomplaint);
        $ipassesment->diagnosismaster()->sync($this->diagnosismaster);

        $this->labinvestigationsync($this->labinvestigation, $this->user, $this->inpatient->patient_id, $ipassesment, 'IP', 'IP ' . $this->inpatient->patientvisit->doctorspecialization->name, $this->is_labinvestigationemergency);
        $this->scaninvestigationsync($this->scaninvestigation, $this->user, $this->inpatient->patient_id, $ipassesment, 'IP', 'IP ' . $this->inpatient->patientvisit->doctorspecialization->name, $this->is_scaninvestigationemergency);
        $this->xrayinvestigationsync($this->xrayinvestigation, $this->user, $this->inpatient->patient_id, $ipassesment, 'IP', 'IP ' . $this->inpatient->patientvisit->doctorspecialization->name, $this->is_xrayinvestigationemergency);
    }

    public function formreset()
    {
        $this->currentcomplaint = $this->diagnosismaster = $this->labinvestigation = $this->scaninvestigation = $this->xrayinvestigation =
        $this->currentcomplaint_note = $this->diagnosis_note = $this->labinvestigation_note =
        $this->labinvestigation_file = $this->scaninvestigation_note = $this->scaninvestigation_file =
        $this->xrayinvestigation_note = $this->xrayinvestigation_file = $this->prescription_note = $this->prescription_file = $this->is_prescriptionemergency =
        $this->dietadvice_note = $this->doctor_note = $this->doctor_id =
        $this->is_labinvestigationemergency = $this->is_scaninvestigationemergency = $this->is_xrayinvestigationemergency = null;

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.inpatient.ipnursingstation.ipassesment.ipassesmentlivewire');
    }
}
