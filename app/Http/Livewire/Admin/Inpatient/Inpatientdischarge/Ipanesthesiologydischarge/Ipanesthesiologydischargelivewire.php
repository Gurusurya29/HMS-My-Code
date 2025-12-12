<?php

namespace App\Http\Livewire\Admin\Inpatient\Inpatientdischarge\Ipanesthesiologydischarge;

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

class Ipanesthesiologydischargelivewire extends Component
{
    use miscellaneousLivewireTrait;
    use WithFileUploads;
    use UploadTrait;

    public $inpatient, $doctorlist, $dsanesthesiologydata, $user;
    public $doctor_id, $dischargeinitiate_note, $is_billpaid = false,
    $principaldiagnosis, $riskfactor, $cheifcomplaint, $historyofpresentillness, $historyofpastillness,
    $others, $hospitalizationcourse, $operativesummary, $conditionatdischarge, $casesheet_file, $tempcasesheet_file, $prescription_note, $specialinstruction, $physicalexamination, $discharge_date, $is_patientdischarged = false;
    public $followupvisit = [];
    public $searchquery, $pharmacyproduct, $prescriptionlist = [], $drug_name, $drug_sku;

    public function mount($inpatient_uuid)
    {
        $this->user = auth()->user();
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->doctorlist = Doctor::where('active', true)->get();
        if ($this->inpatient->dsspecialable) {
            $this->dsanesthesiologydata = $this->inpatient->dsspecialable;
            $this->doctor_id = $this->dsanesthesiologydata->doctor_id;
            $this->dischargeinitiate_note = $this->dsanesthesiologydata->dischargeinitiate_note;
            $this->is_billpaid = $this->dsanesthesiologydata->is_billpaid;
            $this->principaldiagnosis = $this->dsanesthesiologydata->principaldiagnosis;
            $this->riskfactor = $this->dsanesthesiologydata->riskfactor;
            $this->cheifcomplaint = $this->dsanesthesiologydata->cheifcomplaint;
            $this->historyofpresentillness = $this->dsanesthesiologydata->historyofpresentillness;
            $this->historyofpastillness = $this->dsanesthesiologydata->historyofpastillness;
            $this->others = $this->dsanesthesiologydata->others;
            $this->hospitalizationcourse = $this->dsanesthesiologydata->hospitalizationcourse;
            $this->operativesummary = $this->dsanesthesiologydata->operativesummary;
            $this->conditionatdischarge = $this->dsanesthesiologydata->conditionatdischarge;
            $this->tempcasesheet_file = $this->dsanesthesiologydata->casesheet_file;
            $this->specialinstruction = $this->dsanesthesiologydata->specialinstruction;
            $this->physicalexamination = $this->dsanesthesiologydata->physicalexamination;
            $this->prescription_note = $this->dsanesthesiologydata->prescription_note;
            $this->discharge_date = $this->dsanesthesiologydata->discharge_date;
            $this->is_patientdischarged = $this->dsanesthesiologydata->is_patientdischarged;

            if ($this->dsanesthesiologydata->subprescriptionable) {
                $prescriptionlist_data = $this->dsanesthesiologydata->subprescriptionable->prescriptionlist;
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

            if ($this->dsanesthesiologydata->followupvisit) {
                $arr = [];
                foreach (json_decode($this->dsanesthesiologydata->followupvisit) as $key => $value) {
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
            'principaldiagnosis' => 'nullable',
            'riskfactor' => 'nullable',
            'cheifcomplaint' => 'nullable',
            'historyofpresentillness' => 'nullable',
            'historyofpastillness' => 'nullable',
            'others' => 'nullable',
            'hospitalizationcourse' => 'nullable',
            'operativesummary' => 'nullable',
            'conditionatdischarge' => 'nullable',
            'casesheet_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'specialinstruction' => 'nullable',
            'prescription_note' => 'nullable',
            'physicalexamination' => 'nullable',
            'discharge_date' => 'required_if:is_patientdischarged,true',
            'prescription_note' => 'nullable',

            'prescriptionlist.*.drug_name' => 'required',
            'prescriptionlist.*.drug_sku' => 'required',
            'prescriptionlist.*.morning' => 'nullable',
            'prescriptionlist.*.afternoon' => 'nullable',
            'prescriptionlist.*.evening' => 'nullable',
            'prescriptionlist.*.night' => 'nullable',
            'prescriptionlist.*.before_food' => 'nullable',
            'prescriptionlist.*.after_food' => 'nullable',
            'prescriptionlist.*.count' => 'required',

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
        } else {
            unset($this->followupvisit[$key]);
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->casesheet_file) {
            $validatedData['casesheet_file'] = $this->uploadfile($this->dsanesthesiologydata->id ?? null, $this->casesheet_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Dischargesummary\Dsanesthesiology\Dsanesthesiology', 'casesheet_file');
        } else {
            $validatedData['casesheet_file'] = $this->tempcasesheet_file;
        }
        try {
            DB::beginTransaction();
            if ($this->dsanesthesiologydata) {
                $validatedData['followupvisit'] = json_encode($validatedData['followupvisit']);
                $dsanesthesiology = $this->dsanesthesiologydata;
                $dsanesthesiology->update($validatedData);
                $this->user->dsanesthesiologyupdatable()->save($dsanesthesiology);

                if ($dsanesthesiology->subprescriptionable) {
                    $dsanesthesiology->subprescriptionable->prescriptionlist()->delete();
                    $this->prescriptioncreate($dsanesthesiology->subprescriptionable);
                } else {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->inpatient->patient_id,
                        'doctor_id' => $this->inpatient->patientvisit->doctor_id,
                        'maintype' => 'DISCHARGE SUMMARY',
                        'subtype' => 'Urology Discharge Summary',
                    ]);
                    $this->inpatient->prescriptionable()->save($prescription);
                    $dsanesthesiology->subprescriptionable()->save($prescription);
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
                Helper::trackmessage($this->user, $dsanesthesiology, 'dsanesthesiology_createoredit', session()->getId(), 'WEB', 'Discharge Summary Updated');
                $this->toaster('success', 'Discharge Summary Updated Successfully!!');
            } else {
                $validatedData['patient_id'] = $this->inpatient->patient->id;
                $validatedData['ipadmission_id'] = $this->inpatient->ipadmission->id;
                $validatedData['inpatient_id'] = $this->inpatient->id;
                $dsanesthesiology = $this->user->dsanesthesiologycreatable()
                    ->create($validatedData);
                $this->inpatient->dsspecialable()->associate($dsanesthesiology)
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

                Helper::trackmessage($this->user, $dsanesthesiology, 'dsanesthesiology_createoredit', session()->getId(), 'WEB', 'Discharge Summary Created');
                $this->toaster('success', 'Discharge Summary Created Successfully!!');
            }
            DB::commit();
            if ($this->is_patientdischarged) {
                return redirect()->route('inpatientqueue');
            } else {
                return redirect()->route('inpatientdischarge', $this->inpatient->uuid);
            }
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_dsanesthesiology_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_dsanesthesiology_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_dsanesthesiology_createoredit', 'error_three : ' . $e->getMessage());
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

    public function printdischargesummary(Inpatient $inpatient)
    {
        $this->dispatch('printdischargesummary', $inpatient->id);
    }

    public function render()
    {
        return view('livewire.admin.inpatient.inpatientdischarge.ipanesthesiologydischarge.ipanesthesiologydischargelivewire');
    }
}
