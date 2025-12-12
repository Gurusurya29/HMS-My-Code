<?php

namespace App\Http\Livewire\Admin\Reports\Accountreports\Employeestatementreport;

use App\Export\Admin\Reports\Accountreport\Employeestatementreport\EmployeestatementreportExport;
use App\Http\Livewire\Livewirehelper\Report\reportlivewireTrait;
use App\Models\Admin\Account\Employee\Employeestatement;
use App\Models\Admin\Employee\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Employeestatementreportlivewire extends Component
{
    use reportlivewireTrait;

    public $searchquery, $employee, $employeelist = [];

    public function updatedSearchquery()
    {
        $this->employeelist = Employee::where('active', true)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function selectedemployee(Employee $employee)
    {
        $this->employee = $employee;
        $this->searchquery = '';
    }

    public function export()
    {
        $employeestatement = $this->query()->get();
        return Excel::download(new EmployeestatementreportExport($employeestatement), 'employeestatement.xls');
    }

    public function pdf()
    {
        $employeestatement = $this->query()->get();
        $pdf = PDF::loadView('livewire.admin.reports.accountreports.employeestatementreport.employeestatementreportpdf', compact('employeestatement'))->output();
        return response()->streamDownload(fn() => print($pdf), "employeestatement.pdf");
    }

    protected function query()
    {
        return Employeestatement::where('employee_id', $this->employee->id)->whereBetween('created_at', [$this->from_date . " 00:00:00", $this->to_date . " 23:59:59"])
            ->where(fn($q) =>
                $q->where('statement_ref_id', 'like', '%' . $this->searchTerm . '%')
            );
    }

    public function render()
    {
        if ($this->employee) {
            $employeestatement = $this->query()
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->paginationlength)
                ->onEachSide(1);
            $balance_statement = $this->query()->get();
            $balance = $this->query()->sum('debit') - $this->query()->sum('credit');
        } else {
            $employeestatement = null;
            $balance_statement = [];
            $balance = '';
        }

        return view('livewire.admin.reports.accountreports.employeestatementreport.employeestatementreportlivewire', compact('employeestatement', 'balance', 'balance_statement'));
    }
}
