<div>
    <div style="text-align:center;">
        <h3>Bill Discount Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">DISCOUNT/CANCEL ON</th>
                <th style="border: 1px solid;">DISCOUNT/CANCEL ID</th>
                <th style="border: 1px solid;">BILL ID</th>
                <th style="border: 1px solid;">PATIENT UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">DISCOUNT TYPE</th>
                <th style="border: 1px solid;">BILL TYPE</th>
                <th style="border: 1px solid;">DISCOUNT/CANCEL BY</th>
                <th style="border: 1px solid;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billdiscount as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->billdiscountable->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ config('archive.discount_type')[$item->discount_type] }}</td>
                    <td style="border: 1px solid;">
                        {{ $item->bill_type? collect(config('archive.bill_type'))->where('id', $item->bill_type)->first()['subtype']: '-' }}
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                    <td style="border: 1px solid;">{{ $item->discount_amount }}</td>

                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid; text-align:right; font-weight:bold; padding:5px;" colspan="10">Total
                    Amount
                </td>
                <td style="border: 1px solid; padding:5px;">
                    {{ $billdiscount->sum('discount_amount') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
