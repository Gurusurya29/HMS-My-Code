<?php

namespace App\Export\Pharmacy\Report\Purchase;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseentryitemExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $pharmacypurchaseentryitem;

    // use constructor to handle dependency injection
    public function __construct($pharmacypurchaseentryitem)
    {
        $this->pharmacypurchaseentryitem = $pharmacypurchaseentryitem;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->pharmacypurchaseentryitem;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($pharmacypurchaseentryitem): array
    {
        return [
            $pharmacypurchaseentryitem->pharmpurchaseentry->supplier->company_name,
            $pharmacypurchaseentryitem->pharmproduct->name,
            $pharmacypurchaseentryitem->pharmproduct->pharmacycategoryname?->name,
            $pharmacypurchaseentryitem->batch,
            Carbon::parse($pharmacypurchaseentryitem->expiry_date)->format('d-m-Y'),
            $pharmacypurchaseentryitem->received_quantity,
            $pharmacypurchaseentryitem->sgst,
            $pharmacypurchaseentryitem->sgst_amt,
            $pharmacypurchaseentryitem->cgst,
            $pharmacypurchaseentryitem->cgst_amt,
            $pharmacypurchaseentryitem->purchase_price,
            $pharmacypurchaseentryitem->selling_price,
            round($pharmacypurchaseentryitem->total),
            $pharmacypurchaseentryitem->created_at->format('d-m-Y h:i A'),
            $pharmacypurchaseentryitem->pharmpurchaseentry->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [['Purchase Entry Item Report'], [], [
            'SUPPLIER',
            'PRODUCT NAME',
            'CATEGORY',
            'BATCH',
            'EXPIRY DATE',
            'QUANTITY',
            'SGST',
            'SGST AMOUNT',
            'CGST',
            'CGST AMOUNT',
            'PURCHASE PRICE/PRODUCT',
            'SELLING PRICE/PRODUCT',
            'TOTAL',
            'PURCHASE DATE',
            'CREATED BY',
        ]];
    }
}
