<div>
    <div style="text-align:center;">
        <h3>Payment Voucher Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PAID ON</th>
                <th style="border: 1px solid;">RECEIPT ID</th>
                <th style="border: 1px solid;">NAME (ID)</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">PAYMENT MODE</th>
                <th style="border: 1px solid;">PAID BY</th>
                <th style="border: 1px solid;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentvoucher as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->paymentvoucher_uniqid }}</td>
                    <td style="border: 1px solid;">
                        {{ $item->paymentvoucher_user }}
                    </td>
                    <td style="border: 1px solid;">
                        {{ $item->paymentvoucher_phone }}
                    </td>
                    <td style="border: 1px solid;">{{ config('archive.modeofpayment')[$item->modeofpayment] }}</td>

                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                    <td style="border: 1px solid;">{{ $item->paid_amount }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid; text-align:right; font-weight:bold; padding:5px;" colspan="7">Total
                    Amount
                </td>
                <td style="border: 1px solid; padding:5px;">
                    {{ $paymentvoucher->sum('paid_amount') }}</td>
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
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 1)->sum('paid_amount') }}</td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 2)->sum('paid_amount') }}
                </td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 3)->sum('paid_amount') }}
                </td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 4)->sum('paid_amount') }}
                </td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 5)->sum('paid_amount') }}
                </td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 6)->sum('paid_amount') }}
                </td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 7)->sum('paid_amount') }}
                </td>
                <td style="border: 1px solid;">{{ $paymentvoucher->where('modeofpayment', 8)->sum('paid_amount') }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
