<?php

namespace App\Export\Pharmacy\Report\Sales;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PharmsalesentryitemExport implements FromCollection, WithMapping, WithHeadings
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
            $sales->pharmproduct->name,
            $sales->pharmsalesentry->patient->phone,
            $sales->batch,
            Carbon::parse($sales->expiry_date)->format('d-m-Y'),
            $sales->quantity,
            $sales->disc,
            $sales->disc_amt,
            $sales->selling_price,
            $sales->sgst,
            $sales->sgstamt,
            $sales->cgst,
            $sales->cgstamt,
            round($sales->total),
            $sales->created_at->format('d-m-Y h:i A'),
            $sales->pharmsalesentry->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'PRODUCT NAME',
            'PATIENT PHONE NO.',
            'BATCH',
            'EXPIRY DATE',
            'QUANTITY',
            'DISC %',
            'DISC AMT',
            'SELLING PRICE',
            'SGST',
            'SGST AMOUNT',
            'CGST',
            'CGST AMOUNT',
            'TOTAL',
            'SALE DATE',
            'CREATED BY',
        ];
    }
}
