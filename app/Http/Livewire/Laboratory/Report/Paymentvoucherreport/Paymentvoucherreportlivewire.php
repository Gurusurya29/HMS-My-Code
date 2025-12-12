<?php

namespace App\Http\Livewire\Laboratory\Report\Paymentvoucherreport;

use App\Export\Inverstigation\Paymentvoucher\LabpaymentvoucherreportExport;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Admin\Employee\Employee;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Patient\Auth\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Paymentvoucherreportlivewire extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $from_date, $to_date;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $paginationlength = 10;
    public $searchTerm = null;
    public $paymentmodetype, $paymentmodetypedata = [];
    public $payment_type, $payment_typedata = [];

    public function mount()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
        $this->paymentmodetypedata = config('archive.modeofpayment');
        $this->payment_typedata = collect(config('archive.receipt_type'))->where('maintype', 'Investigation')->toArray();
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
        $this->payment_type = null;
        $this->searchTerm = null;
        $this->resetPage();
    }

    public function export()
    {
        $paymentvoucher = $this->query()->get();
        return Excel::download(new LabpaymentvoucherreportExport($paymentvoucher), 'paymentvoucher.xls');
    }

    public function pdf()
    {
        $paymentvoucher = $this->query()->get();
        $pdf = PDF::loadView('livewire.laboratory.report.paymentvoucherreport.paymentvoucherreportpdf', compact('paymentvoucher'))->output();
        return response()->streamDownload(fn() => print($pdf), "paymentvoucherreport.pdf");
    }

    protected function query()
    {
        $paymentmodetype = $this->paymentmodetype;
        $payment_type = $this->payment_type;
        return Paymentvoucher::whereIn('payment_type', collect($this->payment_typedata)->pluck('id'))
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->when($paymentmodetype, function ($query, $paymentmodetype) {
                $query->where('modeofpayment', $paymentmodetype);
            })
            ->when($payment_type, function ($query, $payment_type) {
                $query->where('payment_type', $payment_type);
            })
            ->where(fn($q) =>
                $q->where('hms_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('pharm_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('lab_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('scan_uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('xray_uniqid', 'like', '%' . $this->searchTerm . '%')
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
            );
    }

    public function render()
    {
        $paymentvoucher = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        $totalpaidamount = $this->query()->sum('paid_amount');

        return view('livewire.laboratory.report.paymentvoucherreport.paymentvoucherreportlivewire', compact('paymentvoucher', 'totalpaidamount'));
    }
}
