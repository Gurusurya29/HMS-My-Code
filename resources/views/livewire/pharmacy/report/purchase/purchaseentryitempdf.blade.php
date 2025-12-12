<div>
    <div style="text-align:center;">
        <h3>Purchase Item Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">SUPPLIER</th>
                <th style="border: 1px solid;">PRODUCT NAME</th>
                <th style="border: 1px solid;">CATEGORY</th>
                <th style="border: 1px solid;">BATCH</th>
                <th style="border: 1px solid;">EXPIRY DATE</th>
                <th style="border: 1px solid;">QUANTITY</th>
                <th style="border: 1px solid;">SGST</th>
                <th style="border: 1px solid;">SGST AMOUNT</th>
                <th style="border: 1px solid;">CGST</th>
                <th style="border: 1px solid;">CGST AMOUNT</th>
                <th style="border: 1px solid;">PURCHASE PRICE/PRODUCT</th>
                <th style="border: 1px solid;">SELLING PRICE/PRODUCT</th>
                <th style="border: 1px solid;">TOTAL</th>
                <th style="border: 1px solid;">PURCHASE DATE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacypurchaseentryitem as $key => $item)
            <tr>
                <td style="border: 1px solid;">{{ $key + 1 }}</td>
                <td style="border: 1px solid;">{{ $item->pharmpurchaseentry->supplier->company_name }}</td>
                <td style="border: 1px solid;">{{ $item->pharmproduct->name }}</td>
                <td style="border: 1px solid;">{{ $item->pharmproduct->pharmacycategoryname?->name }}</td>
                <td style="border: 1px solid;">{{ $item->batch }}</td>
                <td style="border: 1px solid;">{{ Carbon\Carbon::parse($item->expiry_date)->format('d-m-Y') }}</td>
                <td style="border: 1px solid;">{{ $item->received_quantity }}</td>
                <td style="border: 1px solid;">{{ $item->sgst }}</td>
                <td style="border: 1px solid;">{{ $item->sgst_amt }}</td>
                <td style="border: 1px solid;">{{ $item->cgst }}</td>
                <td style="border: 1px solid;">{{ $item->cgst_amt }}</td>
                <td style="border: 1px solid;">{{ $item->purchase_price }}</td>
                <td style="border: 1px solid;">{{ $item->selling_price }}</td>
                <td style="border: 1px solid;">{{ round($item->total)}}</td>
                <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                <td style="border: 1px solid;">{{ $item->pharmpurchaseentry->creatable->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<div style="float: right;">
    Total Purchase Price - {{$totalamt}}
</div>