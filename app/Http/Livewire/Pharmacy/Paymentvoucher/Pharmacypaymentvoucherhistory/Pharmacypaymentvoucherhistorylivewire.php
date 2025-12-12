<?php

namespace App\Http\Livewire\Pharmacy\Paymentvoucher\Pharmacypaymentvoucherhistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Admin\Employee\Employee;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Patient\Auth\Patient;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Pharmacypaymentvoucherhistorylivewire extends Component
{
    use datatableLivewireTrait;
    public $searchquery;
    public $showdata;

    protected function databind($paymentvoucherid, $type)
    {
        $this->showdata = Paymentvoucher::find($paymentvoucherid);
    }

    public function printpaymentvoucherentry(Paymentvoucher $paymentvoucher)
    {
        $this->dispatch('printpaymentvoucherentry', $paymentvoucher->id);
    }

    public function render()
    {
        $paymentvoucherhistory = Paymentvoucher::where('active', true)
            ->whereIn('payment_type', [4])
            ->where(fn($q) =>
                $q->where('pharm_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHasMorph('paymentable',
                        [Patient::class, Employee::class, Supplier::class],
                        function (Builder $query, $type) {
                            $idcolumn = $type === Patient::class ? 'uhid' : 'uniqid';
                            $namecolumn = $type === Supplier::class ? 'company_name' : 'name';
                            $phonecolumn = $type === Supplier::class ? 'contact_mobile_no' : 'phone';
                            $query->where($namecolumn, 'like', '%' . $this->searchTerm . '%');
                            $query->orWhere($idcolumn, 'like', '%' . $this->searchTerm . '%');
                            $query->orWhere($phonecolumn, 'like', '%' . $this->searchTerm . '%');
                        })
            )
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.paymentvoucher.pharmacypaymentvoucherhistory.pharmacypaymentvoucherhistorylivewire', compact('paymentvoucherhistory'));
    }
}
