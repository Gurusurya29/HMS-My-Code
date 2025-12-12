<?php

namespace App\Http\Livewire\Admin\Reports\Accountreports\Receiptreport;

use App\Export\Admin\Reports\Accountreport\Receiptreport\ReceiptreportExport;
use App\Models\Admin\Billing\Receipt\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Receiptreportlivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $from_date, $to_date;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $paginationlength = 10;
    public $searchTerm = null;
    public $paymentmodetype, $paymentmodetypedata = [];
    public $receipt_type, $receipt_typedata = [];

    public function mount()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
        $this->paymentmodetypedata = config('archive.modeofpayment');
        $this->receipt_typedata = config('archive.receipt_type');
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function clear()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
        $this->paymentmodetype = null;
        $this->receipt_type = null;
        $this->searchTerm = null;
        $this->resetPage();
    }

    public function export()
    {
        $receipt = $this->query()->get();
        return Excel::download(new ReceiptreportExport($receipt), 'receipt.xls');
    }

    public function pdf()
    {
        $receipt = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.accountreports.receiptreport.receiptreportpdf', compact('receipt'))->output();
        return response()->streamDownload(fn() => print($pdf), "receiptreport.pdf");
    }

    protected function query()
    {
        $paymentmodetype = $this->paymentmodetype;
        $receipt_type = $this->receipt_type;
        return Receipt::where('active', true)
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->when($paymentmodetype, function ($query, $paymentmodetype) {
                $query->where('modeofpayment', $paymentmodetype);
            })
            ->when($receipt_type, function ($query, $receipt_type) {
                $query->where('receipt_type', $receipt_type);
            })
            ->where(fn($q) =>
                $q->where('hms_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('pharm_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('lab_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('scan_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('xray_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $query) =>
                        $query->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orwhereHasMorph('creatable', '*', fn(Builder $query) =>
                        $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            );

    }

    public function render()
    {
        $receipt = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $paymentmodetype = $this->paymentmodetype;
        $receipt_type = $this->receipt_type;
        $totalreceivedamount = $this->query()->sum('received_amount');

        return view('livewire.admin.reports.accountreports.receiptreport.receiptreportlivewire', compact('receipt', 'totalreceivedamount'));
    }

}
