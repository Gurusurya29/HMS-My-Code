<?php

namespace App\Export\Pharmacy\Report\Purchase;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseentryExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $pharmacypurchaseentry;

    // use constructor to handle dependency injection
    public function __construct($pharmacypurchaseentry)
    {
        $this->pharmacypurchaseentry = $pharmacypurchaseentry;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->pharmacypurchaseentry;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($pharmacypurchaseentry): array
    {
        return [
            $pharmacypurchaseentry->uniqid,
            $pharmacypurchaseentry->purchaseorder_uniqid,
            $pharmacypurchaseentry->pharmpurchaseorder->supplier->uniqid,
            $pharmacypurchaseentry->pharmpurchaseorder->supplier->company_name,
            $pharmacypurchaseentry->grand_total,
            $pharmacypurchaseentry->taxableamt,
            $pharmacypurchaseentry->taxamt,
            $pharmacypurchaseentry->cgst,
            $pharmacypurchaseentry->sgst,
            $pharmacypurchaseentry->created_at->format('d-m-Y h:i A'),
            $pharmacypurchaseentry->creatable->name,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'PURCHASE ID',
            'PURCHASE ORDER',
            'SUPPLIER ID',
            'SUPPLIER COMPANY NAME',
            'GRAND TOTAL',
            'TAXABLE AMOUNT',
            'TAX AMOUNT',
            'CGST',
            'SGST',
            'PURCHASE DATE',
            'CREATED BY',
        ];
    }
}
