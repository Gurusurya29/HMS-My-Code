<?php

namespace App\Http\Livewire\Admin\Account\Paymentvoucher\Paymentvoucherentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Employee\Employee;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Paymentvoucherentrylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    public $user, $paid_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $payment_type, $payment_to, $others_name, $payment_reason, $note;
    public $selecteduser_id, $paymentuserlist = [];
    public $modeofpaymentdata = [];
    public  $payment_typedata = [];
    public $paymentable_user;

    protected $rules = [
        'payment_type' => 'required_if:payment_to,1,3',
        'selecteduser_id' => 'required_if:payment_to,1,2,3',
        'paid_amount' => 'required|integer',
        'payment_reason' => 'required',
        'modeofpayment' => 'required',
        'payment_ref_id' => 'nullable',
        'bank_name' => 'nullable',
        'payment_date' => 'nullable',
        'payment_to' => 'required',
        'others_name' => 'required_if:payment_to,4',
        'note' => 'nullable|max:255',
    ];

    protected $messages = [
        'payment_type.required_if' => 'Select payment type',
        'selecteduser_id.required' => 'This field cannot be empty.',
        'paid_amount.required' => 'Amount cannot be empty',
        'paid_amount.integer' => 'Enter valid value',
        'modeofpayment.required' => 'Select payment mode',
        'bank_name.required_if' => 'Bank name cannot be empty',
        'payment_date.required_if' => 'Payment date cannot be empty',
        'payment_ref_id.required_if' => 'Reference id cannot be empty',
    ];

    public function mount()
    {
        $this->modeofpaymentdata = config('archive.modeofpayment');
        $this->payment_typedata = config('archive.receipt_type');
        $this->user = auth()->user();
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
                $this->payment_typedata = config('archive.receipt_type');
                break;
            case '2':
                $this->paymentuserlist = Employee::where('active', true)->where('is_accountactive', true)->get();
                break;
            case '3':
                $this->paymentuserlist = Supplier::where('active', true)->get();
                $this->payment_typedata = config('archive.receipt_type_supplier');
                break;
        }
        $this->formreset();
    }

    public function store()
    {
        $payment_validation = $this->validate();
        switch ($this->payment_to) {
            case '1':
                $this->paymentable_user = Patient::find($this->selecteduser_id);
                break;
            case '2':
                $this->paymentable_user = Employee::find($this->selecteduser_id);
                break;
            case '3':
                $this->paymentable_user = Supplier::find($this->selecteduser_id);
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
            $this->formreset();
            return redirect()->route('paymentvoucherentry');
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_paymentvoucher_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_paymentvoucher_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_paymentvoucher_createoredit', 'error_three : ' . $e->getMessage());
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
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $paymentvoucher->uniqid,
                ]);
                break;
            case '2':
                $this->user->employeestatementcreatable()->create([
                    'employee_id' => $paymentvoucher->paymentable_id,
                    'credit' => 0,
                    'debit' => $paymentvoucher->paid_amount,
                    'note' => 'Payment Voucher',
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $paymentvoucher->uniqid,
                ]);
                break;
            case '3':
                $this->user->supplierstatementcreatable()->create([
                    'supplier_id' => $paymentvoucher->paymentable_id,
                    'credit' => 0,
                    'debit' => $paymentvoucher->paid_amount,
                    'note' => 'Payment Voucher',
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $paymentvoucher->uniqid,
                ]);
                break;
        }

        // Hospital Statement
        $this->user->hospitalstatementcreatable()->create([
            'user_type' => 1,
            'credit' => 0,
            'debit' => $paymentvoucher->paid_amount,
            'note' => 'Payment Voucher',
            'entity_type' => 1,
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

    public function formreset()
    {
        $this->paid_amount = $this->modeofpayment = $this->payment_ref_id = $this->bank_name = $this->payment_date = $this->payment_type = $this->others_name = $this->payment_reason = $this->note = null;
        $this->selecteduser_id = [];
    }

    public function render()
    {
        return view('livewire.admin.account.paymentvoucher.paymentvoucherentry.paymentvoucherentrylivewire');
    }
}
