<?php

namespace App\Http\Livewire\Admin\Billing\Receipt\Receipthistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Billing\Receipt\Receipt;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Receipthistorylivewire extends Component
{
    use datatableLivewireTrait;
    public $searchquery;
    public $showdata;

    protected function databind($receiptid, $type)
    {
        $this->showdata = Receipt::find($receiptid);
    }

    public function printreceiptentry(Receipt $receipt)
    {
        $this->dispatch('printreceiptentry', $receipt->id);
    }

    public function render()
    {
        $receipthistory = Receipt::with('patient')
            ->where('active', true)
            ->where(fn($q) =>
                $q->where('hms_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('pharm_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('lab_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('scan_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('xray_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.billing.receipt.receipthistory.receipthistorylivewire', compact('receipthistory'));
    }
}
