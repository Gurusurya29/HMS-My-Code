<div>
    <div style="text-align:center;">
        <h3>Patient Registration Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">CREATED AT</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">DOB</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient as $key => $item)
                <tr style="text-align: center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->name }}</td>
                    <td style="border: 1px solid;">{{ $item->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->dob }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
