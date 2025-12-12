<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseentry;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Purchaseentryindexlivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata = false;

    protected function databind($pharmacypurchaseentry_id, $type)
    {
        $this->showdata = Pharmpurchaseentry::find($pharmacypurchaseentry_id);
    }

    public function additionalitems()
    {
        $pharmpurchaseentry = Pharmpurchaseentry::where('pharmpurchaseorder_id', $this->showdata->pharmpurchaseorder_id)
            ->first();
        if ($pharmpurchaseentry) {
            return $pharmpurchaseentry;
        } else {
            return null;
        }
    }

    public function printpurchaseentry(Pharmpurchaseentry $purchaseentry)
    {
        $this->dispatch('printpurchaseentry', $purchaseentry->id);
    }

    public function render()
    {
        $pharmacypurchaseentry = Pharmpurchaseentry::query()
            ->where(function ($query) {
                $query->where('purchaseorder_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('supplier', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('company_name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('contact_phone_no', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('contact_mobile_no', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('company_person_name', 'like', '%' . $this->searchTerm . '%')
                    );
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.purchase.purchaseentry.purchaseentryindexlivewire',
            compact('pharmacypurchaseentry'));
    }
}
