<?php

namespace App\Http\Livewire\Admin\Billing\Billdiscount\Billdiscounthistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Billing\Billdiscount\Billdiscount;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Billdiscounthistorylivewire extends Component
{
    use datatableLivewireTrait;
    public $searchquery;
    public $showdata;

    protected function databind($billdiscountid, $type)
    {
        $this->showdata = Billdiscount::find($billdiscountid);
    }

    public function render()
    {
        $billdiscounthistory = Billdiscount::with('patient')
            ->where('active', true)
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHasMorph('billdiscountable', '*', function (Builder $query) {
                        $query->where('uniqid', 'like', '%' . $this->searchTerm . '%');
                    })
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.billing.billdiscount.billdiscounthistory.billdiscounthistorylivewire', compact('billdiscounthistory'));
    }
}
