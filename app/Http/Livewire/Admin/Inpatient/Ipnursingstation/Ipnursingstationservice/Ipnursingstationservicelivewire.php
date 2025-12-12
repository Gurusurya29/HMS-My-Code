<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipnursingstation\Ipnursingstationservice;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipassesment;
use App\Models\Admin\Inpatient\Ipnursingstation;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ipnursingstationservicelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $inpatient, $user, $showdata;
    public $ipservicemasterlist, $searchquery, $selectedipservicemasterlist = [];
    // public $patient_id, $inpatient_id, $ipservicemaster_id, $ipservice_name, $quantity, $ipservice_fee, $final_amount;

    protected $rules = [
        'selectedipservicemasterlist.*.patient_id' => 'required',
        'selectedipservicemasterlist.*.inpatient_id' => 'required',
        'selectedipservicemasterlist.*.ipservicecategory_id' => 'nullable',
        'selectedipservicemasterlist.*.ipservicecategory_name' => 'nullable',
        'selectedipservicemasterlist.*.ipservicemaster_id' => 'nullable',
        'selectedipservicemasterlist.*.ipservice_name' => 'required',
        'selectedipservicemasterlist.*.ipservice_fee' => 'required',
        'selectedipservicemasterlist.*.ipservice_selffee' => 'required',
        'selectedipservicemasterlist.*.ipservice_insurancefee' => 'required',
        'selectedipservicemasterlist.*.quantity' => 'required',
        'selectedipservicemasterlist.*.final_amount' => 'required',
    ];

    public function mount($inpatient_uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->user = auth()->user();
    }

    public function updatedSearchquery()
    {
        $this->ipservicemasterlist = Ipservicemaster::where('active', true)
            ->whereNotIn('id', collect($this->selectedipservicemasterlist)->pluck('ipservicemaster_id'))
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    protected function databind($Ipassesmentid, $type)
    {
        $this->showdata = Ipassesment::find($Ipassesmentid);
    }

    public function additem(Ipservicemaster $ipservicemaster)
    {
        $ipservice_fee = $this->inpatient->ipadmission->billing_type == 1 ? $ipservicemaster->selffee : $ipservicemaster->insurancefee;
        $this->selectedipservicemasterlist[] = [
            'patient_id' => $this->inpatient->patient_id,
            'inpatient_id' => $this->inpatient->id,
            'ipservicecategory_id' => $ipservicemaster->ipservicecategory->id,
            'ipservicecategory_name' => $ipservicemaster->ipservicecategory->name,
            'ipservicemaster_id' => $ipservicemaster->id,
            'ipservice_name' => $ipservicemaster->name,
            'ipservice_fee' => $ipservice_fee,
            'ipservice_selffee' => $ipservicemaster->selffee,
            'ipservice_insurancefee' => $ipservicemaster->insurancefee,
            'quantity' => 1,
            'final_amount' => $ipservice_fee,
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

    public function storeservice()
    {
        $validatedData = $this->validate();
        try {
            DB::beginTransaction();

            foreach ($this->selectedipservicemasterlist as $key => $value) {
                $ipnursingstation = $this->user->ipnursingstationcreatable()
                    ->create([
                        'patient_id' => $value['patient_id'],
                        'inpatient_id' => $value['inpatient_id'],
                        'ipadmission_id' => $this->inpatient->ipadmission->id,
                        'ipservicecategory_id' => $value['ipservicecategory_id'],
                        'ipservicecategory_name' => $value['ipservicecategory_name'],
                        'ipservicemaster_id' => $value['ipservicemaster_id'],
                        'ipservice_name' => $value['ipservice_name'],
                        'quantity' => $value['quantity'],
                    ]);

                $this->user->ipbillingservicelistcreatable()
                    ->create([
                        'patient_id' => $value['patient_id'],
                        'inpatient_id' => $value['inpatient_id'],
                        'ipbilling_id' => $this->inpatient->ipadmission->ipbilling_id,
                        'ipadmission_id' => $this->inpatient->ipadmission->id,
                        'ipservicemaster_id' => $value['ipservicemaster_id'],
                        'ipservicecategory_id' => $value['ipservicecategory_id'],
                        'ipnursingstation_id' => $ipnursingstation->id,
                        'ipservicecategory_name' => $value['ipservicecategory_name'],
                        'ipservice_name' => $value['ipservice_name'],
                        'ipservice_fee' => $value['ipservice_fee'],
                        'ipservice_selffee' => $value['ipservice_selffee'],
                        'ipservice_insurancefee' => $value['ipservice_insurancefee'],
                        'quantity' => $value['quantity'],
                        'final_amount' => $value['final_amount'],
                    ]);

                // Patient Statement
                $this->user->patientstatementcreatable()->make([
                    'patient_id' => $ipnursingstation->patient_id,
                    'ipbilling_id' => $this->inpatient->ipadmission->ipbilling_id,
                    'credit' => 0,
                    'debit' => $value['final_amount'],
                    'self_fee' => doubleval($value['ipservice_selffee']) * intval($value['quantity']),
                    'insurance_fee' => doubleval($value['ipservice_insurancefee']) * intval($value['quantity']),
                    'note' => 'IP Nursing Station',
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $ipnursingstation->uniqid,
                ])
                    ->statementable()
                    ->associate($ipnursingstation)
                    ->save();

                // Hospital Statement
                $this->user->hospitalstatementcreatable()->make([
                    'user_type' => 1,
                    'ipbilling_id' => $this->inpatient->ipadmission->ipbilling_id,
                    'credit' => 0,
                    'debit' => $value['final_amount'],
                    'self_fee' => doubleval($value['ipservice_selffee']) * intval($value['quantity']),
                    'insurance_fee' => doubleval($value['ipservice_insurancefee']) * intval($value['quantity']),
                    'note' => 'IP Nursing Station',
                    'entity_type' => 1,
                    'transaction_type' => 'D',
                    'statement_ref_id' => $ipnursingstation->uniqid,
                ])
                    ->userable()
                    ->associate($this->inpatient->patient)
                    ->hstatementable()
                    ->associate($ipnursingstation)
                    ->save();

                Helper::trackmessage($this->user, $ipnursingstation, 'ipnursingstationcreateoredit', session()->getId(), 'WEB', 'IP Nursing Station Service Created');
            }

            $ipbilling = Ipbilling::find($this->inpatient->ipadmission->ipbilling_id);
            $subtotal = $ipbilling->sub_total + collect($this->selectedipservicemasterlist)->sum('final_amount');
            $grandtotal = $subtotal - $ipbilling->discount;
            $ipbilling->update([
                'sub_total' => $subtotal,
                'total' => $grandtotal,
                'grand_total' => $grandtotal,
            ]);

            $this->toaster('success', 'IP Service list Created Successfully!!');
            DB::commit();
            $this->selectedipservicemasterlist = [];
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_ipbillingservicelist_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_ipbillingservicelist_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_ipbillingservicelist_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function downloadFile($ip_uniqid, $file_name)
    {
        $file = storage_path('app/public/admin/ipassesment/' . $ip_uniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function printipprescription(Ipassesment $ipassessment)
    {
        $this->dispatch('printipprescription', $ipassessment->id);
    }

    public function printipinvestigation(Ipassesment $ipassessment)
    {
        $this->dispatch('printipinvestigation', $ipassessment->id);
    }
    public function printipinvestigationresult(Ipassesment $ipassessment)
    {
        $this->dispatch('printipinvestigationresult', $ipassessment->id);
    }
    public function render()
    {
        $ipnursingstationlist = Ipnursingstation::where('inpatient_id', $this->inpatient->id)
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        $ipassesmentlist = Ipassesment::where('inpatient_id', $this->inpatient->id)
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.inpatient.ipnursingstation.ipnursingstationservice.ipnursingstationservicelivewire', compact('ipnursingstationlist', 'ipassesmentlist'));
    }
}
