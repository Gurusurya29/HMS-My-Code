<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%;font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">SUPPLIER</th>
                <th style="border: 1px solid;">PRODUCT NAME</th>
                <th style="border: 1px solid;">CATEGORY</th>
                <th style="border: 1px solid;">BATCH</th>
                <th style="border: 1px solid;">EXPIRY DATE</th>
                <th style="border: 1px solid;">RETUR QTY</th>
                <th style="border: 1px solid;">SGST</th>
                <th style="border: 1px solid;">SGST AMOUNT</th>
                <th style="border: 1px solid;">CGST</th>
                <th style="border: 1px solid;">CGST AMOUNT</th>
                <th style="border: 1px solid;">PURCHASE PRICE</th>
                <th style="border: 1px solid;">SELLING PRICE</th>
                <th style="border: 1px solid;">RETURN DATE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacypurchasereturnitem as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->supplier->company_name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmacyproduct->name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmacyproduct->pharmacycategoryname?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->batch }}</td>
                    <td style="border: 1px solid;">
                        {{ Carbon\Carbon::parse($item->pharmpurchaseentryitem->expiry_date)->format('d-m-Y') }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->return_quantity }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->sgst }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->sgst_amt }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->cgst }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->cgst_amt }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->purchase_price }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseentryitem->selling_price }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchasereturn->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
