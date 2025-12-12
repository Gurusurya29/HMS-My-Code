<?php

namespace App\Export\Admin\Reports\Patientreport\Patientregisterreport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PatientregisterreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $patient;

    // use constructor to handle dependency injection
    public function __construct($patient)
    {
        $this->patient = $patient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->patient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($patient): array
    {
        return [
            $patient->uhid,
            $patient->created_at->format('d-m-Y h:i A'),
            $patient->name,
            $patient->phone,
            $patient->dob,
            $patient->creatable->name,

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['PATIENT REGISTRATION REPORT'], [], [
            'UHID',
            'CREATED AT',
            'PATIENT NAME',
            'PHONE',
            'DOB',
            'CREATED BY',
        ],
        ];
    }

}
