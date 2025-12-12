<div>
    <div style="text-align:center;">
        <h3>In Patient Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">D.O.A</th>
                <th style="border: 1px solid;">WARD</th>
                <th style="border: 1px solid;">BED NO</th>
                <th style="border: 1px solid;">UHID</th>
                <th style="border: 1px solid;">PATIENT NAME</th>
                <th style="border: 1px solid;">PATIENT PHONE</th>
                <th style="border: 1px solid;">REF BY</th>
                <th style="border: 1px solid;">CARE TAKER</th>
                <th style="border: 1px solid;">CARE TAKER NO</th>
                <th style="border: 1px solid;">CREATED BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inpatient as $key => $item)
                <tr style="text-align:center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">
                        {{ Carbon\Carbon::parse($item->ipadmission->admission_date)->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">{{ $item->ipadmission->wardtype->name }}</td>
                    <td style="border: 1px solid;">{{ $item->ipadmission->bedorroomnumber->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->uhid }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->name }}</td>
                    <td style="border: 1px solid;">{{ $item->patient?->phone }}</td>
                    <td style="border: 1px solid;">{{ $item->patientvisit->reference->name ?? '-' }}</td>
                    <td style="border: 1px solid;">{{ $item->ipadmission->attender_name }}</td>
                    <td style="border: 1px solid;">{{ $item->ipadmission->attender_phone }}</td>
                    <td style="border: 1px solid;">{{ $item->ipadmission->creatable->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
