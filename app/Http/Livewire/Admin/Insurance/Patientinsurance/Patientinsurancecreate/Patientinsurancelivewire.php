<?php

namespace App\Http\Livewire\Admin\Insurance\Patientinsurance\Patientinsurancecreate;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Insurance\Patientinsurance;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Patientinsurancelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $patientinsurance, $type;
    public $stage, $pa_sentby, $pa_sentdatetime, $pa_sentmailid, $pa_estimatedamount, $pa_sentnote,
    $ins_contactname, $ins_contactphone, $pa_approvalstatus, $pa_approvedamount,
    $pa_rec_mailid, $pa_rec_name, $da_sentby, $proposeddischarge_datetime, $da_treatmentstatus,
    $da_finalbillamount, $da_sentnote, $da_approvalstatus, $da_approvedamount, $actualdischarge_datetime, $actualbill_datetime,
    $doc_listsumbitted, $received_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $payment_note, $hospital_receiptnumb;

    public function mount($patientinsurance_uuid, $type)
    {
        $this->type = $type;
        $this->patientinsurance = Patientinsurance::where('uuid', $patientinsurance_uuid)->first();

        $this->stage = $this->patientinsurance->stage;
        $this->pa_sentby = $this->patientinsurance->pa_sentby;
        $this->pa_sentdatetime = $this->patientinsurance->pa_sentdatetime ? date('Y-m-d\TH:i:s', strtotime($this->patientinsurance->pa_sentdatetime)) : null;
        $this->pa_sentmailid = $this->patientinsurance->pa_sentmailid;
        $this->pa_estimatedamount = $this->patientinsurance->pa_estimatedamount;
        $this->pa_sentnote = $this->patientinsurance->pa_sentnote;
        $this->ins_contactname = $this->patientinsurance->ins_contactname;
        $this->ins_contactphone = $this->patientinsurance->ins_contactphone;

        $this->pa_approvalstatus = $this->patientinsurance->pa_approvalstatus;
        $this->pa_approvedamount = $this->patientinsurance->pa_approvedamount;
        $this->pa_rec_mailid = $this->patientinsurance->pa_rec_mailid;
        $this->pa_rec_name = $this->patientinsurance->pa_rec_name;

        $this->da_sentby = $this->patientinsurance->da_sentby;
        $this->proposeddischarge_datetime = $this->patientinsurance->proposeddischarge_datetime ? date('Y-m-d\TH:i:s', strtotime($this->patientinsurance->proposeddischarge_datetime)) : null;
        $this->da_treatmentstatus = $this->patientinsurance->da_treatmentstatus;

        $this->da_finalbillamount = $this->patientinsurance->da_finalbillamount;
        $this->da_sentnote = $this->patientinsurance->da_sentnote;
        $this->da_approvalstatus = $this->patientinsurance->da_approvalstatus;
        $this->da_approvedamount = $this->patientinsurance->da_approvedamount;
        $this->actualdischarge_datetime = $this->patientinsurance->actualdischarge_datetime ? date('Y-m-d\TH:i:s', strtotime($this->patientinsurance->actualdischarge_datetime)) : null;
        $this->actualbill_datetime = $this->patientinsurance->actualbill_datetime ? date('Y-m-d\TH:i:s', strtotime($this->patientinsurance->actualbill_datetime)) : null;

        $this->doc_listsumbitted = $this->patientinsurance->doc_listsumbitted;
        $this->received_amount = $this->patientinsurance->received_amount;
        $this->modeofpayment = $this->patientinsurance->modeofpayment;
        $this->payment_ref_id = $this->patientinsurance->payment_ref_id;
        $this->bank_name = $this->patientinsurance->bank_name;
        $this->payment_date = $this->patientinsurance->payment_date;
        $this->payment_note = $this->patientinsurance->payment_note;
        $this->hospital_receiptnumb = $this->patientinsurance->hospital_receiptnumb;

    }

    protected function rules()
    {
        return [
            'stage' => 'required|integer',
            'pa_sentby' => 'required_if:stage,0,1,2,3,4,5',
            'pa_sentdatetime' => 'required_if:stage,0,1,2,3,4,5',
            'pa_sentmailid' => 'required_if:stage,0,1,2,3,4,5|email',
            'pa_estimatedamount' => 'required_if:stage,0,1,2,3,4,5',
            'pa_sentnote' => 'required_if:stage,0,1,2,3,4,5',
            'ins_contactname' => 'nullable',
            'ins_contactphone' => 'nullable',

            'pa_approvalstatus' => 'required_if:stage,1,2,3,4,5',
            'pa_approvedamount' => 'required_if:pa_approvalstatus,1',
            'pa_rec_mailid' => 'required_if:pa_approvalstatus,1',
            'pa_rec_name' => 'required_if:pa_approvalstatus,1',

            'da_sentby' => 'required_if:stage,2,3,4,5',
            'proposeddischarge_datetime' => 'required_if:stage,2,3,4,5',
            'da_treatmentstatus' => 'required_if:stage,2,3,4,5',
            'da_finalbillamount' => 'required_if:stage,2,3,4,5',
            'da_sentnote' => 'required_if:stage,2,3,4,5',
            'da_approvalstatus' => 'required_if:stage,3,4,5',
            'da_approvedamount' => 'required_if:da_approvalstatus,1',
            'actualdischarge_datetime' => 'required_if:stage,4,5',
            'actualbill_datetime' => 'required_if:stage,4,5',
            'doc_listsumbitted' => 'required_if:stage,4,5',
            'received_amount' => 'required_if:stage,5',
            'modeofpayment' => 'required_if:stage,5',
            'payment_ref_id' => 'required_if:modeofpayment,2,3,4',
            'bank_name' => 'required_if:modeofpayment,2,3,4',
            'payment_date' => 'required_if:modeofpayment,2,3,4',
            'payment_note' => 'nullable',
            'hospital_receiptnumb' => 'nullable',
        ];
    }

    protected $messages = [
        'received_amount.required_if' => 'Amount cannot be empty',
        'modeofpayment.required_if' => 'Select payment mode',
        'bank_name.required_if' => 'Bank name cannot be empty',
        'payment_date.required_if' => 'Payment date cannot be empty',
        'payment_ref_id.required_if' => 'Reference id cannot be empty',
    ];

    public function store()
    {
        $validated_data = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();

            if ($this->stage == 0 && $validated_data['pa_sentby']) {
                $validated_data['stage'] = 1;
            } elseif ($this->stage == 1 && $validated_data['pa_approvalstatus'] == 1) {
                $validated_data['stage'] = 2;
            } elseif ($this->stage == 2 && $validated_data['da_sentby']) {
                $validated_data['stage'] = 3;
            } elseif ($this->stage == 3 && $validated_data['da_approvalstatus'] == 1) {
                $validated_data['stage'] = 4;
            } elseif ($this->stage == 4 && $validated_data['actualdischarge_datetime']) {
                $validated_data['stage'] = 5;
            } elseif ($this->stage == 5 && $validated_data['received_amount']) {
                $validated_data['stage'] = 6;
            } elseif ($this->stage == 6) {
                $validated_data['stage'] = 6;
            } else {
                $validated_data['stage'] = $this->stage;
            }

            $this->patientinsurance->update($validated_data);
            $user->patientinsuranceupdatable()->save($this->patientinsurance);
            Helper::trackmessage($user, $this->patientinsurance, 'patientinsurancecreateoredit', session()->getId(), 'WEB', 'Patient Insurance Updated');

            $this->toaster('success', 'Insurance Updated Successfully!!');
            DB::commit();
            if ($this->type == 'create') {
                return redirect()->route('patientinsurancelist');
            } else {
                return redirect()->route('patientinsurancehistory');
            }

        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_patientinsurance_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_patientinsurance_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_patientinsurance_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {

        return view('livewire.admin.insurance.patientinsurance.patientinsurancecreate.patientinsurancelivewire');
    }
}
