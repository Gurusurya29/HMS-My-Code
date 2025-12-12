<?php

namespace App\Http\Livewire\Pharmacy\Report\Receipt;

use App\Export\Pharmacy\Report\Receipt\PharmacyreceiptentryExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Billing\Receipt\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Receiptreportlivewire extends Component
{
    use reportlivewireTrait;

    public $patient_id, $modeofpayment;
    protected $listeners = ['patientselected'];

    public function export()
    {
        $receiptentry = $this->query()->get();
        return Excel::download(new PharmacyreceiptentryExport($receiptentry), 'receiptentryentryitem.xls');
    }

    public function pdf()
    {
        $receiptentry = $this->query()->get();
        $pdf = PDF::loadView('livewire.pharmacy.report.receipt.receiptpdf', compact('receiptentry'))
            ->setPaper('a4', 'landscape')
            ->output();
        return response()->streamDownload(fn() => print($pdf), "receiptentryentryitem.pdf");
    }

    public function patientselected($id)
    {
        $this->patient_id = $id;
    }

    protected function query()
    {
        return Receipt::where('receipt_type', 4)
            ->where(fn($query) => ($this->patient_id) ? $query->where('patient_id', $this->patient_id) : '')
            ->where(fn($query) => ($this->modeofpayment) ? $query->where('modeofpayment', $this->modeofpayment) : '')
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"]);
    }

    public function resetPage()
    {
        $this->dispatch('resetData');
        $this->patient_id = $this->modeofpayment = null;
    }

    public function render()
    {
        $receiptentry = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $totalamount = $this->query()->sum('received_amount');

        return view('livewire.pharmacy.report.receipt.receiptreportlivewire', compact('receiptentry', 'totalamount'));
    }
}
