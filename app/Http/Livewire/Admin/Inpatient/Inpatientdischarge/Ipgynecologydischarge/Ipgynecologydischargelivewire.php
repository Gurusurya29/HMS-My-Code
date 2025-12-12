<?php

namespace App\Http\Livewire\Admin\Inpatient\Inpatientdischarge\Ipgynecologydischarge;

use Carbon\Carbon;
use Livewire\Component;
use App\Traits\UploadTrait;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Miscellaneous\Helper;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;

class Ipgynecologydischargelivewire extends Component
{
    use miscellaneousLivewireTrait;
    use WithFileUploads;
    use UploadTrait;

    public $inpatient, $doctorlist, $dsgynecologydata, $user;
    public $doctor_id, $dischargeinitiate_note, $is_billpaid = false,
    $principaldiagnosis, $riskfactor, $cheifcomplaint, $historyofpresentillness, $historyofpastillness,
    $others, $hospitalizationcourse, $operativesummary, $conditionatdischarge, $casesheet_file, $tempcasesheet_file, $progress, $natureofdelivery, $pih,
    $postnatalperiod, $medicinesgiven, $specialinstruction, $prescription_note, $physicalexamination, $discharge_date, $is_patientdischarged = false, $babyfull_detail;
    public $followupvisit = [], $babydetail = [];
    public $searchquery, $pharmacyproduct, $prescriptionlist = [], $drug_name, $drug_sku;

