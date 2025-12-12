<?php

namespace App\Http\Livewire\Admin\Billing\Billdiscount\Billdiscountentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use App\Models\Admin\Billing\Otbilling\Otbilling;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Billdiscountlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user, $patient, $searchquery, $patientlist = [];
    public $bill_type, $discount_amount, $discount_type, $note;
    public $select_bill, $selected_bill, $searchbilllist = [];
    public $billtype_data = [];

    public $modeofpaymentdata = [];

    protected $rules = [
        'bill_type' => 'required',
        'discount_amount' => 'required|integer',
        'discount_type' => 'required',
        'select_bill' => 'required',
        'note' => 'nullable|max:255',
    ];

    protected $messages = [
        'bill_type.required' => 'Select Bill type',
        'discount_amount.required' => 'Amount cannot be empty',
        'discount_amount.integer' => 'Enter valid value',
        'discount_type.required' => 'Select type',
        'select_bill.required' => 'Select Bill',
    ];
    public function mount()
    {
        $this->user = auth()->user();
        $this->billtype_data = collect(config('archive.bill_type'))->where('maintype', 'HMS')->toArray();
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
    }

    public function Updateddiscounttype()
    {
        // As per client requirement only op and ot are allowed to cancel
        if ($this->discount_type == 2) {
            $this->billtype_data = collect(config('archive.bill_type'))->where('maintype', 'HMS')->filter(function ($value, $key) {
                return $value['id'] != 2;
            })->toArray();
        } else {
            $this->billtype_data = collect(config('archive.bill_type'))->where('maintype', 'HMS')->toArray();
        }
    }

    public function searchbill()
    {
        switch ($this->bill_type) {
            case '1':
                $this->searchbilllist = Opbillinglist::where('patient_id', $this->patient->id)->whereNull('billdiscount_type')->where('uniqid', 'like', '%' . $this->select_bill . '%')
                    ->take(10)
                    ->get();
                break;
            case '2':
                $this->searchbilllist = Ipbilling::where('patient_id', $this->patient->id)->whereNull('billdiscount_type')->whereHas('inpatient', function (Builder $query) {
                    $query->whereNotNull('is_patientdischarged');
                })
                    ->where('uniqid', 'like', '%' . $this->select_bill . '%')
                    ->take(10)
                    ->get();
                break;
            case '3':
                $this->searchbilllist = Otbilling::where('patient_id', $this->patient->id)->whereNull('billdiscount_type')
                    ->whereHas('otschedule', function (Builder $query) {
                        $query->whereNotNull('is_movetoip');
                    })
                    ->where('uniqid', 'like', '%' . $this->select_bill . '%')
                    ->take(10)
                    ->get();
                break;
                // case '4':
                //     $this->searchbilllist = Pharmsalesentry::whereNull('billdiscount_type')->where('uniqid', 'like', '%' . $this->select_bill . '%')
                //         ->take(10)
                //         ->get();
                //     break;
                // case '5':
                //     $this->searchbilllist = Labpatient::whereNull('billdiscount_type')->where('uniqid', 'like', '%' . $this->select_bill . '%')
                //         ->take(10)
                //         ->get();
                //     break;
                // case '6':
                //     $this->searchbilllist = Scanpatient::whereNull('billdiscount_type')->where('uniqid', 'like', '%' . $this->select_bill . '%')
                //         ->take(10)
                //         ->get();
                //     break;
                // case '7':
                //     $this->searchbilllist = Xraypatient::whereNull('billdiscount_type')->where('uniqid', 'like', '%' . $this->select_bill . '%')
                //         ->take(10)
                //         ->get();
                //     break;
        }
    }

    public function selectedbill($bill_id)
    {
        switch ($this->bill_type) {
            case '1':
                $this->selected_bill = Opbillinglist::find($bill_id);
                break;
            case '2':
                $this->selected_bill = Ipbilling::find($bill_id);
                break;
            case '3':
                $this->selected_bill = Otbilling::find($bill_id);
                break;
                // case '4':
                //     $this->selected_bill = Pharmsalesentry::find($bill_id);
                //     break;
                // case '5':
                //     $this->selected_bill = Labpatient::find($bill_id);
                //     break;
                // case '6':
                //     $this->selected_bill = Scanpatient::find($bill_id);
                //     break;
                // case '7':
                //     $this->selected_bill = Xraypatient::find($bill_id);
                //     break;
        }
        $this->select_bill = $this->selected_bill->uniqid . '(Rs.' . $this->selected_bill->grand_total . ')';
        if ($this->discount_type == 2) {
            $this->discount_amount = $this->selected_bill->grand_total;
        }
        $this->searchbilllist = [];
    }

    public function searchbillfoucs()
    {
        $this->select_bill = '';
        $this->selected_bill = '';
        $this->searchbilllist = [];
    }

    public function Updatedbilltype()
    {
        $this->select_bill = '';
        $this->selected_bill = '';
        $this->searchbilllist = [];
    }

    public function store()
    {
        $validated_data = $this->validate();
        try {
            DB::beginTransaction();
            $validated_data['patient_id'] = $this->patient->id;

            $billdiscount = $this->user->billdiscountcreatable()
                ->create($validated_data);
            $billdiscount->billdiscountable()
                ->associate($this->selected_bill)
                ->save();
            $this->selected_bill->update([
                'grand_total' => $this->selected_bill->total - $this->discount_amount,
                'billdiscount_type' => $this->discount_type,
                'billdiscount_amount' => $this->discount_amount,
            ]);
            // Patient Statement
            if (get_class($billdiscount->billdiscountable) == 'App\Models\Admin\Billing\Opbilling\Opbillinglist') {
                $billing_id = 'opbilling_id';
            } elseif (get_class($billdiscount->billdiscountable) == 'App\Models\Admin\Billing\Ipbilling\Ipbilling') {
                $billing_id = 'ipbilling_id';
            } elseif (get_class($billdiscount->billdiscountable) == 'App\Models\Admin\Billing\Otbilling\Otbilling') {
                $billing_id = 'otbilling_id';
            }
            $this->user->patientstatementcreatable()->create([
                'patient_id' => $billdiscount->patient_id,
                $billing_id => $billing_id == 'opbilling_id' ? $billdiscount->billdiscountable->opbilling_id : $billdiscount->billdiscountable->id,
                'credit' => 0,
                'debit' => -1 * $billdiscount->discount_amount,
                'note' => 'Bill Discount/Cancel',
                'entity_type' => 1,
                'transaction_type' => 'D',
                'statement_ref_id' => $billdiscount->uniqid,
            ]);

            // Hospital Statement
            $this->user->hospitalstatementcreatable()->create([
                'user_type' => 1,
                $billing_id => $billing_id == 'opbilling_id' ? $billdiscount->billdiscountable->opbilling_id : $billdiscount->billdiscountable->id,
                'credit' => 0,
                'debit' => -1 * $billdiscount->discount_amount,
                'note' => 'Bill Discount/Cancel',
                'entity_type' => 1,
                'transaction_type' => 'D',
                'statement_ref_id' => $billdiscount->uniqid,
            ])->userable()
                ->associate($this->patient)
                ->save();

            Helper::trackmessage($this->user, $billdiscount, 'billdiscountcreateoredit', session()->getId(), 'WEB', 'Bill Discount/Cancel');

            $this->toaster('success', 'Bill Discounted/Canceled Successfully!!');
            DB::commit();
            return redirect()->route('billdiscount');
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_billdiscount_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_billdiscount_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_billdiscount_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.billing.billdiscount.billdiscountentry.billdiscountlivewire');
    }
}
