<?php

namespace App\Export\Inverstigation\Scan;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScanpatientExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $scanpatient;

    // use constructor to handle dependency injection
    public function __construct($scanpatient)
    {
        $this->scanpatient = $scanpatient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->scanpatient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($scanpatient): array
    {
        return [
            $scanpatient->uniqid,
            $scanpatient->patient->uhid,
            $scanpatient->patient->name,
            $scanpatient->patient->phone,
            $scanpatient->scanpatientlist->pluck('scaninvestigation_name')->implode(', '),
            $scanpatient->doctor->name,
            $scanpatient->subtype,
            $scanpatient->created_at->format('d-m-Y h:i A'),
            $scanpatient->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Scan Patient Report'], [], [
            'SCAN ID',
            'UHID',
            'PATIENT NAME',
            'PHONE',
            'INVESTIGATIONS',
            'DOCTOR',
            'SOURCE',
            'CREATED AT',
            'CREATED BY',
        ],
        ];
    }
}
