<div>
    <div style="text-align:center;">
        <h3>Scheduled Surgery Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">PATIENT UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PATIENT PHONE</th>
                <th style="border: 1px solid;">DOCTOR</th>
                <th style="border: 1px solid;">SURGERY NAME</th>
                <th style="border: 1px solid;">START DATE</th>
                <th style="border: 1px solid;">END DATE</th>
                <th style="border: 1px solid;">SCHEDULED ON</th>
                <th style="border: 1px solid;">SCHEDULED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($otschedulelist as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->doctor?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->surgery_name }}</td>
                    <td style="border: 1px solid;">
                        {{ Carbon\Carbon::parse($item->surgery_startdate)->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">
                        {{ Carbon\Carbon::parse($item->surgery_enddate)->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
