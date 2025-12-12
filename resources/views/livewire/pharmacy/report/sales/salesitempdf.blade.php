<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PRODUCT NAME</th>
                <th style="border: 1px solid;">PATIENT PHONE NO.</th>
                <th style="border: 1px solid;">BATCH</th>
                <th style="border: 1px solid;">EXPIRY DATE</th>
                <th style="border: 1px solid;">QUANTITY</th>
                <th style="border: 1px solid;">DISC %</th>
                <th style="border: 1px solid;">DISC AMT</th>
                <th style="border: 1px solid;">SELLING PRICE</th>
                <th style="border: 1px solid;">SGST</th>
                <th style="border: 1px solid;">SGST AMOUNT</th>
                <th style="border: 1px solid;">CGST</th>
                <th style="border: 1px solid;">CGST AMOUNT</th>
                <th style="border: 1px solid;">TOTAL</th>
                <th style="border: 1px solid;">SALE DATE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmproduct->name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmsalesentry->patient->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->batch }}</td>
                    <td style="border: 1px solid;">{{ Carbon\Carbon::parse($item->expiry_date)->format('d-m-Y') }}</td>
                    <td style="border: 1px solid;">{{ $item->quantity }}</td>
                    <td style="border: 1px solid;">{{ $item->disc }}</td>
                    <td style="border: 1px solid;">{{ $item->disc_amt }}</td>
                    <td style="border: 1px solid;">{{ $item->selling_price }}</td>
                    <td style="border: 1px solid;">{{ $item->sgst }}</td>
                    <td style="border: 1px solid;">{{ $item->sgstamt }}</td>
                    <td style="border: 1px solid;">{{ $item->cgst }}</td>
                    <td style="border: 1px solid;">{{ $item->cgstamt }}</td>
                    <td style="border: 1px solid;">{{ round($item->total) }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmsalesentry->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<div style="float: right;">
    Total Sales Price - {{$total_sale}}
</div>
