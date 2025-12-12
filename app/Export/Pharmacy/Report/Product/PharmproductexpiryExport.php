<?php

namespace App\Export\Pharmacy\Report\Product;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PharmproductexpiryExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $productexpiry;

    // use constructor to handle dependency injection
    public function __construct($productexpiry)
    {
        $this->productexpiry = $productexpiry;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->productexpiry;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($productexpiry): array
    {
        return [
            $productexpiry->pharmproduct->name,
            $productexpiry->pharmproduct->pharmacycategoryname?->name,
            $productexpiry->batch,
            Carbon::parse($productexpiry->expiry_date)->format('d-m-Y'),
            $productexpiry->quantity,
            $productexpiry->sgst,
            $productexpiry->sgst_amt,
            $productexpiry->cgst,
            $productexpiry->cgst_amt,
            $productexpiry->selling_price,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'PRODUCT NAME',
            'CATEGORY',
            'BATCH',
            'EXPIRY DATE',
            'QUANTITY',
            'SGST',
            'SGST AMOUNT',
            'CGST',
            'CGST AMOUNT',
            'SELLING PRICE',
        ];
    }
}
