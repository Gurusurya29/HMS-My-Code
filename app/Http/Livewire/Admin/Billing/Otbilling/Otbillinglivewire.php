<?php

namespace App\Http\Livewire\Admin\Billing\Otbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Billing\Otbilling\Otbilling;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Otbillinglivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $user;
    public $showdata, $ipbillingdata, $otservicemasterlist, $searchquery, $selectedotservicemasterlist = [];
    public $payment_type = 1, $received_amount, $modeofpayment, $payment_ref_id, $bank_name, $payment_date, $note;
    protected $listeners = ['paymentresetfields'];

    protected $rules = [
        'selectedotservicemasterlist.*.id' => 'nullable',
        'selectedotservicemasterlist.*.patient_id' => 'required',
        'selectedotservicemasterlist.*.otbilling_id' => 'required',
        'selectedotservicemasterlist.*.ipservicemaster_id' => 'nullable',
        'selectedotservicemasterlist.*.otservice_name' => 'required',
        'selectedotservicemasterlist.*.otservice_fee' => 'required',
    ];

    protected $messages = [
        'selectedotservicemasterlist.*.otservice_name.required' => 'This field is required.',
        'selectedotservicemasterlist.*.otservice_fee.required' => 'This field is required.',
    ];

    public function mount()
    {
        $this->otservicemasterlist = Ipservicemaster::where('active', true)->where('is_otservice', true)->get();
        $this->user = auth()->user();
    }

    public function render()
    {
        $otbilling = Otbilling::with('patient')->where('active', true)
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
        if (!empty($this->selectedotservicemasterlist)) {
            $otervicevalue = collect($this->selectedotservicemasterlist)->pluck('otervice_fee')->toArray();
            $total = array_sum($otervicevalue);
        } else {
            $total = 0;
        }

        return view('livewire.admin.billing.otbilling.otbillinglivewire',
            compact('otbilling', 'total'));
    }
}
