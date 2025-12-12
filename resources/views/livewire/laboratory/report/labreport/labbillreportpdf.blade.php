<div>
    <div style="text-align:center;">
        <h3>Lab Bill Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">LAB ID</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">DOCTOR</th>
                <th style="border: 1px solid;">SOURCE</th>
                <th style="border: 1px solid;">CREATED AT</th>
                <th style="border: 1px solid;">CREATED BY</th>
                <th style="border: 1px solid;">TOTAL</th>
                <th style="border: 1px solid;">DISCOUNT(%)</th>
                <th style="border: 1px solid;">GRAND TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labpatient as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->doctor?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->subtype }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                    <td style="border: 1px solid;">{{ $item->total }}</td>
                    <td style="border: 1px solid;">{{ $item->discount_value }}({{ $item->discount_percentage }}%)</td>
                    <td style="border: 1px solid;">{{ $item->grand_total }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid; text-align:right; font-weight:bold; padding:5px;" colspan="9">Total
                    Amount
                </td>
                <td style="border: 1px solid; padding:5px;">
                    {{ $labpatient->sum('total') }}</td>
                <td style="border: 1px solid; padding:5px;">
                    {{ $labpatient->sum('discount_value') }} ({{ $labpatient->sum('discount_percentage') }})</td>
                <td style="border: 1px solid; padding:5px;">
                    {{ $labpatient->sum('grand_total') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
