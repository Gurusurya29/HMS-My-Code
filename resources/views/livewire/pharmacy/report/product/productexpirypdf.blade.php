<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PRODUCT NAME</th>
                <th style="border: 1px solid;">CATEGORY</th>
                <th style="border: 1px solid;">BATCH</th>
                <th style="border: 1px solid;">EXPIRY DATE</th>
                <th style="border: 1px solid;">QUANTITY</th>
                <th style="border: 1px solid;">SGST</th>
                <th style="border: 1px solid;">SGST AMOUNT</th>
                <th style="border: 1px solid;">CGST</th>
                <th style="border: 1px solid;">CGST AMOUNT</th>
                <th style="border: 1px solid;">SELLING PRICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productexpiry as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmproduct->name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmproduct->pharmacycategoryname?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->batch }}</td>
                    <td style="border: 1px solid;">{{ Carbon\Carbon::parse($item->expiry_date)->format('d-m-Y') }}</td>
                    <td style="border: 1px solid;">{{ $item->quantity }}</td>
                    <td style="border: 1px solid;">{{ $item->sgst }}</td>
                    <td style="border: 1px solid;">{{ $item->sgst_amt }}</td>
                    <td style="border: 1px solid;">{{ $item->cgst }}</td>
                    <td style="border: 1px solid;">{{ $item->cgst_amt }}</td>
                    <td style="border: 1px solid;">{{ $item->selling_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
