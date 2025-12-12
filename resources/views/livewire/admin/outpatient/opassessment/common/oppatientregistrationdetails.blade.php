<table class="table table-bordered shadow-sm table-success text-center">
    <thead class="fw-bold " style="font-size: 16px;">
        <tr>
            <th>UHID</th>
            <th>OUT PATIENT ID</th>
            <th>NAME</th>
            <th>PHONE</th>
            <th>DOB</th>
            <th>AGE</th>
            <th>DOCTOR</th>
            <th>SPECIALITY</th>
            {{-- <th>DOCUMENT</th> --}}
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $outpatient->patient->uhid }}</td>
            <td>{{ $outpatient->uniqid }}</td>
            <td>{{ $outpatient->patient->name }}</td>
            <td>{{ $outpatient->patient->phone }}</td>
            <td>{{ $outpatient->patient->dob ? date('d-m-Y', strtotime($outpatient->patient->dob)) : '-' }}</td>
            <td>{{ $outpatient->patient->age ?? '-' }}</td>
            <td>{{ $outpatient->doctor_id ? $outpatient->doctor->name : '-' }}</td>
            <td>{{ $outpatient->doctorspecialization_id ? $outpatient->doctorspecialization->name : '-' }}</td>
            {{-- <td>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Document
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><a class="dropdown-item " href="#">Medical Certificate</a></li>
                        <li><a class="dropdown-item " href="#">Medical Fitness</a></li>
                        <li><a class="dropdown-item " href="#">Transfer Letter</a></li>
                    </ul>
                </div>
            </td> --}}
        </tr>
    </tbody>
</table>
