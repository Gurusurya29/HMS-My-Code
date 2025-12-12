<?php

namespace App\Http\Livewire\Admin\Billing\Opbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use App\Models\Admin\Settings\Opsetting\Opservicemaster;
use App\Models\Miscellaneous\Helper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;

class Opbillingaddservicelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user, $balance;
    public $showdata, $opbillingdata, $opbillinglistdata, $opservicemasterlist, $searchquery, $selectedopservicemasterlist = [], $discount, $totalbillvalue, $grandtotalvalue;
    protected $listeners = ['addserviceresetfields'];

    protected $rules = [
        'selectedopservicemasterlist.*.id' => 'nullable',
        'selectedopservicemasterlist.*.patient_id' => 'required',
        'selectedopservicemasterlist.*.opbilling_id' => 'required',
        'selectedopservicemasterlist.*.opservicemaster_id' => 'nullable',
        'selectedopservicemasterlist.*.opservice_name' => 'required',
        'selectedopservicemasterlist.*.opservice_fee' => 'required|integer',
        'selectedopservicemasterlist.*.quantity' => 'required|integer',
        'selectedopservicemasterlist.*.final_amount' => 'required',

    ];

    protected $messages = [
        'selectedopservicemasterlist.*.opservice_name.required' => 'This field is required.',
        'selectedopservicemasterlist.*.opservice_fee.required' => 'This field is required.',
        'selectedopservicemasterlist.*.quantity.required' => 'This field is required.',
        'selectedopservicemasterlist.*.opservice_fee.integer' => 'Enter valid value.',
        'selectedopservicemasterlist.*.quantity.integer' => 'Enter valid value.',
        'selectedopservicemasterlist.*.final_amount.required' => 'This field is required.',

    ];

    public function mount($opbilling_uuid)
    {
        $this->opbillingdata = Opbilling::where('uuid', $opbilling_uuid)->first();
        $this->opbillinglistdata = Opbillinglist::where('opbilling_id', $this->opbillingdata->id)->get();
        $patientstatementbalance = Patientstatement::where('patient_id', $this->opbillingdata->patient_id);
        $this->balance = $patientstatementbalance->sum('debit') - $patientstatementbalance->sum('credit');
        $this->user = auth()->user();
    }

    public function updatedSearchquery()
    {
        $this->opservicemasterlist = Opservicemaster::where('active', true)
            ->whereNotIn('id', collect($this->selectedopservicemasterlist)->whereNotNull('opservicemaster_id')->pluck('opservicemaster_id')->toArray())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function additem(Opservicemaster $opservicemaster = null)
    {
        $opservicefee = $this->opbillingdata->patientvisit->billing_type == 1 ? $opservicemaster->selffee : $opservicemaster->insurancefee;
        $this->selectedopservicemasterlist[] = [
            'patient_id' => $this->opbillingdata->patient_id,
            'opbilling_id' => $this->opbillingdata->id,
            'opservicemaster_id' => $opservicemaster->id ?? null,
            'opservice_name' => $opservicemaster->name ?? null,
            'opservice_fee' => $opservicefee ?? 0,
            'opservice_selffee' => $opservicemaster->selffee ?? 0,
            'opservice_insurancefee' => $opservicemaster->insurancefee ?? 0,
            'quantity' => 1,
            'final_amount' => $opservicefee ?? 0,
        ];
        $this->searchquery = '';
        $this->opservicemasterlist = [];
    }

    public function removeitem($key)
    {
        unset($this->selectedopservicemasterlist[$key]);
    }

    public function billingservicecalc($key)
    {
        $opservicemasterlist = $this->selectedopservicemasterlist[$key];
        $this->selectedopservicemasterlist[$key]['final_amount'] = doubleval($opservicemasterlist['opservice_fee']) * intval($opservicemasterlist['quantity']);
    }

    // public function storeservice()
    // {
    //     $validatedData = $this->validate();
    //     $opbillinglistvalidation = $this->validate([
    //         'totalbillvalue' => 'required',
    //         'discount' => 'nullable|numeric|integer|lte:' . $this->totalbillvalue,
    //         'grandtotalvalue' => 'required',
    //     ], [
    //         'discount.integer' => 'Enter valid value.',
    //     ]);
    //     try {
    //         DB::beginTransaction();
    //         $opbillinglist = $this->user->opbillinglistcreatable()->create([
    //             'patient_id' => $this->opbillingdata->patient_id,
    //             'opbilling_id' => $this->opbillingdata->id,
    //             'sub_total' => $opbillinglistvalidation['totalbillvalue'],
    //             'discount' => intval($opbillinglistvalidation['discount']),
    //             'total' => $opbillinglistvalidation['grandtotalvalue'],
    //             'billdiscount_amount' => 0,
    //             'grand_total' => $opbillinglistvalidation['grandtotalvalue'],
    //         ]);
    //         foreach ($this->selectedopservicemasterlist as $key => $value) {
    //             if (empty($value['id'])) {
    //                 $opbillingservicelist = $this->user->opbillingservicelistcreatable()
    //                     ->create([
    //                         'patient_id' => $value['patient_id'],
    //                         'opbilling_id' => $value['opbilling_id'],
    //                         'opbillinglist_id' => $opbillinglist->id,
    //                         'opservicemaster_id' => $value['opservicemaster_id'],
    //                         'opservice_name' => $value['opservice_name'],
    //                         'opservice_fee' => $value['opservice_fee'],
    //                         'opservice_selffee' => $value['opservice_selffee'] != 0 ? $value['opservice_selffee'] : $value['opservice_fee'],
    //                         'opservice_insurancefee' => $value['opservice_insurancefee'] != 0 ? $value['opservice_insurancefee'] : $value['opservice_fee'],
    //                         'quantity' => $value['quantity'],
    //                         'final_amount' => $value['final_amount'],
    //                     ]);
    //                 Helper::trackmessage($this->user, $opbillingservicelist, 'opbillingservicelistcreateoredit', session()->getId(), 'WEB', 'OP Billing Service list Created');
    //             }
    //         }
    //         // Patient Statement
    //         $this->user->patientstatementcreatable()->make([
    //             'patient_id' => $this->opbillingdata->patient_id,
    //             'opbilling_id' => $this->opbillingdata->id,
    //             'credit' => 0,
    //             'debit' => $opbillinglist->grand_total,
    //             'self_fee' => $value['opservice_selffee'] != 0 ? (doubleval($value['opservice_selffee']) * intval($value['quantity'])) : $value['final_amount'],
    //             'insurance_fee' => $value['opservice_insurancefee'] != 0 ? (doubleval($value['opservice_insurancefee']) * intval($value['quantity'])) : $value['final_amount'],
    //             'note' => 'OP Service',
    //             'entity_type' => 1,
    //             'transaction_type' => 'D',
    //             'statement_ref_id' => $opbillinglist->uniqid,
    //         ])
    //             ->statementable()
    //             ->associate($this->opbillingdata)
    //             ->save();

    //         // Hospital Statement
    //         $this->user->hospitalstatementcreatable()->make([
    //             'user_type' => 1,
    //             'opbilling_id' => $this->opbillingdata->id,
    //             'credit' => 0,
    //             'debit' => $opbillinglist->grand_total,
    //             'self_fee' => $value['opservice_selffee'] != 0 ? (doubleval($value['opservice_selffee']) * intval($value['quantity'])) : $value['final_amount'],
    //             'insurance_fee' => $value['opservice_insurancefee'] != 0 ? (doubleval($value['opservice_insurancefee']) * intval($value['quantity'])) : $value['final_amount'],
    //             'note' => 'OP Service',
    //             'entity_type' => 1,
    //             'transaction_type' => 'D',
    //             'statement_ref_id' => $opbillinglist->uniqid,
    //         ])
    //             ->userable()
    //             ->associate($this->opbillingdata->patient)
    //             ->hstatementable()
    //             ->associate($this->opbillingdata)
    //             ->save();

    //         $this->toaster('success', 'OP Billing Service list Created Successfully!!');
    //         DB::commit();
    //         $this->selectedopservicemasterlist = [];
    //         $this->printbillinglist($opbillinglist->id);
    //         return redirect()->route('opbillingaddservice', $this->opbillingdata->uuid);
    //     } catch (Exception $e) {
    //         $this->exceptionerror($this->user, 'admin_opbillingservicelist_createoredit', 'error_one : ' . $e->getMessage());
    //     } catch (QueryException $e) {
    //         $this->exceptionerror($this->user, 'admin_opbillingservicelist_createoredit', 'error_two : ' . $e->getMessage());
    //     } catch (PDOException $e) {
    //         $this->exceptionerror($this->user, 'admin_opbillingservicelist_createoredit', 'error_three : ' . $e->getMessage());
    //     }
    // }


    public function storeservice()
{
    $validatedData = $this->validate();

    $opbillinglistvalidation = $this->validate([
        'totalbillvalue' => 'required',
        'discount' => 'nullable|numeric|integer|lte:' . $this->totalbillvalue,
        'grandtotalvalue' => 'required',
    ], [
        'discount.integer' => 'Enter valid value.',
    ]);

    try {
        DB::beginTransaction();

        // ✅ Create new OP Billing List
        $opbillinglist = $this->user->opbillinglistcreatable()->create([
            'patient_id' => $this->opbillingdata->patient_id,
            'opbilling_id' => $this->opbillingdata->id,
            'sub_total' => $opbillinglistvalidation['totalbillvalue'],
            'discount' => intval($opbillinglistvalidation['discount']),
            'total' => $opbillinglistvalidation['grandtotalvalue'],
            'billdiscount_amount' => 0,
            'grand_total' => $opbillinglistvalidation['grandtotalvalue'],
        ]);

        // ✅ Track total self & insurance fee
        $totalSelfFee = 0;
        $totalInsuranceFee = 0;

        foreach ($this->selectedopservicemasterlist as $key => $value) {

            // ✅ Check for duplicates (same opbilling + same service)
            $existingService = $this->user->opbillingservicelistcreatable()
                ->where('opbilling_id', $value['opbilling_id'])
                ->where('opservicemaster_id', $value['opservicemaster_id'])
                ->first();

            if ($existingService) {
                // ✅ If exists, update quantity and final amount
                $newQuantity = $existingService->quantity + intval($value['quantity']);
                $newFinalAmount = doubleval($value['opservice_fee']) * $newQuantity;

                $existingService->update([
                    'quantity' => $newQuantity,
                    'final_amount' => $newFinalAmount,
                ]);
                continue; // Skip duplicate creation
            }

            // ✅ Create new service record
            $opbillingservicelist = $this->user->opbillingservicelistcreatable()->create([
                'patient_id' => $value['patient_id'],
                'opbilling_id' => $value['opbilling_id'],
                'opbillinglist_id' => $opbillinglist->id,
                'opservicemaster_id' => $value['opservicemaster_id'],
                'opservice_name' => $value['opservice_name'],
                'opservice_fee' => $value['opservice_fee'],
                'opservice_selffee' => $value['opservice_selffee'] != 0 ? $value['opservice_selffee'] : $value['opservice_fee'],
                'opservice_insurancefee' => $value['opservice_insurancefee'] != 0 ? $value['opservice_insurancefee'] : $value['opservice_fee'],
                'quantity' => $value['quantity'],
                'final_amount' => $value['final_amount'],
            ]);

            // ✅ Track total for statements
            $totalSelfFee += doubleval($value['opservice_selffee']) * intval($value['quantity']);
            $totalInsuranceFee += doubleval($value['opservice_insurancefee']) * intval($value['quantity']);

            Helper::trackmessage($this->user, $opbillingservicelist, 'opbillingservicelistcreateoredit', session()->getId(), 'WEB', 'OP Billing Service list Created');
        }

        // ✅ Create Patient Statement
        $this->user->patientstatementcreatable()->make([
            'patient_id' => $this->opbillingdata->patient_id,
            'opbilling_id' => $this->opbillingdata->id,
            'credit' => 0,
            'debit' => $opbillinglist->grand_total,
            'self_fee' => $totalSelfFee,
            'insurance_fee' => $totalInsuranceFee,
            'note' => 'OP Service',
            'entity_type' => 1,
            'transaction_type' => 'D',
            'statement_ref_id' => $opbillinglist->uniqid,
        ])
            ->statementable()
            ->associate($this->opbillingdata)
            ->save();

        // ✅ Create Hospital Statement
        $this->user->hospitalstatementcreatable()->make([
            'user_type' => 1,
            'opbilling_id' => $this->opbillingdata->id,
            'credit' => 0,
            'debit' => $opbillinglist->grand_total,
            'self_fee' => $totalSelfFee,
            'insurance_fee' => $totalInsuranceFee,
            'note' => 'OP Service',
            'entity_type' => 1,
            'transaction_type' => 'D',
            'statement_ref_id' => $opbillinglist->uniqid,
        ])
            ->userable()
            ->associate($this->opbillingdata->patient)
            ->hstatementable()
            ->associate($this->opbillingdata)
            ->save();

        DB::commit();

        $this->toaster('success', 'OP Billing Service list Created/Updated Successfully!!');
        $this->selectedopservicemasterlist = [];
        $this->printbillinglist($opbillinglist->id);
        return redirect()->route('opbillingaddservice', $this->opbillingdata->uuid);

    } catch (Exception $e) {
        DB::rollBack();
        $this->exceptionerror($this->user, 'admin_opbillingservicelist_createoredit', 'error_one : ' . $e->getMessage());
    } catch (QueryException $e) {
        DB::rollBack();
        $this->exceptionerror($this->user, 'admin_opbillingservicelist_createoredit', 'error_two : ' . $e->getMessage());
    } catch (PDOException $e) {
        DB::rollBack();
        $this->exceptionerror($this->user, 'admin_opbillingservicelist_createoredit', 'error_three : ' . $e->getMessage());
    }
}
    public function updatedDiscount()
    {
        $this->validate([
            'discount' => 'numeric|integer|lte:' . $this->totalbillvalue,
        ], [
            'discount.integer' => 'Enter valid value.',
        ]);
    }

    public function printbillinglist($opbillinglist_id)
    {
        $this->dispatch('printbillinglist', $opbillinglist_id);
    }

    public function downloadopbilling(Opbillinglist $opbillinglist)
    {
        $pdf = Pdf::loadView(
            'livewire.admin.billing.opbilling.opbillinglistpdf',
            compact('opbillinglist')
        )
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), 'bill.pdf');
    }

    public function addserviceresetfields()
    {
        $this->searchquery = '';
        $this->opservicemasterlist = [];
        $this->selectedopservicemasterlist = [];
        $this->discount = '';
        $this->totalbillvalue = '';
        $this->grandtotalvalue = '';
    }

    public function render()
    {
        if (!empty($this->selectedopservicemasterlist)) {
            $finalamount = collect($this->selectedopservicemasterlist)->pluck('final_amount')->toArray();
            if ($this->discount) {
                $total = array_sum($finalamount);
                $grandtotal = $total - $this->discount;
            } else {
                $total = array_sum($finalamount);
                $grandtotal = array_sum($finalamount);
            }
        } else {
            $total = 0;
            $grandtotal = 0;
        }

        $this->totalbillvalue = $total;
        $this->grandtotalvalue = $grandtotal;

        return view(
            'livewire.admin.billing.opbilling.opbillingaddservicelivewire',
            compact('total', 'grandtotal')
        );
    }
}
