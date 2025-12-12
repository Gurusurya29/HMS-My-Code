<?php

namespace App\Http\Livewire\Admin\Reports\Accountreports\Supplierstatementreport;

use App\Export\Admin\Reports\Accountreport\Supplierstatementreport\SupplierstatementreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Account\Supplier\Supplierstatement;
use App\Models\Admin\Settings\Supplier\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Supplierstatementreportlivewire extends Component
{
    use reportlivewireTrait;

    public $searchquery, $supplier, $supplierlist = [];

    public function updatedSearchquery()
    {
        $this->supplierlist = Supplier::where('active', true)
            ->where(fn($q) =>
                $q->where('company_name', 'like', '%' . $this->searchquery . '%')
                    ->orWhere('company_person_name', 'like', '%' . $this->searchquery . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchquery . '%')
            )
            ->take(10)
            ->get()
            ->toArray();
    }

    public function selectedsupplier(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->searchquery = '';
    }

    public function export()
    {
        $supplierstatement = $this->query()->get();
        return Excel::download(new SupplierstatementreportExport($supplierstatement), 'supplierstatement.xls');
    }

    public function pdf()
    {
        $supplierstatement = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.accountreports.supplierstatementreport.supplierstatementreportpdf', compact('supplierstatement'))->output();
        return response()->streamDownload(fn() => print($pdf), "supplierstatement.pdf");
    }

    protected function query()
    {
        return Supplierstatement::where('supplier_id', $this->supplier->id)->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('statement_ref_id', 'like', '%' . $this->searchTerm . '%')
            );
    }

    public function render()
    {
        if ($this->supplier) {
            $supplierstatement = $this->query()
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationlength)
                ->onEachSide(1);
            $balance_statement = $this->query()->get();
            $balance = $this->query()->sum('debit') - $this->query()->sum('credit');
        } else {
            $supplierstatement = null;
            $balance_statement = [];
            $balance = '';
        }

        return view('livewire.admin.reports.accountreports.supplierstatementreport.supplierstatementreportlivewire', compact('supplierstatement', 'balance', 'balance_statement'));
    }
}
