<?php

namespace App\Export\Pharmacy\Report\Product;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    // a place to store the team dependency
    private $pharmacyproduct;

    // use constructor to handle dependency injection
    public function __construct($pharmacyproduct)
    {
        $this->pharmacyproduct = $pharmacyproduct;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->pharmacyproduct;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($pharmacyproduct): array
    {
        return [
            $pharmacyproduct->uniqid,
            $pharmacyproduct->product_sku,
            $pharmacyproduct->hsn,
            $pharmacyproduct->name,
            $pharmacyproduct->pharmacycategoryname?->name,
            $pharmacyproduct->stock,
            $pharmacyproduct->creatable->name,
            $pharmacyproduct->totalsales,
            $pharmacyproduct->returncount,
            $pharmacyproduct->salesreturncount,
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'UNIQID',
            'SKU',
            'HSN',
            'NAME',
            'CATEGORY',
            'CURRENT STOCK',
            'CREATED BY',
            'TOTAL SALES',
            'PURCHASE RETURNS',
            'SALES RETURNS',
        ];
    }
}
