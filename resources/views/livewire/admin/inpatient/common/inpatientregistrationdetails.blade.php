<table class="table table-bordered shadow-sm table-success text-center">
    <thead class="fw-bold " style="font-size: 16px;">
        <tr>
            <th>UHID</th>
            <th>IN PATIENT ID</th>
            <th>NAME</th>
            <th>PHONE</th>
            <th>DOB</th>
            <th>AGE</th>
            <th>WARD-ROOM</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $inpatient->patient->uhid }}</td>
            <td>{{ $inpatient->uniqid }}</td>
            <td>{{ $inpatient->patient->name }}</td>
            <td>{{ $inpatient->patient->phone }}</td>
            <td>{{ $inpatient->patient->dob ? date('d-m-Y', strtotime($inpatient->patient->dob)) : '-' }}</td>
            <td>{{ $inpatient->patient->age ?? '-' }}</td>
            @if ($inpatient->ipadmission?->bedorroomnumber_id)
                <td>{{ $inpatient->ipadmission->wardtype->name }} -
                    {{ $inpatient->ipadmission->bedorroomnumber->name }}
                </td>
            @else
                <td>Not Assigned</td>
            @endif
        </tr>
    </tbody>
</table>
