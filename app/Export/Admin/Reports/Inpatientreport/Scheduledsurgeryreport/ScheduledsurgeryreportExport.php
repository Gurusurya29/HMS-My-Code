<?php

namespace App\Export\Admin\Reports\Inpatientreport\Scheduledsurgeryreport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScheduledsurgeryreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $otschedulelist;

    // use constructor to handle dependency injection
    public function __construct($otschedulelist)
    {
        $this->otschedulelist = $otschedulelist;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->otschedulelist;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($otschedulelist): array
    {
        return [
            $otschedulelist->patient?->uhid,
            $otschedulelist->patient?->name,
            $otschedulelist->patient?->phone,
            $otschedulelist->doctor?->name,
            $otschedulelist->surgery_name,
            date('d-m-Y h:i A', strtotime($otschedulelist->surgery_startdate)),
            date('d-m-Y h:i A', strtotime($otschedulelist->surgery_enddate)),
            $otschedulelist->created_at->format('d-m-Y h:i A'),
            $otschedulelist->creatable->name,

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Scheduled Surgery Report'], [], [
            'PATIENT UHID',
            'PATIENT NAME',
            'PATIENT PHONE',
            'DOCTOR',
            'SURGERY NAME',
            'START DATE',
            'END DATE',
            'SCHEDULED ON',
            'SCHEDULED BY',
        ],
        ];
    }
}
