<?php

namespace App\Http\Livewire\Admin\Inpatient\Inpatientdischarge\Iporthopedicdischarge;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Iporthopedicdischargelivewire extends Component
{
    use miscellaneousLivewireTrait;
    use WithFileUploads;
    use UploadTrait;

    public $user, $inpatient, $doctorlist, $dsorthopedicdata;
    public $doctor_id, $dischargeinitiate_note, $is_billpaid = false,
    $primary_consultants, $consultant, $diagnosis, $drug_allergy, $procedures, $historyofpastillness, $operativesummary, $conditionatdischarge, $casesheet_file, $tempcasesheet_file,
    $generalexamination, $localexamination, $investigations, $courseduringstay, $physioadvice, $adviceondischarge,
    $others, $written_by, $checked_by, $is_patientdischarged = false, $prescription_note, $discharge_date;
    public $followupvisit = [], $patientowndrug = [];
    public $searchquery, $pharmacyproduct, $prescriptionlist = [], $drug_name, $drug_sku;

    public function mount($inpatient_uuid)
    {
        $this->user = auth()->user();
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->doctorlist = Doctor::where('active', true)->get();
        if ($this->inpatient->dsspecialable) {
            $this->dsorthopedicdata = $this->inpatient->dsspecialable;
            $this->doctor_id = $this->dsorthopedicdata->doctor_id;
            $this->dischargeinitiate_note = $this->dsorthopedicdata->dischargeinitiate_note;
            $this->is_billpaid = $this->dsorthopedicdata->is_billpaid;

            $this->primary_consultants = $this->dsorthopedicdata->primary_consultants;
            $this->consultant = $this->dsorthopedicdata->consultant;
            $this->diagnosis = $this->dsorthopedicdata->diagnosis;
            $this->drug_allergy = $this->dsorthopedicdata->drug_allergy;
            $this->procedures = $this->dsorthopedicdata->procedures;
            $this->historyofpastillness = $this->dsorthopedicdata->historyofpastillness;
            $this->operativesummary = $this->dsorthopedicdata->operativesummary;
            $this->conditionatdischarge = $this->dsorthopedicdata->conditionatdischarge;
            $this->tempcasesheet_file = $this->dsorthopedicdata->casesheet_file;
            $this->generalexamination = $this->dsorthopedicdata->generalexamination;
            $this->localexamination = $this->dsorthopedicdata->localexamination;
            $this->investigations = $this->dsorthopedicdata->investigations ?? 'Reports Enclosed.';
            $this->courseduringstay = $this->dsorthopedicdata->courseduringstay;
            $this->physioadvice = $this->dsorthopedicdata->physioadvice;
            $this->adviceondischarge = $this->dsorthopedicdata->adviceondischarge;

            $this->others = $this->dsorthopedicdata->others;
            $this->written_by = $this->dsorthopedicdata->written_by;
            $this->checked_by = $this->dsorthopedicdata->checked_by;

            $this->is_patientdischarged = $this->dsorthopedicdata->is_patientdischarged;

            $this->prescription_note = $this->dsorthopedicdata->prescription_note;
            $this->discharge_date = $this->dsorthopedicdata->discharge_date;
            if ($this->dsorthopedicdata->subprescriptionable) {
                $prescriptionlist_data = $this->dsorthopedicdata->subprescriptionable->prescriptionlist;
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

            if ($this->dsorthopedicdata->patientowndrug) {
                $arr = [];
                foreach (json_decode($this->dsorthopedicdata->patientowndrug) as $key => $value) {
                    array_push($arr, [
                        'drug_name' => $value->drug_name,
                        'duration' => $value->duration,
                        'morning' => $value->morning,
                        'afternoon' => $value->afternoon,
                        'evening' => $value->evening,
                        'night' => $value->night,
                        'before_food' => $value->before_food,
                        'after_food' => $value->after_food,
                    ]);
                }
                $this->patientowndrug = $arr;
            } else {
                $this->patientowndrug[] = [
                    'drug_name' => '',
                    'duration' => '',
                    'morning' => '',
                    'afternoon' => '',
                    'evening' => '',
                    'night' => '',
                    'before_food' => '',
                    'after_food' => '',
                ];
            }

            if ($this->dsorthopedicdata->followupvisit) {
                $arr = [];
                foreach (json_decode($this->dsorthopedicdata->followupvisit) as $key => $value) {
                    array_push($arr, [
                        'scheduledate' => $value->scheduledate,
                        'department' => $value->department,
                        'additionalnote' => $value->additionalnote,
                    ]);
                }
                $this->followupvisit = $arr;
            } else {
                $this->followupvisit[] = [
                    'scheduledate' => '',
                    'department' => '',
                    'additionalnote' => '',
                ];
            }
        }
    }

    protected function rules()
    {
        return [
            'doctor_id' => 'required|numeric',
            'is_billpaid' => 'nullable|boolean',
            'dischargeinitiate_note' => 'required',
            'primary_consultants' => 'nullable',
            'consultant' => 'nullable',
            'diagnosis' => 'nullable',
            'drug_allergy' => 'nullable',
            'procedures' => 'nullable',
            'historyofpastillness' => 'nullable',
            'operativesummary' => 'nullable',
            'conditionatdischarge' => 'nullable',
            'casesheet_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'generalexamination' => 'nullable',
            'localexamination' => 'nullable',
            'investigations' => 'nullable',
            'courseduringstay' => 'nullable',
            'physioadvice' => 'nullable',
            'adviceondischarge' => 'nullable',
            'others' => 'nullable',
            'written_by' => 'nullable',
            'checked_by' => 'nullable',
            'prescription_note' => 'nullable',
            'discharge_date' => 'required_if:is_patientdischarged,true',

            'prescriptionlist.*.drug_name' => 'required',
            'prescriptionlist.*.drug_sku' => 'required',
            'prescriptionlist.*.morning' => 'nullable',
            'prescriptionlist.*.afternoon' => 'nullable',
            'prescriptionlist.*.evening' => 'nullable',
            'prescriptionlist.*.night' => 'nullable',
            'prescriptionlist.*.before_food' => 'nullable',
            'prescriptionlist.*.after_food' => 'nullable',
            'prescriptionlist.*.count' => 'required',

            'patientowndrug.*.drug_name' => 'nullable',
            'patientowndrug.*.duration' => 'nullable',
            'patientowndrug.*.morning' => 'nullable',
            'patientowndrug.*.afternoon' => 'nullable',
            'patientowndrug.*.evening' => 'nullable',
            'patientowndrug.*.night' => 'nullable',
            'patientowndrug.*.before_food' => 'nullable',
            'patientowndrug.*.after_food' => 'nullable',

            'followupvisit.*.scheduledate' => 'required_with:followupvisit.*.department|required_with:followupvisit.*.additionalnote',
            'followupvisit.*.department' => 'required_with:followupvisit.*.scheduledate|required_with:followupvisit.*.additionalnote',
            'followupvisit.*.additionalnote' => 'required_with:followupvisit.*.scheduledate|required_with:followupvisit.*.department',

            'is_patientdischarged' => 'nullable|boolean',
        ];
    }

    protected function messages()
    {
        return [
            'prescriptionlist.*.count.required' => 'Field is required',
            'patientowndrug.*.count.required' => 'Field is required',
            'followupvisit.*.scheduledate.required_with' => 'Field is required',
            'followupvisit.*.department.required_with' => 'Field is required',
            'followupvisit.*.additionalnote.required_with' => 'Field is required',
            'discharge_date.required_if' => 'Field is required',
        ];
    }

    public function hydrate()
    {
        $this->dispatch('loaddoctorSelect2Hydrate');
    }

    public function addfollowup()
    {
        $this->followupvisit[] = [
            'scheduledate' => '',
            'department' => '',
            'additionalnote' => '',
        ];
    }

    public function addpatientowndrug()
    {
        $this->patientowndrug[] = [
            'drug_name' => '',
            'duration' => '',
            'morning' => '',
            'afternoon' => '',
            'evening' => '',
            'night' => '',
            'before_food' => '',
            'after_food' => '',
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

    public function addprescription(Pharmacyproduct $pharmacyproduct)
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

    public function removelineitem($key, $type)
    {
        if ($type == 'prescription') {
            unset($this->prescriptionlist[$key]);
        } elseif ($type == 'patientowndrug') {
            unset($this->patientowndrug[$key]);
        } else {
            unset($this->followupvisit[$key]);
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->casesheet_file) {
            $validatedData['casesheet_file'] = $this->uploadfile($this->dsorthopedicdata->id ?? null, $this->casesheet_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Dischargesummary\Dsorthopedic\Dsorthopedic', 'casesheet_file');
        } else {
            $validatedData['casesheet_file'] = $this->tempcasesheet_file;
        }
        try {
            DB::beginTransaction();
            if ($this->dsorthopedicdata) {
                $validatedData['followupvisit'] = json_encode($validatedData['followupvisit']);
                $validatedData['patientowndrug'] = json_encode($this->patientowndrugcreate());
                $dsorthopedic = $this->dsorthopedicdata;
                $dsorthopedic->update($validatedData);
                $this->user->dsorthopedicupdatable()->save($dsorthopedic);
                if ($dsorthopedic->subprescriptionable) {
                    $dsorthopedic->subprescriptionable->prescriptionlist()->delete();
                    $this->prescriptioncreate($dsorthopedic->subprescriptionable);
                } else {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->inpatient->patient_id,
                        'doctor_id' => $this->inpatient->patientvisit->doctor_id,
                        'maintype' => 'DISCHARGE SUMMARY',
                        'subtype' => 'Orthopedic Discharge Summary',
                    ]);
                    $this->inpatient->prescriptionable()->save($prescription);
                    $dsorthopedic->subprescriptionable()->save($prescription);
                    $this->prescriptioncreate($prescription);
                }
                if ($this->is_patientdischarged) {
                    $this->inpatient->update([
                        'is_patientdischarged' => Carbon::now(),
                    ]);
                    $bedorroomnumber = Bedorroomnumber::find($this->inpatient->ipadmission->bedorroomnumber_id);
                    $bedorroomnumber->update([
                        'is_available' => 2,
                        'bedoccupiable_id' => null,
                        'bedoccupiable_type' => null,
                    ]);
                }
                Helper::trackmessage($this->user, $validatedData, 'dsorthopedic_createoredit', session()->getId(), 'WEB', 'Discharge Summary Updated');
                $this->toaster('success', 'Discharge Summary Updated Successfully!!');
            } else {
                $validatedData['patient_id'] = $this->inpatient->patient->id;
                $validatedData['ipadmission_id'] = $this->inpatient->ipadmission->id;
                $validatedData['inpatient_id'] = $this->inpatient->id;

                $dsorthopedic = $this->user->dsorthopediccreatable()
                    ->create($validatedData);
                $this->inpatient->dsspecialable()->associate($dsorthopedic)
                    ->save();
                if ($this->is_patientdischarged) {
                    $this->inpatient->update([
                        'is_patientdischarged' => Carbon::now(),
                    ]);
                    $bedorroomnumber = Bedorroomnumber::find($this->inpatient->ipadmission->bedorroomnumber_id);
                    $bedorroomnumber->update([
                        'is_available' => 2,
                        'bedoccupiable_id' => null,
                        'bedoccupiable_type' => null,
                    ]);
                }
                Helper::trackmessage($this->user, $dsorthopedic, 'dsorthopedic_createoredit', session()->getId(), 'WEB', 'Discharge Summary Created');
                $this->toaster('success', 'Discharge Summary Created Successfully!!');
            }
            DB::commit();
            if ($this->is_patientdischarged) {
                return redirect()->route('inpatientqueue');
            } else {
                return redirect()->route('inpatientdischarge', $this->inpatient->uuid);
            }
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_dsorthopedic_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_dsorthopedic_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_dsorthopedic_createoredit', 'error_three : ' . $e->getMessage());
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

    protected function patientowndrugcreate()
    {
        $arr = [];
        foreach ($this->patientowndrug as $key => $eachpatientowndrug) {
            array_push($arr, [
                'drug_name' => $eachpatientowndrug['drug_name'],
                'duration' => $eachpatientowndrug['duration'],
                'morning' => $eachpatientowndrug['morning'] == true ? true : false,
                'afternoon' => $eachpatientowndrug['afternoon'] == true ? true : false,
                'evening' => $eachpatientowndrug['evening'] == true ? true : false,
                'night' => $eachpatientowndrug['night'] == true ? true : false,
                'before_food' => $eachpatientowndrug['before_food'] == true ? true : false,
                'after_food' => $eachpatientowndrug['after_food'] == true ? true : false,
            ]);
        }

        return $arr;
    }

    public function printdischargesummary(Inpatient $inpatient)
    {
        $this->dispatch('printdischargesummary', $inpatient->id);
    }

    public function render()
    {
        return view('livewire.admin.inpatient.inpatientdischarge.iporthopedicdischarge.iporthopedicdischargelivewire');
    }
}
