<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PRODUCT NAME</th>
                <th style="border: 1px solid;">PATIENT PHONE NO.</th>
                <th style="border: 1px solid;">BATCH</th>
                <th style="border: 1px solid;">EXPIRY DATE</th>
                <th style="border: 1px solid;">RETURN QTY</th>
                <th style="border: 1px solid;">RETURN DATE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmacyproduct->name }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmsalesreturn->patient->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmsalesentryitem->pharmpurchaseentryitem->batch }}</td>
                    <td style="border: 1px solid;">{{ Carbon\Carbon::parse($item->expiry_date)->format('d-m-Y') }}</td>
                    <td style="border: 1px solid;">{{ $item->return_quantity }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmsalesreturn->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
