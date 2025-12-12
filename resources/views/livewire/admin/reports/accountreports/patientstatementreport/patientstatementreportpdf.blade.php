<div>
    <div style="text-align:center;">
        <h3>Patient Ledger Report</h3>
    </div>
    <table style="width:100%; font-size:15px; text-align:right; font-weight: bold">
        <tr>
            <td>
                Total Collected : Rs.{{ $patientstatement->sum('credit') }}
            </td>
            <td>
                Total Billed : Rs.{{ $patientstatement->sum('debit') }}
            </td>
            <td>
                Balance : Rs.{{ $patientstatement->sum('debit') - $patientstatement->sum('credit') }}
            </td>
        </tr>
    </table>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">DATE</th>
                <th style="border: 1px solid;">BILL/RECEIPT ID</th>
                <th style="border: 1px solid;">COLLECTED</th>
                <th style="border: 1px solid;">BILLED</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patientstatement as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->statement_ref_id }}</td>
                    <td style="border: 1px solid;">{{ $item->credit }}</td>
                    <td style="border: 1px solid;">{{ $item->debit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
