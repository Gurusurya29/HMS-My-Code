<?php

namespace App\Http\Livewire\Admin\Billing\Opbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Helper;
use App\Models\Miscellaneous\Numbertowords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Opbillpaymentlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user, $balance;
    public $payment_type = 1, $received_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $note, $opreceiptdata;
    public $modeofpaymentdata = [];
    public $opbillingdata;
    protected $listeners = ['paymentresetfields'];

    protected $rules = [
        'payment_type' => 'required',
        'received_amount' => 'required',
        'modeofpayment' => 'required',
        'payment_ref_id' => 'nullable',
        'bank_name' => 'nullable',
        'payment_date' => 'nullable',
        'note' => 'nullable|max:255',

    ];

    protected $messages = [
        'payment_type.required' => 'Select payment type',
        'received_amount.required' => 'Amount cannot be empty',
        'modeofpayment.required' => 'Select payment mode',
        'bank_name.required_if' => 'Bank name cannot be empty',
        'payment_date.required_if' => 'Payment date cannot be empty',
        'payment_ref_id.required_if' => 'Reference id cannot be empty',
    ];

    public function mount($opbilling_uuid)
    {
        $this->user = auth()->user();
        $this->opbillingdata = Opbilling::where('uuid', $opbilling_uuid)->first();
        $patientstatementbalance = Patientstatement::where('patient_id', $this->opbillingdata->patient_id);
        $this->balance = $patientstatementbalance->sum('debit') - $patientstatementbalance->sum('credit');
        $this->opreceiptdata = $this->opbillingdata->receiptable;
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

    public function storereceipt()
    {
        $payment_validation = $this->validate();
        try {
            DB::beginTransaction();
            $payment_validation['patient_id'] = $this->opbillingdata->patient_id;
            $payment_validation['receiptable_type'] = get_class($this->opbillingdata);
            $payment_validation['receiptable_id'] = $this->opbillingdata->id;
            $payment_validation['receipt_type'] = 1;
            $receipt = $this->user->receiptcreatable()
                ->create($payment_validation);

            // Patient Statement
            $this->user->patientstatementcreatable()->make([
                'patient_id' => $receipt->patient_id,
                'opbilling_id' => $receipt->opbilling_id,
                'credit' => $receipt->received_amount,
                'debit' => 0,
                'type' => $this->payment_type == 2 ? 2 : 0,
                'note' => 'OP Bill Payment',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $receipt->uniqid,
            ])
                ->statementable()
                ->associate($this->opbillingdata)
                ->save();

            // Hospital Statement
            $this->user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'opbilling_id' => $receipt->opbilling_id,
                'credit' => $receipt->received_amount,
                'debit' => 0,
                'type' => $this->payment_type == 2 ? 2 : 0,
                'note' => 'OP Bill Payment',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $receipt->uniqid,
            ])
                ->userable()
                ->associate($this->opbillingdata->patient)
                ->hstatementable()
                ->associate($this->opbillingdata)
                ->save();

            Helper::trackmessage($this->user, $receipt, 'opreceiptcreateoredit', session()->getId(), 'WEB', 'OP Bill Payment Created');

            $this->toaster('success', 'OP Bill Paid Successfully!!');
            DB::commit();
            $this->paymentresetfields();
            $this->printopreceipt($receipt);
            return redirect()->route('opbillpayment', $this->opbillingdata->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_opreceipt_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_opreceipt_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_opreceipt_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function printopreceipt(Receipt $receipt)
    {
        $this->dispatch('printopreceipt', $receipt->id);
    }

    public function downloadoppaymentreceipt(Receipt $receipt)
    {
        $amount_in_words = Numbertowords::numbertowords($receipt->received_amount);
        $pdf = Pdf::loadView('admin.billing.opbilling.oppaymentreceipt',
            compact('opreceipt', 'amount_in_words'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), 'receipt.pdf');

    }

    public function paymentresetfields()
    {
        $this->payment_type = 1;
        $this->received_amount = '';
        $this->modeofpayment = '';
        $this->payment_ref_id = '';
        $this->note = '';
    }

    public function render()
    {
        return view('livewire.admin.billing.opbilling.opbillpaymentlivewire');
    }
}
