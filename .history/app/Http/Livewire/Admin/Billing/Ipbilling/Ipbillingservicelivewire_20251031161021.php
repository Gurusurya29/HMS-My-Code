<?php

namespace App\Http\Livewire\Admin\Billing\Ipbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Billing\Ipbilling\Ipbillingservicelist;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ipbillingservicelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user;
    public $discount, $discount_note, $ipbillingdata, $ipservicemasterlist, $searchquery, $selectedipservicemasterlist = [], $balance;
    protected $listeners = ['discountresetfields'];

    protected $rules = [
        'selectedipservicemasterlist.*.patient_id' => 'required',
        'selectedipservicemasterlist.*.inpatient_id' => 'required',
        'selectedipservicemasterlist.*.ipbilling_id' => 'required',
        'selectedipservicemasterlist.*.ipadmission_id' => 'required',
        'selectedipservicemasterlist.*.ipservicecategory_id' => 'nullable',
        'selectedipservicemasterlist.*.ipservicecategory_name' => 'nullable',
        'selectedipservicemasterlist.*.ipservicemaster_id' => 'nullable',
        'selectedipservicemasterlist.*.ipservice_name' => 'required',
        'selectedipservicemasterlist.*.ipservice_fee' => 'required|integer',
        'selectedipservicemasterlist.*.ipservice_selffee' => 'required',
        'selectedipservicemasterlist.*.ipservice_insurancefee' => 'required',
        'selectedipservicemasterlist.*.quantity' => 'required|integer',
        'selectedipservicemasterlist.*.final_amount' => 'required',
    ];

    protected $messages = [
        'selectedipservicemasterlist.*.ipservice_name.required' => 'Field is required',
        'selectedipservicemasterlist.*.ipservice_fee.required' => 'Field is required',
        'selectedipservicemasterlist.*.ipservice_fee.integer' => 'Enter valid value',
        'selectedipservicemasterlist.*.quantity.required' => 'Field is required',
        'selectedipservicemasterlist.*.quantity.integer' => 'Enter valid value',
    ];

    public function mount($ipbilling_uuid)
    {
        $this->ipbillingdata = Ipbilling::where('uuid', $ipbilling_uuid)->first();
        $this->ipservicemasterlist = Ipservicemaster::where('active', true)->where('is_otservice', false)->get();
        $patientstatementbalance = Patientstatement::where('patient_id', $this->ipbillingdata->patient_id);
        $this->balance = $patientstatementbalance->sum('debit') - $patientstatementbalance->sum('credit');
        $this->user = auth()->user();
    }

    public function updatedSearchquery()
    {
        $this->ipservicemasterlist = Ipservicemaster::where('active', true)
            ->whereNotIn('id', collect($this->selectedipservicemasterlist)->whereNotNull('ipservicemaster_id')->pluck('ipservicemaster_id')->toArray())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function additem(Ipservicemaster $ipservicemaster = null)
    {
        $ipservicefee = $this->ipbillingdata->ipadmission->billing_type == 1 ? $ipservicemaster->selffee : $ipservicemaster->insurancefee;
        $this->selectedipservicemasterlist[] = [
            'patient_id' => $this->ipbillingdata->patient_id,
            'inpatient_id' => $this->ipbillingdata->inpatient_id,
            'ipbilling_id' => $this->ipbillingdata->id,
            'ipadmission_id' => $this->ipbillingdata->ipadmission_id,
            'ipservicecategory_id' => $ipservicemaster->ipservicecategory_id ? $ipservicemaster->ipservicecategory->id : null,
            'ipservicecategory_name' => $ipservicemaster->ipservicecategory_id ? $ipservicemaster->ipservicecategory->name : 'Others',
            'ipservicemaster_id' => $ipservicemaster->id,
            'ipservice_name' => $ipservicemaster->name,
            'ipservice_fee' => $ipservicefee ?? 0,
            'ipservice_selffee' => $ipservicemaster->selffee ?? 0,
            'ipservice_insurancefee' => $ipservicemaster->insurancefee ?? 0,
            'quantity' => 1,
            'final_amount' => $ipservicefee ?? 0,
        ];
        $this->searchquery = '';
        $this->ipservicemasterlist = [];
    }

    public function billingservicecalc($key)
    {
        $ipservicemasterlist = $this->selectedipservicemasterlist[$key];
        $this->selectedipservicemasterlist[$key]['final_amount'] = doubleval($ipservicemasterlist['ipservice_fee']) * intval($ipservicemasterlist['quantity']);
    }

    public function removeitem($key)
    {
        unset($this->selectedipservicemasterlist[$key]);
    }

    // public function storeservice()
    // {
    //     $validatedData = $this->validate();

    //     try {
    //         DB::beginTransaction();
    //         foreach ($this->selectedipservicemasterlist as $key => $value) {
    //             $ipbillingservicelist = $this->user->ipbillingservicelistcreatable()
    //                 ->create([
    //                     'patient_id' => $value['patient_id'],
    //                     'inpatient_id' => $value['inpatient_id'],
    //                     'ipbilling_id' => $value['ipbilling_id'],
    //                     'ipadmission_id' => $value['ipadmission_id'],
    //                     'ipservicecategory_id' => $value['ipservicecategory_id'],
    //                     'ipservicecategory_name' => $value['ipservicecategory_name'],
    //                     'ipservicemaster_id' => $value['ipservicemaster_id'],
    //                     'ipservice_name' => $value['ipservice_name'],
    //                     'ipservice_fee' => $value['ipservice_fee'],
    //                     'ipservice_selffee' => $value['ipservice_selffee'] != 0 ? $value['ipservice_selffee'] : $value['ipservice_fee'],
    //                     'ipservice_insurancefee' => $value['ipservice_insurancefee'] != 0 ? $value['ipservice_insurancefee'] : $value['ipservice_fee'],
    //                     'quantity' => $value['quantity'],
    //                     'final_amount' => $value['final_amount'],
    //                 ]);
    //             // Patient Statement
    //             $this->user->patientstatementcreatable()->make([
    //                 'patient_id' => $value['patient_id'],
    //                 'ipbilling_id' => $value['ipbilling_id'],
    //                 'credit' => 0,
    //                 'debit' => $value['final_amount'],
    //                 'self_fee' => $value['ipservice_selffee'] != 0 ? (doubleval($value['ipservice_selffee']) * intval($value['quantity'])) : $value['final_amount'],
    //                 'insurance_fee' => $value['ipservice_insurancefee'] != 0 ? (doubleval($value['ipservice_insurancefee']) * intval($value['quantity'])) : $value['final_amount'],
    //                 'note' => 'IP Bill Service',
    //                 'entity_type' => 1,
    //                 'transaction_type' => 'D',
    //                 'statement_ref_id' => $ipbillingservicelist->uniqid,
    //             ])
    //                 ->statementable()
    //                 ->associate($this->ipbillingdata)
    //                 ->save();

    //             // Hospital Statement
    //             $this->user->hospitalstatementcreatable()->make([
    //                 'user_type' => 1,
    //                 'ipbilling_id' => $value['ipbilling_id'],
    //                 'credit' => 0,
    //                 'debit' => $value['final_amount'],
    //                 'self_fee' => $value['ipservice_selffee'] != 0 ? (doubleval($value['ipservice_selffee']) * intval($value['quantity'])) : $value['final_amount'],
    //                 'insurance_fee' => $value['ipservice_insurancefee'] != 0 ? (doubleval($value['ipservice_insurancefee']) * intval($value['quantity'])) : $value['final_amount'],
    //                 'note' => 'IP Bill Service',
    //                 'entity_type' => 1,
    //                 'transaction_type' => 'D',
    //                 'statement_ref_id' => $ipbillingservicelist->uniqid,
    //             ])
    //                 ->userable()
    //                 ->associate($this->ipbillingdata->patient)
    //                 ->hstatementable()
    //                 ->associate($this->ipbillingdata)
    //                 ->save();
    //             Helper::trackmessage($this->user, $ipbillingservicelist, 'ipbillingservicelistcreateoredit', session()->getId(), 'WEB', 'IP Billing Service list Created');

    //         }

    //         $subtotal = $this->ipbillingdata->sub_total + collect($this->selectedipservicemasterlist)->sum('final_amount');
    //         $grandtotal = $subtotal - $this->ipbillingdata->discount;
    //         $this->ipbillingdata->update([
    //             'sub_total' => $subtotal,
    //             'total' => $grandtotal,
    //             'grand_total' => $grandtotal,
    //         ]);
    //         $this->user->ipbillingupdatable()->save($this->ipbillingdata);
    //         DB::commit();
    //         $this->toaster('success', 'IP Billing Service list Created Successfully!!');
    //         return redirect()->route('ipbillingservice', $this->ipbillingdata->uuid);
    //     } catch (Exception $e) {
    //         $this->exceptionerror($this->user, 'admin_ipbillingservicelist_createoredit', 'error_one : ' . $e->getMessage());
    //     } catch (QueryException $e) {
    //         $this->exceptionerror($this->user, 'admin_ipbillingservicelist_createoredit', 'error_two : ' . $e->getMessage());
    //     } catch (PDOException $e) {
    //         $this->exceptionerror($this->user, 'admin_ipbillingservicelist_createoredit', 'error_three : ' . $e->getMessage());
    //     }
    // }

    public function openipbilldiscount()
    {
        $this->dispatch('ipbillingdiscountmodal');
    }

    public function storediscount()
    {
        $discount_validation = $this->validate([
            'discount' => 'required|integer',
            'discount_note' => 'required|max:255',
        ], [
            'discount.integer' => 'Enter valid value.',
        ]);
        try {
            DB::beginTransaction();
            $grandtotal = $this->ipbillingdata->sub_total - $discount_validation['discount'];
            $discount_validation['total'] = $grandtotal;
            $discount_validation['grand_total'] = $grandtotal;
            $this->ipbillingdata->update($discount_validation);
            // Patient Statement
            $this->user->patientstatementcreatable()->make([
                'patient_id' => $this->ipbillingdata->patient_id,
                'ipbilling_id' => $this->ipbillingdata->id,
                'credit' => $this->ipbillingdata->discount,
                'debit' => 0,
                'type' => 1,
                'note' => 'IP Bill Discount',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $this->ipbillingdata->uniqid,
            ])
                ->statementable()
                ->associate($this->ipbillingdata)
                ->save();

            // Hospital Statement
            $this->user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'ipbilling_id' => $this->ipbillingdata->id,
                'credit' => $this->ipbillingdata->discount,
                'debit' => 0,
                'type' => 1,
                'note' => 'IP Bill Discount',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $this->ipbillingdata->uniqid,
            ])
                ->userable()
                ->associate($this->ipbillingdata->patient)
                ->hstatementable()
                ->associate($this->ipbillingdata)
                ->save();
            DB::commit();
            $this->toaster('success', 'IP Billing Discount Submited Successfully!!');
            return redirect()->route('ipbillingservice', $this->ipbillingdata->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_ipbillingdiscount_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_ipbillingdiscount_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_ipbillingdiscount_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function discountresetfields()
    {
        $this->discount = $this->discount_note = '';
    }

    public function printdetailedipbill($ipbilling_id)
    {
        $this->dispatch('printdetailedipbill', $ipbilling_id);
    }

    public function printconsolidatedipbill($ipbilling_id)
    {
        $this->dispatch('printconsolidatedipbill', $ipbilling_id);
    }

    public function render()
    {
        $ipbillingservicelist = Ipbillingservicelist::where('ipbilling_id', $this->ipbillingdata->id)
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        if (!empty($this->selectedipservicemasterlist)) {
            $ipservicevalue = collect($this->selectedipservicemasterlist)->pluck('final_amount')->toArray();
            $total = array_sum($ipservicevalue);
        } else {
            $total = 0;
        }
        return view('livewire.admin.billing.ipbilling.ipbillingservicelivewire',
            compact('ipbillingservicelist', 'total'));
    }
}
