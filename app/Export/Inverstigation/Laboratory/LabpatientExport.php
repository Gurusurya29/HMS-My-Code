<?php

namespace App\Export\Inverstigation\Laboratory;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LabpatientExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $labpatient;

    // use constructor to handle dependency injection
    public function __construct($labpatient)
    {
        $this->labpatient = $labpatient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->labpatient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($labpatient): array
    {
        return [
            $labpatient->uniqid,
            $labpatient->patient->uhid,
            $labpatient->patient->name,
            $labpatient->patient->phone,
            $labpatient->labpatientlist->pluck('labinvestigation_name')->implode(', '),
            $labpatient->doctor->name,
            $labpatient->subtype,
            $labpatient->created_at->format('d-m-Y h:i A'),
            $labpatient->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Lab Patient Report'], [], [
            'LAB ID',
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
