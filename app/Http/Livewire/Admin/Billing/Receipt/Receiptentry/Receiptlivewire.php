<?php

namespace App\Http\Livewire\Admin\Billing\Receipt\Receiptentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Receiptlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user, $patient, $balance, $total_amount, $searchquery, $patientlist = [];
    public $payment_type = 1, $received_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date,
    $note, $receipt_type;

    public $modeofpaymentdata = [];

    protected $rules = [
        'payment_type' => 'required',
        'received_amount' => 'required|integer',
        'modeofpayment' => 'required',
        'payment_ref_id' => 'nullable',
        'bank_name' => 'nullable',
        'payment_date' => 'nullable',
        'receipt_type' => 'required',
        'note' => 'nullable|max:255',
    ];

    protected $messages = [
        'payment_type.required' => 'Select payment type',
        'received_amount.required' => 'Amount cannot be empty',
        'received_amount.integer' => 'Enter valid value',
        'modeofpayment.required' => 'Select payment mode',
        'bank_name.required_if' => 'Bank name cannot be empty',
        'payment_date.required_if' => 'Payment date cannot be empty',
        'payment_ref_id.required_if' => 'Reference id cannot be empty',
        'receipt_type.required' => 'Select Receipt type',
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->modeofpaymentdata = config('archive.modeofpayment');
    }

    public function Updatedpaymenttype()
    {
        if ($this->payment_type == 2) {
            if ($this->balance > 0) {
                $this->dispatch('balancealert');
                $this->payment_type = 1;
            }
        }
    }

    public function updatedSearchquery()
    {
        $this->patientlist = Patient::where('active', true)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uhid', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('phone', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function selectedpatient(Patient $patient)
    {
        $this->patient = $patient;
        $this->searchquery = '';
        $patientstatementbalance = Patientstatement::where('patient_id', $this->patient->id);
        $this->balance = $patientstatementbalance->sum('debit') - $patientstatementbalance->sum('credit');
        $this->total_amount = Patientstatement::where('patient_id', $this->patient->id)->sum('debit');
    }

    public function store()
    {
        $payment_validation = $this->validate();
        try {
            DB::beginTransaction();
            $payment_validation['patient_id'] = $this->patient->id;
            $receipt = $this->user->receiptcreatable()
                ->create($payment_validation);

            // Patient Statement

            $this->user->patientstatementcreatable()->create([
                'patient_id' => $receipt->patient_id,
                'opbilling_id' => $receipt->opbilling_id,
                'credit' => $receipt->received_amount,
                'debit' => 0,
                'note' => 'Receipt Payment',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $receipt->uniqid,
            ]);

            // Hospital Statement
            $this->user->hospitalstatementcreatable()->create([
                'user_type' => 1,
                'opbilling_id' => $receipt->opbilling_id,
                'credit' => $receipt->received_amount,
                'debit' => 0,
                'note' => 'Receipt Payment',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $receipt->uniqid,
            ])->userable()
                ->associate($this->patient)
                ->save();
            Helper::trackmessage($this->user, $receipt, 'receiptcreateoredit', session()->getId(), 'WEB', 'Receipt payment');

            $this->toaster('success', 'Receipt Paid Successfully!!');
            DB::commit();
            $this->printreceiptentry($receipt);
            return redirect()->route('receipt');
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_receipt_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_receipt_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_receipt_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function printreceiptentry($receipt)
    {
        $this->dispatch('printreceiptentry', $receipt->id);
    }

    public function render()
    {
        return view('livewire.admin.billing.receipt.receiptentry.receiptlivewire');
    }
}
