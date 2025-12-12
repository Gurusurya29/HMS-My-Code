<?php

namespace App\Http\Livewire\Laboratory\Receipt;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Billing\Receipt\Receipt;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Investigationreceipthistorylivewire extends Component
{
    use datatableLivewireTrait;

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
        $receipttype_id = collect(config('archive.receipt_type'))->where('maintype', 'Investigation')->pluck('id');
        $receipthistory = Receipt::with('patient')->where('active', true)
            ->whereIn('receipt_type', $receipttype_id)
            ->whereHas('patient', function (Builder $query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
                $query->orWhere('uhid', 'like', '%' . $this->searchTerm . '%');
                $query->orWhere('phone', 'like', '%' . $this->searchTerm . '%');
            })
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.laboratory.receipt.investigationreceipthistorylivewire',
            compact('receipthistory'));
    }
}
