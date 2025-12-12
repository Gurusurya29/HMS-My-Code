<?php

namespace App\Export\Admin\Reports\Patientreport\Patientvisitreport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PatientvisitreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $patientvisit;

    // use constructor to handle dependency injection
    public function __construct($patientvisit)
    {
        $this->patientvisit = $patientvisit;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->patientvisit;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($patientvisit): array
    {
        return [
            $patientvisit->created_at->format('d-m-Y h:i A'),
            $patientvisit->patient?->uhid,
            $patientvisit->patient?->name,
            $patientvisit->patient?->phone,
            $patientvisit->doctor->name ?? '-',
            $patientvisit->doctorspecialization->name ?? '',
            $patientvisit->reference->name ?? '',
            $patientvisit->doctor->name ?? '-',
            $patientvisit->creatable->name ?? '-',

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['PATIENT VISIT REPORT'], [], [
            'DATE',
            'UHID',
            'PATIENT NAME',
            'PATIENT PHONE',
            'DOCTOR',
            'SPECIALITY',
            'REF BY',
            'DOCTOR NAME',
            'CREATED BY',
        ],
        ];
    }
}
