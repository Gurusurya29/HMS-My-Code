<?php

namespace App\Export\Admin\Reports\Facilityreport\Facilitylistreport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FacilitylistreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $facilitylist;

    // use constructor to handle dependency injection
    public function __construct($facilitylist)
    {
        $this->facilitylist = $facilitylist;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->facilitylist;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($facilitylist): array
    {
        return [
            $facilitylist->uniqid,
            $facilitylist->created_at->format('d-m-Y h:i A'),
            $facilitylist->name,
            $facilitylist->location,
            $facilitylist->asset_custodian,
            $facilitylist->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['FACILITY LIST REPORT'], [], [
            'UNIQID',
            'CREATED AT',
            'NAME',
            'LOCATION',
            'ASSET CUSTODIAN',
            'CREATED BY',
        ],
        ];
    }

}
