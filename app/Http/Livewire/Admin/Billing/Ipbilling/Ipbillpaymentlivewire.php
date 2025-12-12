<?php

namespace App\Http\Livewire\Admin\Billing\Ipbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Miscellaneous\Helper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ipbillpaymentlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user, $ipbillingdata, $balance;
    public $payment_type = 1, $received_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $note, $ipreceiptdata;
    public $modeofpaymentdata = [];
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

    public function mount($ipbilling_uuid)
    {
        $this->user = auth()->user();
        $this->ipbillingdata = Ipbilling::where('uuid', $ipbilling_uuid)->first();
        $patientstatementbalance = Patientstatement::where('patient_id', $this->ipbillingdata->patient_id);
        $this->balance = $patientstatementbalance->sum('debit') - $patientstatementbalance->sum('credit');
        $this->ipreceiptdata = $this->ipbillingdata->receiptable;
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

    public function storebillpayment()
    {
        $payment_validation = $this->validate();
        try {
            DB::beginTransaction();
            $payment_validation['patient_id'] = $this->ipbillingdata->patient_id;
            $payment_validation['receiptable_type'] = get_class($this->ipbillingdata);
            $payment_validation['receiptable_id'] = $this->ipbillingdata->id;
            $payment_validation['receipt_type'] = 2;
            $receipt = $this->user->receiptcreatable()
                ->create($payment_validation);
            // Patient Statement
            $this->user->patientstatementcreatable()->make([
                'patient_id' => $receipt->patient_id,
                'ipbilling_id' => $this->ipbillingdata->id,
                'credit' => $receipt->received_amount,
                'debit' => 0,
                'type' => $this->payment_type == 2 ? 2 : 0,
                'note' => 'IP Bill Payment',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $receipt->uniqid,
            ])
                ->statementable()
                ->associate($this->ipbillingdata)
                ->save();

            // Hospital Statement
            $this->user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'ipbilling_id' => $this->ipbillingdata->id,
                'credit' => $receipt->received_amount,
                'debit' => 0,
                'type' => $this->payment_type == 2 ? 2 : 0,
                'note' => 'IP Bill Payment',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $receipt->uniqid,
            ])
                ->userable()
                ->associate($this->ipbillingdata->patient)
                ->hstatementable()
                ->associate($this->ipbillingdata)
                ->save();

            Helper::trackmessage($this->user, $receipt, 'receiptcreateoredit', session()->getId(), 'WEB', 'IP Bill Payment Created');

            DB::commit();
            $this->paymentresetfields();

            $this->printipreceiptlist($receipt->id);
            $this->toaster('success', 'IP Bill Paid Successfully!!');
            return redirect()->route('ipbillpayment', $this->ipbillingdata->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_receipt_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_receipt_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_receipt_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function printipreceiptlist($receipt_id)
    {
        $this->dispatch('printipreceiptlist', $receipt_id);
    }

    public function downloadippaymentreceipt(Receipt $Receipt)
    {

        $pdf = Pdf::loadView('admin.billing.ipbilling.ippaymentreceipt',
            compact('receipt'))
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
        return view('livewire.admin.billing.ipbilling.ipbillpaymentlivewire');
    }
}
