<?php

namespace App\Http\Livewire\Pharmacy\Report\Paymentvoucher;

use App\Export\Pharmacy\Report\Payment\PharmacypaymentvoucherExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Paymentvoucherreportlivewire extends Component
{
    use reportlivewireTrait;

    public $modeofpayment, $payment_to;

    public function export()
    {
        $paymentvoucher = $this->query()->get();
        return Excel::download(new PharmacypaymentvoucherExport($paymentvoucher), 'paymentvoucher.xls');
    }

    public function pdf()
    {
        $paymentvoucher = $this->query()->get();
        $pdf = PDF::loadView('livewire.pharmacy.report.paymentvoucher.paymentvoucherpdf', compact('paymentvoucher'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "paymentvoucher.pdf");
    }

    protected function query()
    {
        return Paymentvoucher::where(fn($query) => ($this->modeofpayment) ? $query->where('modeofpayment', $this->modeofpayment) : '')
            ->where(fn($query) => ($this->payment_to) ? $query->where('payment_to', $this->payment_to) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
    }

    public function resetPage()
    {
        $this->dispatch('resetData');
        $this->modeofpayment = $this->payment_to = null;
    }

    public function render()
    {
        $paymentvoucher = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $totalamt = $this->query()->sum('paid_amount');

        return view('livewire.pharmacy.report.paymentvoucher.paymentvoucherreportlivewire', compact('paymentvoucher', 'totalamt'));
    }
}
