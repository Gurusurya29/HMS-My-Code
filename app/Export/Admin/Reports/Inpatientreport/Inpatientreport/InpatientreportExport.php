<?php

namespace App\Export\Admin\Reports\Inpatientreport\Inpatientreport;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InpatientreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $inpatient;

    // use constructor to handle dependency injection
    public function __construct($inpatient)
    {
        $this->inpatient = $inpatient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->inpatient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($inpatient): array
    {
        return [
            Carbon::parse($inpatient->ipadmission->admission_date)->format('d-m-Y h:i A'),
            $inpatient->ipadmission->wardtype->name,
            $inpatient->ipadmission->bedorroomnumber->name,
            $inpatient->patient?->uhid,
            $inpatient->patient?->name,
            $inpatient->patient?->phone,
            $inpatient->patientvisit->reference->name ?? '-',
            $inpatient->ipadmission->attender_name,
            $inpatient->ipadmission->attender_phone,
            $inpatient->ipadmission->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['In Patient Report'], [], [
            'D.O.A',
            'WARD',
            'BED NO',
            'UHID',
            'PATIENT NAME',
            'PATIENT PHONE',
            'REF BY',
            'CARE TAKER',
            'CARE TAKER NO',
            'CREATED BY',
        ],
        ];
    }
}
