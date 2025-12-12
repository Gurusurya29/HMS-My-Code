<?php

namespace App\Http\Livewire\Admin\Billing\Opbilling;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
class Opbillinglivewire extends Component
{
    use WithPagination;
    use datatableLivewireTrait;

    public function render()
    {
        $opbilling = Opbilling::with('patient', 'patientvisit')->where('active', true)
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

        return view('livewire.admin.billing.opbilling.opbillinglivewire',
            compact('opbilling'));
    }
}
