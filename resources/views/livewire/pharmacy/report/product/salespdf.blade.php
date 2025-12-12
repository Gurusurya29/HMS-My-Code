<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">UNIQID</th>
                <th style="border: 1px solid;">SKU</th>
                <th style="border: 1px solid;">HSN</th>
                <th style="border: 1px solid;">NAME</th>
                <th style="border: 1px solid;">CATEGORY</th>
                <th style="border: 1px solid;">CREATED BY</th>
                <th style="border: 1px solid;">CURRENT STOCK</th>
                <th style="border: 1px solid;">TOTAL SALES</th>
                <th style="border: 1px solid;">PURCHASE RETURNS</th>
                <th style="border: 1px solid;">SALES RETURNS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacyproduct as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->product_sku }}</td>
                    <td style="border: 1px solid;">{{ $item->hsn }}</td>
                    <td style="border: 1px solid;">{{ $item->name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmacycategoryname?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                    <td style="border: 1px solid;">{{ $item->stock }}</td>
                    <td style="border: 1px solid;">{{ $item->totalsales }}</td>
                    <td style="border: 1px solid;">{{ $item->returncount }}</td>
                    <td style="border: 1px solid;">{{ $item->salesreturncount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
