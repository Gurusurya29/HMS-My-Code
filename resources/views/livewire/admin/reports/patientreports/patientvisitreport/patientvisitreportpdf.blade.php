<div>
    <div style="text-align:center;">
        <h3>Patient VISIT Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">NAME</th>
                <th style="border: 1px solid;">DOB</th>
                <th style="border: 1px solid;">PHONE</th>
                <th style="border: 1px solid;">DOCTOR</th>
                <th style="border: 1px solid;">VISITED ON</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($patientvisit as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->patient->uhid }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->patient->name }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->patient->dob }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->patient->phone }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->doctor->name ?? '-' }}
                    </td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->creatable->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
