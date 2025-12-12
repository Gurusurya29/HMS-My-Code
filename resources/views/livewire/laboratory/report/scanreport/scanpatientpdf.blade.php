<div>
    <div style="text-align:center;">
        <h3>Scan Patient Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">SCAN ID</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">INVESTIGATIONS</th>
                <th style="border: 1px solid;">DOCTOR</th>
                <th style="border: 1px solid;">SOURCE</th>
                <th style="border: 1px solid;">CREATED AT</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scanpatient as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->uniqid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">
                        {{ $item->scanpatientlist->pluck('scaninvestigation_name')->implode(', ') }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->doctor?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->subtype }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
