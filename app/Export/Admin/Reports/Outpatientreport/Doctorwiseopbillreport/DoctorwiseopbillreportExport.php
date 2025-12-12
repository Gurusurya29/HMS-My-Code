<?php

namespace App\Export\Admin\Reports\Outpatientreport\Doctorwiseopbillreport;

use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DoctorwiseopbillreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $doctorlist, $from_date, $to_date;

    // use constructor to handle dependency injection
    public function __construct($doctorlist, $from_date, $to_date)
    {
        $this->doctorlist = $doctorlist;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->doctorlist;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($doctorlist): array
    {
        return [
            $doctorlist->uniqid,
            $doctorlist->name,
            $doctorlist->visit_count,
            Opbillinglist::whereBetween('created_at', [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59'])->whereHas('opbilling', fn($q) => $q->whereIn('patientvisit_id', $doctorlist->patientvisit->pluck('id')))->sum('grand_total'),

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Doctor Wise OP Bill Report'], [], [
            'UNIQID',
            'DOCTOR NAME',
            'PATIENT COUNT',
            'BILL VALUE',
        ],
        ];
    }
}
