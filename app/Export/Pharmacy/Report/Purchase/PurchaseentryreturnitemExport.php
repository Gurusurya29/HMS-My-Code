<?php

namespace App\Export\Pharmacy\Report\Purchase;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseentryreturnitemExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $pharmacypurchasereturnitem;

    // use constructor to handle dependency injection
    public function __construct($pharmacypurchasereturnitem)
    {
        $this->pharmacypurchasereturnitem = $pharmacypurchasereturnitem;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->pharmacypurchasereturnitem;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($pharmacypurchasereturnitem): array
    {
        return [
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->supplier->company_name,
            $pharmacypurchasereturnitem->pharmacyproduct->name,
            $pharmacypurchasereturnitem->pharmacyproduct->pharmacycategoryname?->name,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->batch,
            Carbon::parse($pharmacypurchasereturnitem->pharmpurchaseentryitem->expiry_date)->format('d-m-Y'),
            $pharmacypurchasereturnitem->return_quantity,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->sgst,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->sgst_amt,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->cgst,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->cgst_amt,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->purchase_price,
            $pharmacypurchasereturnitem->pharmpurchaseentryitem->selling_price,
            $pharmacypurchasereturnitem->created_at->format('d-m-Y h:i A'),
            $pharmacypurchasereturnitem->pharmpurchasereturn->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'SUPPLIER',
            'PRODUCT NAME',
            'CATEGORY',
            'BATCH',
            'EXPIRY DATE',
            'RETUR QTY',
            'SGST',
            'SGST AMOUNT',
            'CGST',
            'CGST AMOUNT',
            'PURCHASE PRICE',
            'SELLING PRICE',
            'RETURN DATE',
            'CREATED BY',
        ];
    }
}
