<div>
    <div style="text-align:center;">
        <h3>Employee Ledger Report</h3>
    </div>
    <table style="width:100%; font-size:15px; text-align:right; font-weight: bold">
        <tr>
            <td>
                Total Collected : Rs.{{ $employeestatement->sum('credit') }}
            </td>
            <td>
                Total Billed : Rs.{{ $employeestatement->sum('debit') }}
            </td>
            <td>
                Balance : Rs.{{ $employeestatement->sum('debit') - $employeestatement->sum('credit') }}
            </td>
        </tr>
    </table>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">DATE</th>
                <th style="border: 1px solid;">STATEMENT ID</th>
                <th style="border: 1px solid;">COLLECTED</th>
                <th style="border: 1px solid;">BILLED</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employeestatement as $key => $item)
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
