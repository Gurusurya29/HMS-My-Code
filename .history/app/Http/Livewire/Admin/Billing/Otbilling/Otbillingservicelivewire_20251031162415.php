<?php

namespace App\Http\Livewire\Admin\Billing\Otbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Otbilling\Otbilling;
use App\Models\Admin\Billing\Otbilling\Otbillingservicelist;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Otbillingservicelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user, $inpatient;
    public $discount, $discount_note, $otbillingdata, $otservicemasterlist, $searchquery, $selectedotservicemasterlist = [], $balance;
    protected $listeners = ['discountresetfields'];

    protected $rules = [
        'selectedotservicemasterlist.*.patient_id' => 'required',
        'selectedotservicemasterlist.*.inpatient_id' => 'required',
        'selectedotservicemasterlist.*.otbilling_id' => 'required',
        'selectedotservicemasterlist.*.otschedule_id' => 'required',
        'selectedotservicemasterlist.*.ipservicemaster_id' => 'nullable',
        'selectedotservicemasterlist.*.otservice_name' => 'required',
        'selectedotservicemasterlist.*.otservice_fee' => 'required|integer',
        'selectedotservicemasterlist.*.otservice_selffee' => 'required',
        'selectedotservicemasterlist.*.otservice_insurancefee' => 'required',
        'selectedotservicemasterlist.*.quantity' => 'required|integer',
        'selectedotservicemasterlist.*.final_amount' => 'required',
    ];

    protected $messages = [
        'selectedotservicemasterlist.*.otservice_name.required' => 'Field is required',
        'selectedotservicemasterlist.*.otservice_fee.required' => 'Field is required',
        'selectedotservicemasterlist.*.otservice_fee.integer' => 'Enter valid value',
        'selectedotservicemasterlist.*.quantity.required' => 'Field is required',
        'selectedotservicemasterlist.*.quantity.integer' => 'Enter valid value',
    ];

    public function mount($otbilling_uuid)
    {
        $this->otbillingdata = Otbilling::where('uuid', $otbilling_uuid)->first();
        $this->inpatient = $this->otbillingdata->inpatient;
        $this->otservicemasterlist = Ipservicemaster::where('active', true)->where('is_otservice', true)->get();
        $patientstatementbalance = Patientstatement::where('patient_id', $this->otbillingdata->patient_id);
        $this->balance = $patientstatementbalance->sum('debit') - $patientstatementbalance->sum('credit');
        $this->user = auth()->user();
    }

    public function updatedSearchquery()
    {
        $this->otservicemasterlist = Ipservicemaster::where('active', true)
            ->where('is_otservice', true)
            ->whereNotIn('id', collect($this->selectedotservicemasterlist)->whereNotNull('ipservicemaster_id')->pluck('ipservicemaster_id')->toArray())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function additem(Ipservicemaster $ipservicemaster)
    {
        $otservice_fee = $this->inpatient->ipadmission->billing_type == 1 ? $ipservicemaster->selffee : $ipservicemaster->insurancefee;
        $this->selectedotservicemasterlist[] = [
            'patient_id' => $this->otbillingdata->patient_id,
            'inpatient_id' => $this->otbillingdata->inpatient_id,
            'otbilling_id' => $this->otbillingdata->id,
            'otschedule_id' => $this->otbillingdata->otschedule_id,
            'ipservicemaster_id' => $ipservicemaster->id,
            'otservice_name' => $ipservicemaster->name,
            'otservice_fee' => $otservice_fee,
            'otservice_selffee' => $ipservicemaster->selffee,
            'otservice_insurancefee' => $ipservicemaster->insurancefee,
            'quantity' => 1,
            'final_amount' => $otservice_fee,
        ];
        $this->searchquery = '';
        $this->otservicemasterlist = [];
    }

    public function billingservicecalc($key)
    {
        $otservicemasterlist = $this->selectedotservicemasterlist[$key];
        $this->selectedotservicemasterlist[$key]['final_amount'] = doubleval($otservicemasterlist['otservice_fee']) * intval($otservicemasterlist['quantity']);
    }

    public function removeitem($key)
    {
        unset($this->selectedotservicemasterlist[$key]);
    }

    public function storeservice()
    {
        $validatedData = $this->validate();
        try {
            DB::beginTransaction();
            foreach ($this->selectedotservicemasterlist as $key => $value) {
                $otbillingservicelist = $this->user->otbillingservicelistcreatable()
                    ->create([
                        'patient_id' => $value['patient_id'],
                        'inpatient_id' => $value['inpatient_id'],
                        'otbilling_id' => $value['otbilling_id'],
                        'otschedule_id' => $value['otschedule_id'],
                        'ipservicemaster_id' => $value['ipservicemaster_id'],
                        'otservice_name' => $value['otservice_name'],
                        'otservice_fee' => $value['otservice_fee'],
                        'otservice_selffee' => $value['otservice_selffee'],
                        'otservice_insurancefee' => $value['otservice_insurancefee'],
                        'quantity' => $value['quantity'],
                        'final_amount' => $value['final_amount'],
                    ]);
                // Patient Statement
                $this->user->patientstatementcreatable()->make([
                    'patient_id' => $otbillingservicelist->patient_id,
                    'ipbilling_id' => $this->otbillingdata->inpatient?->ipbilling?->id,
                    'otbilling_id' => $value['otbilling_id'],
                    'credit' => 0,
                    'debit' => $value['final_amount'],
                    'self_fee' => doubleval($value['otservice_selffee']) * intval($value['quantity']),
                    'insurance_fee' => doubleval($value['otservice_insurancefee']) * intval($value['quantity']),
                    'note' => 'OT Bill Service',
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $otbillingservicelist->uniqid,
                ])
                    ->statementable()
                    ->associate($this->otbillingdata)
                    ->save();

                // Hospital Statement
                $this->user->hospitalstatementcreatable()->make([
                    'user_type' => 1,
                    'ipbilling_id' => $this->otbillingdata->inpatient?->ipbilling?->id,
                    'otbilling_id' => $value['otbilling_id'],
                    'credit' => 0,
                    'debit' => $value['final_amount'],
                    'self_fee' => doubleval($value['otservice_selffee']) * intval($value['quantity']),
                    'insurance_fee' => doubleval($value['otservice_insurancefee']) * intval($value['quantity']),
                    'note' => 'OT Bill Service',
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $otbillingservicelist->uniqid,
                ])
                    ->userable()
                    ->associate($this->otbillingdata->patient)
                    ->hstatementable()
                    ->associate($this->otbillingdata)
                    ->save();

                Helper::trackmessage($this->user, $otbillingservicelist, 'otbillingservicelistcreateoredit', session()->getId(), 'WEB', 'OT Billing Service list Created');
            }
            $subtotal = $this->otbillingdata->sub_total + collect($this->selectedotservicemasterlist)->sum('final_amount');
            $grandtotal = $subtotal - $this->otbillingdata->discount;
            $this->otbillingdata->update([
                'sub_total' => $subtotal,
                'total' => $grandtotal,
                'grand_total' => $grandtotal,
            ]);
            $this->user->otbillingupdatable()->save($this->otbillingdata);
            DB::commit();
            $this->toaster('success', 'OT Billing Service list Created Successfully!!');
            return redirect()->route('otbillingservice', $this->otbillingdata->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_otbillingservicelist_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_otbillingservicelist_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_otbillingservicelist_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function openotbilldiscount()
    {
        $this->dispatch('otbillingdiscountmodal');
    }

    // public function storediscount()
    // {
    //     $discount_validation = $this->validate([
    //         'discount' => 'required|integer',
    //         'discount_note' => 'required|max:255',
    //     ], [
    //         'discount.integer' => 'Enter valid value.',
    //     ]);
    //     try {
    //         DB::beginTransaction();
    //         $grandtotal = $this->otbillingdata->total - $discount_validation['discount'];
    //         $discount_validation['sub_total'] = $grandtotal;
    //         $discount_validation['grand_total'] = $grandtotal;
    //         $this->otbillingdata->update($discount_validation);
    //         // Patient Statement
    //         $this->user->patientstatementcreatable()->make([
    //             'patient_id' => $this->otbillingdata->patient_id,
    //             'otbilling_id' => $this->otbillingdata->id,
    //             'credit' => $this->otbillingdata->discount,
    //             'debit' => 0,
    //             'type' => 1,
    //             'note' => 'OT Bill Discount',
    //             'entity_type' => 1,
    //             'transaction_type' => 'C',
    //             'statement_ref_id' => $this->otbillingdata->uniqid,
    //         ])
    //             ->statementable()
    //             ->associate($this->otbillingdata)
    //             ->save();

    //         // Hospital Statement
    //         $this->user->hospitalstatementcreatable()->make([
    //             'user_type' => 1,
    //             'otbilling_id' => $this->otbillingdata->id,
    //             'credit' => $this->otbillingdata->discount,
    //             'debit' => 0,
    //             'type' => 1,
    //             'note' => 'OT Bill Discount',
    //             'entity_type' => 1,
    //             'transaction_type' => 'C',
    //             'statement_ref_id' => $this->otbillingdata->uniqid,
    //         ])
    //             ->userable()
    //             ->associate($this->otbillingdata->patient)
    //             ->hstatementable()
    //             ->associate($this->otbillingdata)
    //             ->save();
    //         DB::commit();
    //         $this->toaster('success', 'OT Billing Discount Submited Successfully!!');
    //         return redirect()->route('otbillingservice', $this->otbillingdata->uuid);
    //     } catch (Exception $e) {
    //         $this->exceptionerror($this->user, 'admin_otbillingdiscount_createoredit', 'error_one : ' . $e->getMessage());
    //     } catch (QueryException $e) {
    //         $this->exceptionerror($this->user, 'admin_otbillingdiscount_createoredit', 'error_two : ' . $e->getMessage());
    //     } catch (PDOException $e) {
    //         $this->exceptionerror($this->user, 'admin_otbillingdiscount_createoredit', 'error_three : ' . $e->getMessage());
    //     }
    // }

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

            // 🛑 Check if discount already exists for this OT billing
            $exists = $this->user->patientstatementcreatable()
                ->where('otbilling_id', $this->otbillingdata->id)
                ->where('note', 'OT Bill Discount')
                ->exists();

            if ($exists) {
                DB::rollBack();
                $this->toaster('warning', 'Discount already applied for this OT billing!');
                return redirect()->route('otbillingservice', $this->otbillingdata->uuid);
            }

            // ✅ Calculate new grand total
            $grandtotal = $this->otbillingdata->total - $discount_validation['discount'];

            $discount_validation['sub_total'] = $grandtotal;
            $discount_validation['grand_total'] = $grandtotal;

            // ✅ Update OT billing record
            $this->otbillingdata->update($discount_validation);

            // ✅ Create Patient Statement entry
            $this->user->patientstatementcreatable()->make([
                'patient_id' => $this->otbillingdata->patient_id,
                'otbilling_id' => $this->otbillingdata->id,
                'credit' => $discount_validation['discount'],
                'debit' => 0,
                'type' => 1,
                'note' => 'OT Bill Discount',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $this->otbillingdata->uniqid,
            ])
                ->statementable()
                ->associate($this->otbillingdata)
                ->save();

            // ✅ Create Hospital Statement entry
            $this->user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'otbilling_id' => $this->otbillingdata->id,
                'credit' => $discount_validation['discount'],
                'debit' => 0,
                'type' => 1,
                'note' => 'OT Bill Discount',
                'entity_type' => 1,
                'transaction_type' => 'C',
                'statement_ref_id' => $this->otbillingdata->uniqid,
            ])
                ->userable()
                ->associate($this->otbillingdata->patient)
                ->hstatementable()
                ->associate($this->otbillingdata)
                ->save();

            DB::commit();

            $this->toaster('success', 'OT Billing Discount Submitted Successfully!!');
            return redirect()->route('otbillingservice', $this->otbillingdata->uuid);
        } catch (Exception $e) {
            DB::rollBack();
            $this->exceptionerror($this->user, 'admin_otbillingdiscount_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            $this->exceptionerror($this->user, 'admin_otbillingdiscount_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            DB::rollBack();
            $this->exceptionerror($this->user, 'admin_otbillingdiscount_createoredit', 'error_three : ' . $e->getMessage());
        }
    }


    public function discountresetfields()
    {
        $this->discount = $this->discount_note = '';
    }

    public function printotbill($otbilling_id)
    {
        $this->dispatch('printotbill', $otbilling_id);
    }

    public function render()
    {
        $otbillingservicelist = Otbillingservicelist::where('otbilling_id', $this->otbillingdata->id)
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        if (!empty($this->selectedotservicemasterlist)) {
            $ipservicevalue = collect($this->selectedotservicemasterlist)->pluck('final_amount')->toArray();
            $total = array_sum($ipservicevalue);
        } else {
            $total = 0;
        }
        return view(
            'livewire.admin.billing.otbilling.otbillingservicelivewire',
            compact('otbillingservicelist', 'total')
        );
    }
}
