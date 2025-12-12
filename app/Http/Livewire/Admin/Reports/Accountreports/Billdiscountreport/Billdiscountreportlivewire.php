<?php

namespace App\Http\Livewire\Admin\Reports\Accountreports\Billdiscountreport;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Database\Query\Builder;
use App\Models\Admin\Billing\Billdiscount\Billdiscount;
use App\Export\Admin\Reports\Accountreport\Billdiscountreport\BilldiscountreportExport;

class Billdiscountreportlivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $from_date, $to_date;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $paginationlength = 10;
    public $searchTerm = null;
    public $discounttype, $discounttypedata = [];
    public $bill_type, $bill_typedata = [];

    public function mount()
    {
        $this->from_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->to_date = Carbon::tomorrow()->format('Y-m-d');
        $this->discounttypedata = config('archive.discount_type');
        $this->bill_typedata = collect(config('archive.bill_type'))->where('maintype', 'HMS')->toArray();
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
        $this->discounttype = null;
        $this->bill_type = null;
        $this->searchTerm = null;
        $this->resetPage();
    }

    public function export()
    {
        $billdiscount = $this->query()->get();
        return Excel::download(new BilldiscountreportExport($billdiscount), 'billdiscount.xls');
    }

    public function pdf()
    {
        $billdiscount = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.accountreports.billdiscountreport.billdiscountreportpdf', compact('billdiscount'))->output();
        return response()->streamDownload(fn() => print($pdf), "billdiscountreport.pdf");
    }

    protected function query()
    {
        $discounttype = $this->discounttype;
        $bill_type = $this->bill_type;
        return Billdiscount::where('active', true)
            ->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->when($discounttype, function ($query, $discounttype) {
                $query->where('discount_type', $discounttype);
            })
            ->when($bill_type, function ($query, $bill_type) {
                $query->where('bill_type', $bill_type);
            })
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $query) =>
                        $query->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orwhereHasMorph('billdiscountable', '*', fn(Builder $query) =>
                        $query->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orwhereHasMorph('creatable', '*', fn(Builder $query) =>
                        $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            );

    }

    public function render()
    {
        $billdiscount = $this->query()
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        $totaldiscountamount = $this->query()->sum('discount_amount');

        return view('livewire.admin.reports.accountreports.billdiscountreport.billdiscountreportlivewire', compact('billdiscount', 'totaldiscountamount'));
    }

}
