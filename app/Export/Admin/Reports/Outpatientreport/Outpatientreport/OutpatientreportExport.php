<?php

namespace App\Export\Admin\Reports\Outpatientreport\Outpatientreport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OutpatientreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $outpatient;

    // use constructor to handle dependency injection
    public function __construct($outpatient)
    {
        $this->outpatient = $outpatient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->outpatient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($outpatient): array
    {
        return [
            $outpatient->created_at->format('d-m-Y h:i A'),
            $outpatient->patient?->uhid,
            $outpatient->patient?->name,
            $outpatient->patient?->phone,
            $outpatient->doctorspecialization->name ?? '',
            $outpatient->patientvisit->reference->name ?? '',
            $outpatient->doctor->name ?? '-',
            $outpatient->craetable->name ?? '-',

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['OUT PATIENT REPORT'], [], [
            'DATE',
            'UHID',
            'PATIENT NAME',
            'PATIENT PHONE',
            'SPECIALITY',
            'REF BY',
            'DOCTOR NAME',
            'CREATED BY',
        ],
        ];
    }
}