    public function mount($inpatient_uuid)
    {
        $this->user = auth()->user();
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->doctorlist = Doctor::where('active', true)->get();
        if ($this->inpatient->dsspecialable) {
            $this->dsgynecologydata = $this->inpatient->dsspecialable;
            $this->doctor_id = $this->dsgynecologydata->doctor_id;
            $this->dischargeinitiate_note = $this->dsgynecologydata->dischargeinitiate_note;
            $this->is_billpaid = $this->dsgynecologydata->is_billpaid;
            $this->principaldiagnosis = $this->dsgynecologydata->principaldiagnosis;
            $this->riskfactor = $this->dsgynecologydata->riskfactor;
            $this->cheifcomplaint = $this->dsgynecologydata->cheifcomplaint;
            $this->historyofpresentillness = $this->dsgynecologydata->historyofpresentillness;
            $this->historyofpastillness = $this->dsgynecologydata->historyofpastillness;
            $this->others = $this->dsgynecologydata->others;
            $this->hospitalizationcourse = $this->dsgynecologydata->hospitalizationcourse;
            $this->operativesummary = $this->dsgynecologydata->operativesummary;
            $this->conditionatdischarge = $this->dsgynecologydata->conditionatdischarge;
            $this->tempcasesheet_file = $this->dsgynecologydata->casesheet_file;
            $this->is_patientdischarged = $this->dsgynecologydata->is_patientdischarged;
            $this->progress = $this->dsgynecologydata->progress;
            $this->natureofdelivery = $this->dsgynecologydata->natureofdelivery;
            $this->pih = $this->dsgynecologydata->pih;
            $this->postnatalperiod = $this->dsgynecologydata->postnatalperiod;
            $this->medicinesgiven = $this->dsgynecologydata->medicinesgiven;
            $this->specialinstruction = $this->dsgynecologydata->specialinstruction;
            $this->prescription_note = $this->dsgynecologydata->prescription_note;
            $this->physicalexamination = $this->dsgynecologydata->physicalexamination;
            $this->discharge_date = $this->dsgynecologydata->discharge_date;
            $this->babyfull_detail = $this->dsgynecologydata->dsgynecologybaby?->babyfull_detail;

            if ($this->dsgynecologydata->subprescriptionable) {
                $prescriptionlist_data = $this->dsgynecologydata->subprescriptionable->prescriptionlist;
                $prescriptionarr = [];
                foreach ($prescriptionlist_data as $key => $value) {
                    array_push($prescriptionarr, [
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

                $this->prescriptionlist = $prescriptionarr;
            }

            if ($this->dsgynecologydata->babydetail) {
                $babydetailarr = [];
                foreach (json_decode($this->dsgynecologydata->babydetail) as $key => $value) {
                    array_push($babydetailarr, [
                        'gender' => $value->gender,
                        'weight' => $value->weight,
                        'apgar' => $value->apgar,
                        'dateandtime' => $value->dateandtime,
                    ]);
                }
                $this->babydetail = $babydetailarr;
            } else {
                $this->babydetail[] = [
                    'gender' => '',
                    'weight' => '',
                    'apgar' => '',
                    'dateandtime' => '',
                ];
            }

            if ($this->dsgynecologydata->followupvisit) {
                $followupvisitarr = [];
                foreach (json_decode($this->dsgynecologydata->followupvisit) as $key => $value) {
                    array_push($followupvisitarr, [
                        'scheduledate' => $value->scheduledate,
                        'department' => $value->department,
                        'additionalnote' => $value->additionalnote,
                    ]);
                }
                $this->followupvisit = $followupvisitarr;
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
            'progress' => 'nullable',
            'natureofdelivery' => 'nullable',
            'pih' => 'nullable',
            'postnatalperiod' => 'nullable',
            'medicinesgiven' => 'nullable',
            'specialinstruction' => 'nullable',
            'prescription_note' => 'nullable',
            'physicalexamination' => 'nullable',
            'discharge_date' => 'required_if:is_patientdischarged,true',
            'is_patientdischarged' => 'nullable|boolean',

            'prescriptionlist.*.drug_name' => 'required',
            'prescriptionlist.*.drug_sku' => 'required',
            'prescriptionlist.*.morning' => 'nullable',
            'prescriptionlist.*.afternoon' => 'nullable',
            'prescriptionlist.*.evening' => 'nullable',
            'prescriptionlist.*.night' => 'nullable',
            'prescriptionlist.*.before_food' => 'nullable',
            'prescriptionlist.*.after_food' => 'nullable',
            'prescriptionlist.*.count' => 'required',

            'babydetail.*.gender' => 'required_with:babydetail.*.weight|required_with:babydetail.*.apgar|required_with:babydetail.*.dateandtime',
            'babydetail.*.weight' => 'required_with:babydetail.*.gender|required_with:babydetail.*.apgar|required_with:babydetail.*.dateandtime',
            'babydetail.*.apgar' => 'required_with:babydetail.*.gender|required_with:babydetail.*.weight|required_with:babydetail.*.dateandtime',
            'babydetail.*.dateandtime' => 'required_with:babydetail.*.gender|required_with:babydetail.*.weight|required_with:babydetail.*.apgar',

            'babyfull_detail' => 'nullable',

            'followupvisit.*.scheduledate' => 'required_with:followupvisit.*.department|required_with:followupvisit.*.additionalnote',
            'followupvisit.*.department' => 'required_with:followupvisit.*.scheduledate|required_with:followupvisit.*.additionalnote',
            'followupvisit.*.additionalnote' => 'required_with:followupvisit.*.scheduledate|required_with:followupvisit.*.department',
        ];
    }

    protected function messages()
    {
        return [
            'prescriptionlist.*.count.required' => 'Field is required',
            'followupvisit.*.scheduledate.required_with' => 'Field is required',
            'followupvisit.*.department.required_with' => 'Field is required',
            'followupvisit.*.additionalnote.required_with' => 'Field is required',
            'babydetail.*.gender.required_with' => 'Field is required',
            'babydetail.*.weight.required_with' => 'Field is required',
            'babydetail.*.apgar.required_with' => 'Field is required',
            'babydetail.*.dateandtime.required_with' => 'Field is required',
            'discharge_date.required_if' => 'Field is required',
        ];
    }

    public function hydrate()
    {
        $this->dispatch('loaddoctorSelect2Hydrate');
    }

    public function addbabydetail()
    {
        $this->babydetail[] = [
            'gender' => '',
            'weight' => '',
            'apgar' => '',
            'dateandtime' => '',
        ];
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
        } elseif ($type == 'babydetail') {
            unset($this->babydetail[$key]);
        } else {
            unset($this->followupvisit[$key]);
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->casesheet_file) {
            $validatedData['casesheet_file'] = $this->uploadfile($this->dsgynecologydata->id ?? null, $this->casesheet_file, '/admin/ipassesment/' . $this->inpatient->uniqid, 'App\Models\Admin\Dischargesummary\Dsgynecology\Dsgynecology', 'casesheet_file');
        } else {
            $validatedData['casesheet_file'] = $this->tempcasesheet_file;
        }
        try {
            DB::beginTransaction();
            if ($this->dsgynecologydata) {
                $validatedData['babydetail'] = json_encode($validatedData['babydetail']);
                $validatedData['followupvisit'] = json_encode($validatedData['followupvisit']);
                $dsgynecology = $this->dsgynecologydata;
                $dsgynecology->update($validatedData);
                $this->user->dsgynecologyupdatable()->save($dsgynecology);
                // Dsgynecology Baby
                if ($dsgynecology->dsgynecologybaby) {
                    $dsgynecology->dsgynecologybaby->update([
                        'babyfull_detail' => $validatedData['babyfull_detail'],
                    ]);
                    $this->user->dsgynecologybabyupdatable()->save($dsgynecology->dsgynecologybaby);
                } else {
                    $dsgynecologybaby = $this->user->dsgynecologybabycreatable()
                        ->create([
                            'dsgynecology_id' => $dsgynecology->id,
                            'babyfull_detail' => $validatedData['babyfull_detail'],
                        ]);
                }

                if ($dsgynecology->subprescriptionable) {
                    $dsgynecology->subprescriptionable->prescriptionlist()->delete();
                    $this->prescriptioncreate($dsgynecology->subprescriptionable);
                } else {
                    $prescription = $this->user->prescriptioncreatable()->create([
                        'patient_id' => $this->inpatient->patient_id,
                        'doctor_id' => $this->inpatient->patientvisit->doctor_id,
                        'maintype' => 'DISCHARGE SUMMARY',
                        'subtype' => 'Gynecology Discharge Summary',
                    ]);
                    $this->inpatient->prescriptionable()->save($prescription);
                    $dsgynecology->subprescriptionable()->save($prescription);
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
                Helper::trackmessage($this->user, $dsgynecology, 'dsgynecology_createoredit', session()->getId(), 'WEB', 'Discharge Summary Updated');
                $this->toaster('success', 'Discharge Summary Updated Successfully!!');
            } else {
                $validatedData['patient_id'] = $this->inpatient->patient->id;
                $validatedData['ipadmission_id'] = $this->inpatient->ipadmission->id;
                $validatedData['inpatient_id'] = $this->inpatient->id;

                $dsgynecology = $this->user->dsgynecologycreatable()
                    ->create($validatedData);
                $this->inpatient->dsspecialable()->associate($dsgynecology)
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
                Helper::trackmessage($this->user, $dsgynecology, 'dsgynecology_createoredit', session()->getId(), 'WEB', 'Discharge Summary Created');
                $this->toaster('success', 'Discharge Summary Created Successfully!!');
            }
            DB::commit();
            if ($this->is_patientdischarged) {
                return redirect()->route('inpatientqueue');
            } else {
                return redirect()->route('inpatientdischarge', $this->inpatient->uuid);
            }
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_dsgynecology_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_dsgynecology_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_dsgynecology_createoredit', 'error_three : ' . $e->getMessage());
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
        return view('livewire.admin.inpatient.inpatientdischarge.ipgynecologydischarge.ipgynecologydischargelivewire');
    }
}
