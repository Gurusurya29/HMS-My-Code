<div>
    <div style="text-align:center;">
        <h3>Sales Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size: 10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PATIENT NO.</th>
                <th style="border: 1px solid;">SALES ENTRY ID</th>
                <th style="border: 1px solid;">SALES MAINTYPE</th>
                <th style="border: 1px solid;">SALES SUBTYPE</th>
                <th style="border: 1px solid;">DOCTOR</th>
                <th style="border: 1px solid;">PATIENT UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">GRAND TOTAL</th>
                <th style="border: 1px solid;">TAXABLE AMOUNT</th>
                <th style="border: 1px solid;">TAX AMOUNT</th>
                <th style="border: 1px solid;">CGST</th>
                <th style="border: 1px solid;">SGST</th>
                <th style="border: 1px solid;">SALE DATE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $key => $item)
            <tr>
                <td style="border: 1px solid;">{{ $key + 1 }}</td>
                <td style="border: 1px solid;">{{ $item->patient->phone }}</td>
                <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                <td style="border: 1px solid;">{{ $item->maintype }}</td>
                <td style="border: 1px solid;">{{ $item->subtype }}</td>
                <td style="border: 1px solid;">{{ $item->doctor->name }}</td>
                <td style="border: 1px solid;">{{ $item->patient->uhid }}</td>
                <td style="border: 1px solid;">{{ $item->patient->name }}</td>
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
    Total Sales Price - {{$totalsales}}
</div>