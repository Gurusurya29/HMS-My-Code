<?php

// namespace App\Http\Livewire\Admin\Inpatient\Inpatientadmission\Inpatientadmissiongeneral;
// namespace App\Http\Livewire\Admin\Inpatient\Inpatientadmission\Inpatientadmissiongeneral;
namespace App\Http\Livewire\Admin\Inpatient\Inpatientadmission\Inpatientadmissiongeneral;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Miscellaneous\Helper;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Account\Hospital\Hospitalstatement;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Billing\Ipbilling\Ipbillingservicelist;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;

class InpatientAdmissionGeneralLivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $inpatient, $admission_date;
    public $salutation, $name, $last_name, $phone, $email, $gender, $age, $dob, $aadharid, $parentorguardian;
    public $ipadmission_id, $doctorspecialization_id, $attender_name, $attender_relationship, $attender_phone, $marital_status, $spouse_name, $door_no, $area, $city, $pincode,
    $country_id, $state_id, $patient_hospital_id, $is_foreigner = false, $note,
    $is_hospitalemployee = false, $hospitalemployee_uniqid, $reference_id, $wardtype_id, $bedorroomnumber_id;
    public $passport, $visa_details, $visa_expirydate, $indian_contactperson, $indian_contactphone,
    $foreign_contactperson, $foreign_contactphone, $lang_knowntopatient, $lang_knowntocaretaker;
    public $countrylist = [], $statelist = [], $referencelist = [], $wardtype_data = [], $bedorroomnumber_data = [], $doctorspecialization_data = [], $insurancecompany_data = [];
    public $billing_type, $insurancecompany_id, $tpaname_id, $tpaidno, $policyno;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'salutation' => 'nullable|numeric',
            'name' => 'required|string|max:70',
            'last_name' => 'nullable|string|max:70',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'gender' => 'required|numeric|not_in:0',
            'age' => 'required|max:150',
            'dob' => 'nullable|date',
            'admission_date' => 'required|date',
            'aadharid' => 'nullable|numeric|digits:12',
            'parentorguardian' => 'nullable|string|max:150',
            'country_id' => 'nullable|numeric',
            'state_id' => 'nullable|numeric',
            'reference_id' => 'nullable|numeric',
            'marital_status' => 'nullable|numeric',
            'spouse_name' => 'nullable|string|max:70',
            'door_no' => 'nullable|string|max:70',
            'area' => 'nullable|string|max:70',
            'city' => 'nullable|string|max:70',
            'pincode' => 'nullable|numeric|digits:6',
            'doctorspecialization_id' => 'required|numeric',
            'attender_name' => 'required',
            'attender_relationship' => 'required',
            'attender_phone' => 'required',
            'is_hospitalemployee' => 'nullable|boolean',
            'hospitalemployee_uniqid' => 'required_if:is_hospitalemployee,1',
            'is_foreigner' => 'nullable|boolean',
            'wardtype_id' => 'required',
            'bedorroomnumber_id' => 'required',

            'passport' => 'required_if:is_foreigner,1',
            'visa_details' => 'required_if:is_foreigner,1',
            'visa_expirydate' => 'required_if:is_foreigner,1',
            'indian_contactperson' => 'required_if:is_foreigner,1',
            'indian_contactphone' => 'required_if:is_foreigner,1',
            'foreign_contactperson' => 'required_if:is_foreigner,1',
            'foreign_contactphone' => 'required_if:is_foreigner,1',
            'lang_knowntopatient' => 'required_if:is_foreigner,1',
            'lang_knowntocaretaker' => 'required_if:is_foreigner,1',

            'billing_type' => 'nullable|numeric',
            'insurancecompany_id' => 'nullable|numeric',
            'tpaname_id' => 'nullable|numeric',
            'tpaidno' => 'nullable|string|max:70',
            'policyno' => 'nullable|string|max:70',

            'note' => 'nullable|max:255',

        ];
    }

    public function mount($inpatient_uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->countrylist = Country::where('active', true)->pluck('name', 'id');
        $this->statelist = State::where('active', true)->pluck('name', 'id');
        $this->referencelist = Reference::where('active', true)->pluck('name', 'id');
        $this->insurancecompany_data = Insurancecompany::where('active', true)->pluck('name', 'id');
        $this->country_id = Country::where('code', 'IN')->first()->id;
        $this->state_id = State::where('code', 'TN')->first()->id;
        $this->wardtype_data = Wardtype::where('active', true)->where('ward_category', 1)->pluck('name', 'id');
        $this->doctorspecialization_data = Doctorspecialization::where('active', true)->pluck('name', 'id');
        if ($this->inpatient->ipadmission) {
            $ipadmission = $this->inpatient->ipadmission;
            $this->salutation = $ipadmission->salutation;
            $this->name = $ipadmission->name;
            $this->last_name = $ipadmission->last_name;
            $this->phone = $ipadmission->phone;
            $this->email = $ipadmission->email;
            $this->gender = $ipadmission->gender;
            $this->age = $ipadmission->age;
            $this->dob = $ipadmission->dob;
            $this->admission_date = $ipadmission->admission_date;
            $this->aadharid = $ipadmission->aadharid;
            $this->parentorguardian = $ipadmission->parentorguardian;
            $this->marital_status = $ipadmission->marital_status;
            $this->spouse_name = $ipadmission->spouse_name;
            $this->door_no = $ipadmission->door_no;
            $this->area = $ipadmission->area;
            $this->city = $ipadmission->city;
            $this->pincode = $ipadmission->pincode;
            $this->country_id = $ipadmission->country_id;
            $this->state_id = $ipadmission->state_id;
            $this->reference_id = $ipadmission->reference_id;
            $this->doctorspecialization_id = $ipadmission->doctorspecialization_id;
            $this->ipadmission_id = $ipadmission->id;
            $this->attender_name = $ipadmission->attender_name;
            $this->attender_relationship = $ipadmission->attender_relationship;
            $this->attender_phone = $ipadmission->attender_phone;
            $this->is_hospitalemployee = $ipadmission->is_hospitalemployee;
            $this->hospitalemployee_uniqid = $ipadmission->hospitalemployee_uniqid;
            $this->is_foreigner = $ipadmission->is_foreigner;
            $this->note = $ipadmission->note;

            $this->wardtype_id = $ipadmission->wardtype_id;
            $this->bedorroomnumber_id = $ipadmission->bedorroomnumber_id;

            $this->passport = $ipadmission->ipforeigner?->passport;
            $this->visa_details = $ipadmission->ipforeigner?->visa_details;
            $this->visa_expirydate = $ipadmission->ipforeigner?->visa_expirydate;
            $this->indian_contactperson = $ipadmission->ipforeigner?->indian_contactperson;
            $this->indian_contactphone = $ipadmission->ipforeigner?->indian_contactphone;
            $this->foreign_contactperson = $ipadmission->ipforeigner?->foreign_contactperson;
            $this->foreign_contactphone = $ipadmission->ipforeigner?->foreign_contactphone;
            $this->lang_knowntopatient = $ipadmission->ipforeigner?->lang_knowntopatient;
            $this->lang_knowntocaretaker = $ipadmission->ipforeigner?->lang_knowntocaretaker;

            $this->billing_type = $ipadmission->billing_type;
            $this->insurancecompany_id = $ipadmission->patientinsurance?->insurancecompany_id;
            $this->tpaname_id = $ipadmission->patientinsurance?->tpaname_id;
            $this->tpaidno = $ipadmission->patientinsurance?->tpaidno;
            $this->policyno = $ipadmission->patientinsurance?->policyno;
        } else {
            $this->salutation = $this->inpatient->patient->salutation;
            $this->name = $this->inpatient->patient->name;
            $this->last_name = $this->inpatient->patient->last_name;
            $this->phone = $this->inpatient->patient->phone;
            $this->email = $this->inpatient->patient->email;
            $this->gender = $this->inpatient->patient->gender;
            $this->age = $this->inpatient->patient->age;
            $this->dob = $this->inpatient->patient->dob;
            $this->admission_date = Carbon::now()->format('Y-m-d H:i');
            $this->aadharid = $this->inpatient->patient->aadharid;
            $this->parentorguardian = $this->inpatient->patient->parentorguardian;
            $this->marital_status = $this->inpatient->patient->marital_status;
            $this->spouse_name = $this->inpatient->patient->spouse_name;
            $this->door_no = $this->inpatient->patient->door_no;
            $this->area = $this->inpatient->patient->area;
            $this->city = $this->inpatient->patient->city;
            $this->pincode = $this->inpatient->patient->pincode;
            $this->country_id = $this->inpatient->patient->country_id;
            $this->state_id = $this->inpatient->patient->state_id;
            $this->reference_id = $this->inpatient->patient->reference_id;
            $this->doctorspecialization_id = $this->inpatient->patientvisit->doctorspecialization_id;
            $this->wardtype_id = $this->inpatient->patientvisit->wardtype_id;

            $this->billing_type = $this->inpatient->patientvisit->billing_type;
            $this->insurancecompany_id = $this->inpatient->patientvisit?->insurancecompany_id;
            $this->tpaname_id = $this->inpatient->patientvisit?->tpaname_id;
            $this->tpaidno = $this->inpatient->patientvisit?->tpaidno;
            $this->policyno = $this->inpatient->patientvisit?->policyno;
        }

        if ($this->wardtype_id) {
            $this->bedorroomnumber_data = Bedorroomnumber::where('active', true)
                ->where('is_available', 0)
                ->where('wardtype_id', $this->wardtype_id)
                ->pluck('name', 'id');
        }

    }

    public function Updatedwardtypeid()
    {
        $this->bedorroomnumber_data = Bedorroomnumber::where('active', true)
            ->where('is_available', 0)
            ->where('wardtype_id', $this->wardtype_id)
            ->pluck('name', 'id');
    }

    public function store()
    {

        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();

            $admissionvalidate['patient_id'] = $this->inpatient->patient_id;
            $admissionvalidate['patientvisit_id'] = $this->inpatient->patientvisit->id;
            $admissionvalidate['inpatient_id'] = $this->inpatient->id;
            $admissionvalidate['salutation'] = $validatedData['salutation'];
            $admissionvalidate['name'] = $validatedData['name'];
            $admissionvalidate['last_name'] = $validatedData['last_name'];
            $admissionvalidate['phone'] = $validatedData['phone'];
            $admissionvalidate['email'] = $validatedData['email'];
            $admissionvalidate['gender'] = $validatedData['gender'];
            $admissionvalidate['age'] = $validatedData['age'];
            $admissionvalidate['dob'] = $validatedData['dob'];
            $admissionvalidate['admission_date'] = $validatedData['admission_date'];
            $admissionvalidate['aadharid'] = $validatedData['aadharid'];
            $admissionvalidate['parentorguardian'] = $validatedData['parentorguardian'];
            $admissionvalidate['marital_status'] = $validatedData['marital_status'];
            $admissionvalidate['spouse_name'] = $validatedData['spouse_name'];
            $admissionvalidate['door_no'] = $validatedData['door_no'];
            $admissionvalidate['area'] = $validatedData['area'];
            $admissionvalidate['city'] = $validatedData['city'];
            $admissionvalidate['pincode'] = $validatedData['pincode'];
            $admissionvalidate['country_id'] = $validatedData['country_id'];
            $admissionvalidate['state_id'] = $validatedData['state_id'];
            $admissionvalidate['reference_id'] = $validatedData['reference_id'];
            $admissionvalidate['doctorspecialization_id'] = $validatedData['doctorspecialization_id'];
            $admissionvalidate['attender_name'] = $validatedData['attender_name'];
            $admissionvalidate['attender_relationship'] = $validatedData['attender_relationship'];
            $admissionvalidate['attender_phone'] = $validatedData['attender_phone'];
            $admissionvalidate['is_hospitalemployee'] = $validatedData['is_hospitalemployee'];
            $admissionvalidate['hospitalemployee_uniqid'] = $validatedData['hospitalemployee_uniqid'];
            $admissionvalidate['note'] = $validatedData['note'];
            $admissionvalidate['is_foreigner'] = $validatedData['is_foreigner'];
            $admissionvalidate['wardtype_id'] = $validatedData['wardtype_id'];
            $admissionvalidate['bedorroomnumber_id'] = $validatedData['bedorroomnumber_id'];
            $admissionvalidate['billing_type'] = $validatedData['billing_type'];
            if ($this->billing_type == 2) {
                $admissionvalidate['is_insurance'] = true;

            } else {
                $admissionvalidate['is_insurance'] = false;
            }

            $foreignervalidate['patient_id'] = $this->inpatient->patient_id;
            $foreignervalidate['inpatient_id'] = $this->inpatient->id;
            $foreignervalidate['passport'] = $validatedData['passport'];
            $foreignervalidate['visa_details'] = $validatedData['visa_details'];
            $foreignervalidate['visa_expirydate'] = $validatedData['visa_expirydate'];
            $foreignervalidate['indian_contactperson'] = $validatedData['indian_contactperson'];
            $foreignervalidate['indian_contactphone'] = $validatedData['indian_contactphone'];
            $foreignervalidate['foreign_contactperson'] = $validatedData['foreign_contactperson'];
            $foreignervalidate['foreign_contactphone'] = $validatedData['foreign_contactphone'];
            $foreignervalidate['lang_knowntopatient'] = $validatedData['lang_knowntopatient'];
            $foreignervalidate['lang_knowntocaretaker'] = $validatedData['lang_knowntocaretaker'];

            $insurancevalidate['insurancecompany_id'] = $validatedData['insurancecompany_id'];
            $insurancevalidate['tpaname_id'] = $validatedData['tpaname_id'];
            $insurancevalidate['tpaidno'] = $validatedData['tpaidno'];
            $insurancevalidate['policyno'] = $validatedData['policyno'];

            if ($this->ipadmission_id) {
                $ipadmission = Ipadmission::find($this->ipadmission_id);
                $this->ipselfinsurance($ipadmission);
                $ipadmission->update($admissionvalidate);
                $user->ipadmissionupdatable()->save($ipadmission);
                if ($ipadmission->ipforeigner) {
                    $foreignervalidate['ipadmission_id'] = $ipadmission->id;
                    $ipadmission->ipforeigner->update($foreignervalidate);
                    $user->ipforeignerupdatable()->save($ipadmission->ipforeigner);
                    Helper::trackmessage($user, $ipadmission->ipforeigner, 'ipforeigner_createoredit', session()->getId(), 'WEB', 'Patient Admission foreigner Updated');

                } elseif ($this->is_foreigner && ($ipadmission->patientinsurance == null)) {
                    $foreignervalidate['ipadmission_id'] = $ipadmission->id;
                    $ipforeigner = $user->ipforeignercreatable()
                        ->create($foreignervalidate);
                    Helper::trackmessage($user, $ipforeigner, 'ipforeigner_createoredit', session()->getId(), 'WEB', 'Patient Admission foreigner Created');

                }
                if ($ipadmission->patientinsurance != null && $this->billing_type == 2) {
                    $insurancevalidate['active'] = true;
                    $ipadmission->patientinsurance->update($insurancevalidate);
                    $user->patientinsuranceupdatable()->save($ipadmission->patientinsurance);
                    Helper::trackmessage($user, $ipadmission->patientinsurance, 'patientinsurance_createoredit', session()->getId(), 'WEB', 'Patient Insurance Updated');
                } elseif (($this->billing_type == 2) && ($ipadmission->patientinsurance == null)) {
                    $insurancevalidate['patient_id'] = $this->inpatient->patient_id;
                    $insurancevalidate['inpatient_id'] = $this->inpatient->id;
                    $insurancevalidate['ipadmission_id'] = $ipadmission->id;
                    $insurancevalidate['stage'] = 0;
                    $patientinsurance = $user->patientinsurancecreatable()
                        ->create($insurancevalidate);
                    Helper::trackmessage($user, $patientinsurance, 'patientinsurance_createoredit', session()->getId(), 'WEB', 'Patient Insurance Created');
                } elseif (($this->billing_type != 2) && $ipadmission->patientinsurance != null) {
                    $ipadmission->patientinsurance->update(['active' => false]);
                    $user->patientinsuranceupdatable()->save($ipadmission->patientinsurance);
                }

                Helper::trackmessage($user, $ipadmission, 'ipadmission_createoredit', session()->getId(), 'WEB', 'Patient Admission Updated');
                $this->toaster('success', 'Patient Admission Updated Successfully!!');
            } else {
                $ipadmission = $user->ipadmissioncreatable()
                    ->create($admissionvalidate);
                $user->emrcreatable()->make([
                    'patient_id' => $this->inpatient->patient_id,
                    'doctor_id' => $this->inpatient->patientvisit->doctor_id,
                    'type' => 'In Patient',
                ])
                    ->emrable()
                    ->associate($this->inpatient)
                    ->save();

                if ($ipadmission->bedorroomnumber_id) {
                    $bedorroomnumber = Bedorroomnumber::find($ipadmission->bedorroomnumber_id);
                    $bedorroomnumber->update(['is_available' => 1]);
                    $ipadmission->bedoccupiable()->save($bedorroomnumber);
                }

                if ($this->is_foreigner) {
                    $foreignervalidate['ipadmission_id'] = $ipadmission->id;
                    $ipforeigner = $user->ipforeignercreatable()
                        ->create($foreignervalidate);
                    Helper::trackmessage($user, $ipforeigner, 'ipforeigner_createoredit', session()->getId(), 'WEB', 'Patient Admission foreigner Created');
                }

                if ($this->billing_type == 2) {
                    $insurancevalidate['patient_id'] = $this->inpatient->patient_id;
                    $insurancevalidate['inpatient_id'] = $this->inpatient->id;
                    $insurancevalidate['ipadmission_id'] = $ipadmission->id;
                    $insurancevalidate['stage'] = 0;
                    $patientinsurance = $user->patientinsurancecreatable()
                        ->create($insurancevalidate);
                    Helper::trackmessage($user, $patientinsurance, 'patientinsurance_createoredit', session()->getId(), 'WEB', 'Patient Insurance Created');
                }

                $ipbilling = $user->ipbillingcreatable()
                    ->create([
                        'patient_id' => $ipadmission->patient_id,
                        'patientvisit_id' => $ipadmission->patientvisit_id,
                        'inpatient_id' => $ipadmission->inpatient_id,
                        'ipadmission_id' => $ipadmission->id,
                        'total' => 0,
                        'discount' => 0,
                        'sub_total' => 0,
                        'billdiscount_amount' => 0,
                        'grand_total' => 0,
                    ]);

                $ipadmission->update(['ipbilling_id' => $ipbilling->id]);
                Helper::trackmessage($user, $ipadmission, 'ipadmission_createoredit', session()->getId(), 'WEB', 'Patient Admission Created');
                $this->toaster('success', 'Patient Admission Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            return redirect()->route('inpatientqueue');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_ipadmission_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_ipadmission_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_ipadmission_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function ipselfinsurance($ipadmission)
    {
        // Self or Insurance Logic
        if ($this->billing_type != $ipadmission->billing_type) {
            $patientstatementlist = Patientstatement::where('active', true)->where('transaction_type', 'D')->where('ipbilling_id', $ipadmission->ipbilling_id)->get();
            $hospitalstatementlist = Hospitalstatement::where('active', true)->where('transaction_type', 'D')->where('ipbilling_id', $ipadmission->ipbilling_id)->get();
            $ipbillingservicelist = Ipbillingservicelist::where('active', true)->where('inpatient_id', $ipadmission->inpatient_id)->get();
            if ($patientstatementlist->isNotEmpty() && $hospitalstatementlist->isNotEmpty() && $ipbillingservicelist->isNotEmpty()) {
                foreach ($patientstatementlist as $key => $eachpatientstatement) {
                    $insurancefee = $eachpatientstatement->insurance_fee;
                    $selffee = $eachpatientstatement->self_fee;
                    if ($this->billing_type == 2) {
                        $eachpatientstatement->update([
                            'debit' => $insurancefee,
                            'credit' => 0,
                        ]);
                    } else {
                        $eachpatientstatement->update([
                            'debit' => $selffee,
                            'credit' => 0,
                        ]);
                    }
                }
                foreach ($hospitalstatementlist as $key => $eachhospitalstatement) {
                    $insurancefee = $eachhospitalstatement->insurance_fee;
                    $selffee = $eachhospitalstatement->self_fee;
                    if ($this->billing_type == 2) {
                        $eachhospitalstatement->update([
                            'debit' => $insurancefee,
                            'credit' => 0,
                        ]);
                    } else {
                        $eachhospitalstatement->update([
                            'debit' => $selffee,
                            'credit' => 0,
                        ]);
                    }
                }
                foreach ($ipbillingservicelist as $key => $eachipbillingservice) {
                    $insurancefee = $eachipbillingservice->ipservice_insurancefee;
                    $selffee = $eachipbillingservice->ipservice_selffee;
                    $eachipbillingservice->update([
                        'ipservice_fee' => ($this->billing_type == 2 ? $insurancefee : $selffee),
                        'final_amount' => ($this->billing_type == 2 ? $insurancefee : $selffee) * $eachipbillingservice->quantity,
                    ]);
                }
                $total = $ipbillingservicelist->sum('final_amount');
                $grandtotal = $total - $ipadmission->ipbilling->discount;
                $ipadmission->ipbilling->update([
                    'total' => $total,
                    'sub_total' => $grandtotal,
                    'grand_total' => $grandtotal,
                ]);
            }
        }
    }

    public function formreset()
    {
        $this->ipadmission_id = $this->salutation = $this->name = $this->last_name = $this->phone =
        $this->email = $this->gender = $this->age = $this->dob = $this->admission_date = $this->aadharid = $this->parentorguardian =
        $this->marital_status = $this->spouse_name = $this->door_no = $this->area = $this->city =
        $this->pincode = $this->country_id = $this->state_id = $this->reference_id = $this->doctorspecialization_id =
        $this->wardtype_id = $this->billing_type = $this->insurancecompany_id = $this->tpaname_id = $this->tpaidno = $this->policyno = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.inpatient.inpatientadmission.inpatientadmissiongeneral.Inpatientadmissiongenerallivewire');
    }
}
