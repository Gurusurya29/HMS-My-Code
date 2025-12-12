<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PURCHASE ID</th>
                <th style="border: 1px solid;">PURCHASE ORDER</th>
                <th style="border: 1px solid;">SUPPLIER ID</th>
                <th style="border: 1px solid;">SUPPLIER COMPANY NAME</th>
                <th style="border: 1px solid;">GRAND TOTAL</th>
                <th style="border: 1px solid;">TAXABLE AMOUNT</th>
                <th style="border: 1px solid;">TAX AMOUNT</th>
                <th style="border: 1px solid;">CGST</th>
                <th style="border: 1px solid;">SGST</th>
                <th style="border: 1px solid;">PURCHASE DATE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacypurchaseentry as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->purchaseorder_uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseorder->supplier->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->pharmpurchaseorder->supplier->company_name }}</td>
                    <td style="border: 1px solid;">{{ $item->grand_total }}</td>
                    <td style="border: 1px solid;">{{ $item->taxableamt }}</td>
                    <td style="border: 1px solid;">{{ $item->taxamt }}</td>
                    <td style="border: 1px solid;">{{ $item->cgst }}</td>
                    <td style="border: 1px solid;">{{ $item->sgst }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<div style="float: right;">
    Total Price - {{$totalamt}}
</div>
