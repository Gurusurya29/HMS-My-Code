<?php

namespace App\Export\Inverstigation\Xray;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class XraypatientExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $xraypatient;

    // use constructor to handle dependency injection
    public function __construct($xraypatient)
    {
        $this->xraypatient = $xraypatient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->xraypatient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($xraypatient): array
    {
        return [
            $xraypatient->uniqid,
            $xraypatient->patient->uhid,
            $xraypatient->patient->name,
            $xraypatient->patient->phone,
            $xraypatient->xraypatientlist->pluck('xrayinvestigation_name')->implode(', '),
            $xraypatient->doctor->name,
            $xraypatient->subtype,
            $xraypatient->created_at->format('d-m-Y h:i A'),
            $xraypatient->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['X-Ray Patient Report'], [], [
            'X-Ray ID',
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
