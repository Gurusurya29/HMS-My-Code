<div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">DATE</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PATIENT PHONE</th>
                <th style="border: 1px solid;">SPECIALITY</th>
                <th style="border: 1px solid;">REF BY</th>
                <th style="border: 1px solid;">DOCTOR NAME</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patientvisit as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->doctorspecialization->name ?? '' }}</td>
                    <td style="border: 1px solid;">{{ $item->reference->name ?? '' }}</td>
                    <td style="border: 1px solid;">{{ $item->doctor->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
