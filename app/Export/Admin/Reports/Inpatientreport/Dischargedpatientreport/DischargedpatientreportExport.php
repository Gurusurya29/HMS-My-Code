<?php

namespace App\Export\Admin\Reports\Inpatientreport\Dischargedpatientreport;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DischargedpatientreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $dischargedpatient;

    // use constructor to handle dependency injection
    public function __construct($dischargedpatient)
    {
        $this->dischargedpatient = $dischargedpatient;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->dischargedpatient;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($dischargedpatient): array
    {
        return [
            Carbon::parse($dischargedpatient->ipadmission->admission_date)->format('d-m-Y h:i A'),
            $dischargedpatient->ipadmission->wardtype->name,
            $dischargedpatient->ipadmission->bedorroomnumber->name,
            $dischargedpatient->patient?->uhid,
            $dischargedpatient->patient?->name,
            $dischargedpatient->patient?->phone,
            $dischargedpatient->dsspecialable?->doctor?->name,
            $dischargedpatient->ipadmission->attender_name,
            $dischargedpatient->ipadmission->attender_phone,
            $dischargedpatient->dsspecialable?->discharge_date,
            $dischargedpatient->dsspecialable?->creatable->name,

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Discharged Patient Report'], [], [
            'D.O.A',
            'WARD',
            'BED NO',
            'UHID',
            'PATIENT NAME',
            'PATIENT PHONE',
            'DOCTOR',
            'CARE TAKER',
            'CARE TAKER NO',
            'D.O.D',
            'CREATED BY',
        ],
        ];
    }
}
