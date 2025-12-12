<div>
    <div style="text-align:center;">
        <h3>Facility List Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">CREATED AT</th>
                <th style="border: 1px solid;">UNIQID</th>
                <th style="border: 1px solid;">NAME</th>
                <th style="border: 1px solid;">LOCATION</th>
                <th style="border: 1px solid;">ASSET CUSTODIAN</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facilitylist as $key => $item)
                <tr style="text-align: center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->name }}</td>
                    <td style="border: 1px solid;">{{ $item->location }}</td>
                    <td style="border: 1px solid;">{{ $item->asset_custodian }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
