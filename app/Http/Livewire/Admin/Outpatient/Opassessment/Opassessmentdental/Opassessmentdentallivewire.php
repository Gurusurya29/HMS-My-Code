<?php

namespace App\Http\Livewire\Admin\Outpatient\Opassessment\Opassessmentdental;

use App\Http\Livewire\Livewirehelper\Laboratory\labsyncLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Outpatient\Outpatient;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Opassessmentdentallivewire extends Component
{

    use WithFileUploads;
    use UploadTrait;
    use miscellaneousLivewireTrait;
    use labsyncLivewireTrait;

    public $doctor_note;

    public $user, $outpatient, $requesttype;
    public $currentcomplaint_data = [], $physicalexam_data = [], $diagnosismaster_data = [];
    public $currentcomplaint, $physicalexam, $diagnosismaster;
    public $currentcomplaint_note, $physicalexam_note, $diagnosis_note, $treatmentplan_note, $prescription_note, $prescription_file, $tempprescription_file;
    public $searchquery, $pharmacyproduct, $prescriptionlist = [], $drug_name, $drug_sku, $is_prescriptionemergency = false;
    protected $listeners = ['formreset'];

    public $showpimaryteeth = true;
    public $selectalltooth;

    public function hydrate()
    {
        $this->dispatch('loadCurrentcomplaintsSelect2Hydrate');
        $this->dispatch('loadPhysicalexamSelect2Hydrate');
        $this->dispatch('loadDiagnosismasterSelect2Hydrate');
    }

    public function mount($outpatient, $requesttype)
    {
        $this->user = auth()->user();
        $this->outpatient = $outpatient;
        $this->requesttype = $requesttype;

        $this->currentcomplaint_note = $outpatient->patientvisit->complaint_note;
        $this->currentcomplaint_data = Currentcomplaints::where('active', true)->get();
        $this->physicalexam_data = Physicalexam::where('active', true)->get();
        $this->diagnosismaster_data = Diagnosismaster::where('active', true)->get();

        if ($outpatient->specialable) {
            $this->doctor_note = $outpatient->specialable->doctor_note;
            $this->currentcomplaint_note = $outpatient->specialable->currentcomplaint_note;
            $this->physicalexam_note = $outpatient->specialable->physicalexam_note;
            $this->diagnosis_note = $outpatient->specialable->diagnosis_note;

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

    protected function rules()
    {
        return [
            'currentcomplaint_note' => 'nullable|string|max:250',
            'physicalexam_note' => 'nullable|string|max:250',
            'diagnosis_note' => 'nullable|string|max:250',
            'treatmentplan_note' => 'nullable|string|max:250',
            'prescription_note' => 'nullable|string|max:250',
            'prescription_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

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
            'doctor_note' => 'nullable|max:250',
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

    public function store()
    {
        $validatedData = $this->validate();
        if ($this->prescription_file) {
            $validatedData['prescription_file'] = $this->uploadfile($this->outpatient->specialable ? $this->outpatient->specialable->id : null, $this->prescription_file, '/admin/outpatient/' . $this->outpatient->uniqid, 'App\Models\Admin\Outpatient\Dental\Opdental', 'prescription_file');
        } elseif ($this->tempprescription_file) {
            $validatedData['prescription_file'] = $this->temptempprescription_file;
        }
        try {
            DB::beginTransaction();
            if ($this->outpatient->specialable) {
                $opdental = $this->outpatient->specialable;
                $opdental->update($validatedData);
                $this->user->opdentalupdatable()->save($opdental);
                $this->multiselectsync($opdental);

                if ($this->outpatient->prescriptionable) {
                    if ($this->is_prescriptionemergency != $this->outpatient->prescriptionable->is_emergency) {
                        $this->outpatient->prescriptionable->update(['is_emergency' => $this->is_prescriptionemergency]);
                    }
                    $prescription = $this->outpatient->prescriptionable;
                    $prescription->prescriptionlist()->delete();
                    $this->prescriptioncreate($prescription);
                } else {

                    $prescription = $this->user
                        ->prescriptioncreatable()
                        ->create([
                            'patient_id' => $this->outpatient->patient_id,
                            'doctor_id' => $this->outpatient->patientvisit->doctor_id,
                            'maintype' => 'OUT PATIENT',
                            'subtype' => $this->outpatient->doctorspecialization->name . ' Out Patient',
                            'is_emergency' => $this->is_prescriptionemergency,
                        ]);

                    $prescription->prescriptionable()
                        ->associate($this->outpatient)
                        ->subprescriptionable()
                        ->associate($opdental)
                        ->save();

                    $this->prescriptioncreate($prescription);
                }

                Helper::trackmessage($this->user, $opdental, 'patientassesment_createoredit', session()->getId(), 'WEB', 'Patient Assessment Created');

                $this->toaster('success', 'Patient Assessment Updated Successfully!!');
            } else {

                $validatedData['patient_id'] = $this->outpatient->patient_id;
                $validatedData['patientvisit_id'] = $this->outpatient->patientvisit_id;
                $validatedData['doctor_id'] = $this->outpatient->doctor_id;
                $validatedData['doctorspecialization_id'] = $this->outpatient->doctorspecialization_id;

                $opdental = $this->user
                    ->opdentalcreatable()
                    ->create($validatedData);

                $this->user->emrcreatable()->make([
                    'patient_id' => $this->outpatient->patient_id,
                    'doctor_id' => $this->outpatient->patientvisit->doctor_id,
                    'type' => 'Out Patient',
                ])
                    ->emrable()
                    ->associate($this->outpatient)
                    ->save();
                $this->multiselectsync($opdental);
                if ($this->prescriptionlist) {
                    $prescription = $this->user
                        ->prescriptioncreatable()
                        ->create([
                            'patient_id' => $this->outpatient->patient_id,
                            'doctor_id' => $this->outpatient->patientvisit->doctor_id,
                            'maintype' => 'OUT PATIENT',
                            'subtype' => $this->outpatient->doctorspecialization->name . ' Out Patient',
                            'is_emergency' => $this->is_prescriptionemergency,
                        ]);
                    $prescription->prescriptionable()
                        ->associate($this->outpatient)
                        ->subprescriptionable()
                        ->associate($opdental)
                        ->save();

                    $this->prescriptioncreate($prescription);
                }

                $this->outpatient->update([
                    'is_doctorattended' => Carbon::now(),
                ]);
                $this->outpatient->specialable()->associate($opdental)
                    ->save();

                Helper::trackmessage($this->user, $opdental, 'patient_createoredit', session()->getId(), 'WEB', 'Patient Assessment Created');
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

    protected function multiselectsync($opdental)
    {
        $opdental->currentcomplaints()->sync($this->currentcomplaint);
        $opdental->physicalexam()->sync($this->physicalexam);
        $opdental->diagnosismaster()->sync($this->diagnosismaster);
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

    public function updatingShowpimaryteeth()
    {
        if ($this->showpimaryteeth) {
            $this->showpimaryteeth = false;
        } else {
            $this->showpimaryteeth = true;
        }
    }

    public function updatingSelectalltooth()
    {
        if ($this->selectalltooth) {
            $this->selectalltooth = false;
        } else {
            $this->selectalltooth = true;
        }
    }

    public function formreset()
    {

        $this->currentcomplaint = $this->physicalexam = $this->diagnosismaster = $this->prescription_note = $this->prescription_file =
        $this->doctor_note = null;

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.outpatient.opassessment.opassessmentdental.opassessmentdentallivewire');
    }
}
