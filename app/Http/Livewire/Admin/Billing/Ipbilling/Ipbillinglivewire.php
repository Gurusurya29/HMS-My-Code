<?php

namespace App\Http\Livewire\Admin\Billing\Ipbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Ipbillinglivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user;
    public $showdata, $ipbillingdata, $ipservicemasterlist, $searchquery, $selectedipservicemasterlist = [];
    public $payment_type = 1, $received_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $note;
    protected $listeners = ['paymentresetfields'];

    protected $rules = [
        'selectedipservicemasterlist.*.id' => 'nullable',
        'selectedipservicemasterlist.*.patient_id' => 'required',
        'selectedipservicemasterlist.*.ipbilling_id' => 'required',
        'selectedipservicemasterlist.*.ipservicemaster_id' => 'nullable',
        'selectedipservicemasterlist.*.ipservice_name' => 'required',
        'selectedipservicemasterlist.*.ipservice_fee' => 'required',
    ];

    protected $messages = [
        'selectedipservicemasterlist.*.ipservice_name.required' => 'This field is required.',
        'selectedipservicemasterlist.*.ipservice_fee.required' => 'This field is required.',
    ];

    public function mount()
    {
        $this->ipservicemasterlist = Ipservicemaster::where('active', true)->where('is_otservice', false)->get();
        $this->user = auth()->user();
    }

    public function render()
    {
        $ipbilling = Ipbilling::with('patient')->where('active', true)
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('patientvisit', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        if (!empty($this->selectedipservicemasterlist)) {
            $ipservicevalue = collect($this->selectedipservicemasterlist)->pluck('ipservice_fee')->toArray();
            $total = array_sum($ipservicevalue);
        } else {
            $total = 0;
        }

        return view('livewire.admin.billing.ipbilling.ipbillinglivewire',
            compact('ipbilling', 'total'));
    }
}
