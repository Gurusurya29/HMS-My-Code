<?php

namespace App\Http\Livewire\Pharmacy\Paymentvoucher\Pharmacypaymentvoucherentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Employee\Employee;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacypaymentvoucherentrylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    public $user, $paid_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $payment_to, $others_name, $payment_reason, $note;
    public $selecteduser_id, $paymentuserlist = [];
    public $modeofpaymentdata = [];
    public $paymentable_user;

    protected $rules = [
        'selecteduser_id' => 'required_if:payment_to,1,2,3',
        'paid_amount' => 'required|integer',
        'payment_reason' => 'required',
        'modeofpayment' => 'required',
        'payment_ref_id' => 'nullable',
        'bank_name' => 'nullable',
        'payment_date' => 'nullable',
        'payment_to' => 'required',
        'others_name' => 'nullable',
        'note' => 'nullable|max:255',
    ];

    protected $messages = [
        'selecteduser_id.required' => 'This field cannot be empty.',
        'paid_amount.required' => 'Amount cannot be empty',
        'paid_amount.integer' => 'Enter a valid amount',
        'modeofpayment.required' => 'Select payment mode',
        'bank_name.required_if' => 'Bank name cannot be empty',
        'payment_date.required_if' => 'Payment date cannot be empty',
        'payment_ref_id.required_if' => 'Reference id cannot be empty',
    ];

    public function mount()
    {
        $this->modeofpaymentdata = config('archive.modeofpayment');
        $this->user = $this->currentuser();
    }

    public function hydrate()
    {
        $this->dispatch('loadpaymentSelect2Hydrate');
    }

    public function Updatedpaymentto()
    {
        switch ($this->payment_to) {
            case '1':
                $this->paymentuserlist = Patient::where('active', true)->get();
                break;
            case '2':
                $this->paymentuserlist = Employee::where('active', true)->where('is_accountactive', true)->get();
                break;
            case '3':
                $this->paymentuserlist = Supplier::where('active', true)->get();
                break;
        }
    }

    public function store()
    {
        $payment_validation = $this->validate();
        switch ($this->payment_to) {
            case '1':
                $this->paymentable_user = Patient::find($this->selecteduser_id);
                $payment_validation['payment_type'] = 4;
                break;
            case '2':
                $this->paymentable_user = Employee::find($this->selecteduser_id);
                break;
            case '3':
                $this->paymentable_user = Supplier::find($this->selecteduser_id);
                $payment_validation['payment_type'] = 4;
                break;
        }
        try {
            DB::beginTransaction();
            $paymentvoucher = $this->user->paymentvouchercreatable()
                ->create($payment_validation);
            if ($this->paymentable_user) {
                $this->paymentable_user->paymentable()->save($paymentvoucher);
            }

            $this->statementcreate($paymentvoucher);

            Helper::trackmessage($this->user, $paymentvoucher, 'paymentvouchercreateoredit', session()->getId(), 'WEB', 'Payment Voucher');

            $this->toaster('success', 'Payment Voucher Saved Successfully!!');
            DB::commit();
            $this->paymentvoucherprint($paymentvoucher);
            return redirect()->route('pharmacy.pharmacypaymentvoucherentry');
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'pharmacy_paymentvoucher_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'pharmacy_paymentvoucher_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'pharmacy_paymentvoucher_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function statementcreate($paymentvoucher)
    {
        switch ($this->payment_to) {
            case '1':
                $this->user->patientstatementcreatable()->create([
                    'patient_id' => $paymentvoucher->paymentable_id,
                    'credit' => 0,
                    'debit' => $paymentvoucher->paid_amount,
                    'note' => 'Payment Voucher',
                    'entity_type' => 3,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $paymentvoucher->uniqid,
                ]);
                $usertype = 1;
                break;
            case '2':
                $this->user->employeestatementcreatable()->create([
                    'employee_id' => $paymentvoucher->paymentable_id,
                    'credit' => 0,
                    'debit' => $paymentvoucher->paid_amount,
                    'note' => 'Payment Voucher',
                    'entity_type' => 3,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $paymentvoucher->uniqid,
                ]);
                $usertype = 2;
                break;
            case '3':
                $this->user->supplierstatementcreatable()->create([
                    'supplier_id' => $paymentvoucher->paymentable_id,
                    'credit' => 0,
                    'debit' => $paymentvoucher->paid_amount,
                    'note' => 'Payment Voucher',
                    'entity_type' => 3,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $paymentvoucher->uniqid,
                ]);
                $usertype = 3;
                break;
            case '4':
                $usertype = 3;
                break;
        }

        // Hospital Statement

        $this->user->hospitalstatementcreatable()->create([
            'user_type' => $usertype,
            'credit' => 0,
            'debit' => $paymentvoucher->paid_amount,
            'note' => 'Payment Voucher',
            'entity_type' => 3,
            'transaction_type' => 'D',
            'statement_ref_id' => $paymentvoucher->uniqid,
        ])->userable()
            ->associate($paymentvoucher->paymentable)
            ->save();
    }

    public function paymentvoucherprint($paymentvoucher)
    {
        $this->dispatch('paymentvoucherprint', $paymentvoucher->id);
    }

    public function render()
    {
        return view('livewire.pharmacy.paymentvoucher.pharmacypaymentvoucherentry.pharmacypaymentvoucherentrylivewire');
    }
}
