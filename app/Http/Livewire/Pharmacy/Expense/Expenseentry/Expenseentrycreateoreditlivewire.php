<?php

namespace App\Http\Livewire\Pharmacy\Expense\Expenseentry;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Expense\Pharmacyexpenseentry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Expenseentrycreateoreditlivewire extends Component
{

    use miscellaneousLivewireTrait;

    public $expense_value, $mobile_number, $party_name, $payment_towards,
    $payment_mode, $referance_notes, $payment_date, $expense_type, $payment_ref_id, $bank_name, $payment_date1, $reference;

    public $expenseentry_id;

    public function mount($expenseentryuuid = null)
    {
        if ($expenseentryuuid) {
            $expenseentry = Pharmacyexpenseentry::where('uuid', $expenseentryuuid)->first();

            $this->expense_type = $expenseentry->expense_type;
            $this->expense_value = $expenseentry->expense_value;
            $this->mobile_number = $expenseentry->mobile_number;
            $this->party_name = $expenseentry->party_name;
            $this->payment_towards = $expenseentry->payment_towards;
            $this->payment_mode = $expenseentry->payment_mode;
            $this->referance_notes = $expenseentry->referance_notes;
            $this->payment_date = Carbon::parse($expenseentry->payment_date)->format('d-m-Y H:i:s');
            $this->expenseentry_id = $expenseentry->id;
            $this->bank_name = $expenseentry->bank_name;
            $this->payment_date1 = $expenseentry->payment_date1;
            $this->payment_ref_id = $expenseentry->payment_ref_id;
            $this->reference = $expenseentry->reference;
        } else {
            $this->payment_date = Carbon::now()->format('d-m-Y H:i:s');
        }
    }

    protected function rules()
    {
        return [
            'expense_value' => 'required|numeric',
            'mobile_number' => 'required|digits:10',
            'payment_mode' => 'required',
            'referance_notes' => 'nullable',
            'payment_date' => 'required',
            'expense_type' => 'required',
            'party_name' => 'required',
            'payment_towards' => 'required',
            'payment_ref_id' => 'required_if:payment_mode,3,4,6',
            'bank_name' => 'required_if:payment_mode,3,4,6',
            'reference' => 'required_if:payment_mode,5',
            'payment_date1' => 'required_if:payment_mode,3,4,6',
        ];
    }

    protected $messages = [
        'supplier_id.required' => 'Supplier Required',
        'bank_name.required_if' => 'Bank name cannot be empty',
        'payment_date1.required_if' => 'Payment date cannot be empty',
        'payment_ref_id.required_if' => 'Payment reference id cannot be empty',
        'reference.required_if' => 'reference cannot be empty',
    ];

    public function store()
    {
        $validatedData = $this->validate();
        if ($validatedData['payment_mode'] == 1 || $validatedData['payment_mode'] == 2) {
            $validatedData['payment_ref_id'] = null;
            $validatedData['bank_name'] = null;
            $validatedData['reference'] = null;
            $validatedData['payment_date1'] = null;
        }
        if ($validatedData['payment_mode'] == 5) {
            $validatedData['payment_ref_id'] = null;
            $validatedData['bank_name'] = null;
            $validatedData['payment_date1'] = null;
        }
        try {
            $validatedData['payment_date'] = Carbon::parse($validatedData['payment_date']);
            DB::beginTransaction();
            if ($this->expenseentry_id) {
                $pharmacypurchaseentry = Pharmacyexpenseentry::find($this->expenseentry_id);
                $pharmacypurchaseentry->update($validatedData);
                $this->currentuser()->pharmacyexpenseupdatable()->save($pharmacypurchaseentry);

                Helper::trackmessage($this->currentuser(), $pharmacypurchaseentry, 'pharmacypurchaseentry_createoredit', session()->getId(), 'WEB', 'Payment Entry Updated');
                $this->toaster('success', 'Expense Entry Updated Successfully!!');

                DB::commit();
                redirect('/pharmacy/expenseentry/index');
            } else {
                $pharmacypurchaseentry = $this->currentuser()->pharmacyexpensecreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacypurchaseentry, 'pharmacypurchaseentry_createoredit', session()->getId(), 'WEB', 'Payment Entry Created');
                $this->toaster('success', 'Expense Entry Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacypurchaseentries_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacypurchaseentries_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacypurchaseentries_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function formreset()
    {
        $this->expense_type = null;
        $this->expense_value = null;
        $this->mobile_number = null;
        $this->payment_mode = null;
        $this->payment_towards = null;
        $this->party_name = null;
        $this->referance_notes = null;
        $this->payment_date = Carbon::now()->format('d-m-Y H:i:s');
        $this->expenseentry_id = null;
        $this->bank_name = null;
        $this->payment_date1 = null;
        $this->payment_ref_id = null;
        $this->reference = null;
    }
    public function render()
    {
        return view('livewire.pharmacy.expense.expenseentry.expenseentrycreateoreditlivewire');
    }
}
