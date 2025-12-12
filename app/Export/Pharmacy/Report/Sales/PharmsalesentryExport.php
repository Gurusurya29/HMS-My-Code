<?php

namespace App\Export\Pharmacy\Report\Sales;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PharmsalesentryExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $sales;

    // use constructor to handle dependency injection
    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->sales;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($sales): array
    {
        return [
            $sales->patient->phone,
            $sales->uniqid,
            $sales->maintype,
            $sales->subtype,
            $sales->doctor->name,
            $sales->patient->uhid,
            $sales->patient->name,
            $sales->grand_total,
            $sales->taxableamt,
            $sales->taxamt,
            $sales->cgst,
            $sales->sgst,
            $sales->created_at->format('d-m-Y h:i A'),
            $sales->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Sales Entry Report'], [], [
            'PATIENT NO.',
            'SALES ENTRY ID',
            'SALES MAINTYPE',
            'SALES SUBTYPE',
            'DOCTOR',
            'PATIENT UHID',
            'PATIENT NAME',
            'GRAND TOTAL',
            'TAXABLE AMOUNT',
            'TAX AMOUNT',
            'CGST',
            'SGST',
            'SALE DATE',
            'CREATED BY',
        ]];
    }
}
