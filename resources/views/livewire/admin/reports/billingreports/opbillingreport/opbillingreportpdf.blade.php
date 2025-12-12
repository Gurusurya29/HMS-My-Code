<div>
    <div style="text-align:center;">
        <h3>OP Billing Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">DATE</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PATIENT PHONE</th>
                <th style="border: 1px solid;">BILL ID</th>
                <th style="border: 1px solid;">BILLED BY</th>
                <th style="border: 1px solid;">SUB TOTAL</th>
                <th style="border: 1px solid;">DISC</th>
                <th style="border: 1px solid;">TOTAL</th>
                <th style="border: 1px solid;">BILL DISC/CANCEL</th>
                <th style="border: 1px solid;">NET VALUE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opbilling as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                    <td style="border: 1px solid;">{{ $item->sub_total }}</td>
                    <td style="border: 1px solid;">{{ $item->discount }}</td>
                    <td style="border: 1px solid;">{{ $item->total }}</td>
                    <td style="border: 1px solid;">{{ $item->billdiscount_amount }}</td>
                    <td style="border: 1px solid;">{{ $item->grand_total }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid; text-align:right; font-weight:bold; padding:5px;" colspan="7">TOTAL
                </td>
                <td style="border: 1px solid;text-align:center; padding:5px;">
                    {{ $opbilling->sum('sub_total') }}</td>
                <td style="border: 1px solid;text-align:center; padding:5px;">
                    {{ $opbilling->sum('discount') }}</td>
                <td style="border: 1px solid;text-align:center; padding:5px;">
                    {{ $opbilling->sum('total') }}</td>
                <td style="border: 1px solid;text-align:center; padding:5px;">
                    {{ $opbilling->sum('billdiscount_amount') }}</td>
                <td style="border: 1px solid;text-align:center; padding:5px;">
                    {{ $opbilling->sum('grand_total') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
