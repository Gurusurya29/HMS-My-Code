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

    /

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
