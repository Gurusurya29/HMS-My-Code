<div>
    <div style="text-align:center;">
        <h3>Receipt Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">RECEIPTED ON</th>
                <th style="border: 1px solid;">RECEIPT ID</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">PAYMENT MODE</th>
                <th style="border: 1px solid;">RECEIPTED BY</th>
                <th style="border: 1px solid;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipt as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->receipt_uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ config('archive.modeofpayment')[$item->modeofpayment] }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                    <td style="border: 1px solid;">{{ $item->received_amount }}</td>

                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td style="border: 1px solid; text-align:right; font-weight:bold; padding:5px;" colspan="8">Total
                    Amount
                </td>
                <td style="border: 1px solid;text-align:center; padding:5px;">
                    {{ $receipt->sum('received_amount') }}</td>
            </tr>
        </tfoot>
    </table>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px; margin-top:15px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">Cash</th>
                <th style="border: 1px solid;">Card</th>
                <th style="border: 1px solid;">Online</th>
                <th style="border: 1px solid;">Cheque</th>
                <th style="border: 1px solid;">DD</th>
                <th style="border: 1px solid;">Others</th>
                <th style="border: 1px solid;">Gpay</th>
                <th style="border: 1px solid;">Paytm</th>
            </tr>
        </thead>
        <tbody>

            <tr style="text-align:center;">
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 1)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 2)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 3)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 4)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 5)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 6)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 7)->sum('received_amount') }}</td>
                <td style="border: 1px solid;">{{ $receipt->where('modeofpayment', 8)->sum('received_amount') }}</td>
            </tr>
        </tbody>
    </table>
</div>
