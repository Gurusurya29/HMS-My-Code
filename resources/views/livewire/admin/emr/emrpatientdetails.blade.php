<div class="accordion accordion-flush" id="patientdetails">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button
                class="accordion-button collapsed  bg-white shadow-sm border border-1 border-primary rounded fs-5 p-2"
                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                aria-controls="flush-collapseOne">
                Patient Details
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#patientdetails">
            <div class="accordion-body">
                <div class="row text-dark p-2 shadow-sm border border-2 border-secondary rounded">
                    {{-- theme_bg_color --}}
                    @include('helper.formhelper.showlabel', [
                        'name' => 'UHID',
                        'value' => $patient->uhid,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])

                    @include('helper.formhelper.showlabel', [
                        'name' => 'NAME',
                        'value' => $patient->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'MOBILE NUMBER',
                        'value' => $patient->phone,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'GENDER',
                        'value' => $patient->gender ? config('archive.gender')[$patient->gender] : '-',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'AGE',
                        'value' => $patient->age ?? '-',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'AADHAR NUMBER',
                        'value' => $patient->aadharid,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'DATE OF BIRTH',
                        'value' => $patient->dob ? date('d-m-Y', strtotime($patient->dob)) : '-',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'PARENT/GUARDIAN',
                        'value' => $patient->parentorguardian,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'MARITAL STATUS',
                        'value' => $patient->marital_status
                            ? config('archive.marital_status')[$patient->marital_status]
                            : '',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'SPOUSE NAME',
                        'value' => $patient->spouse_name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CONTACT PERSON NAME',
                        'value' => $patient->contact_person_name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CONTACT PERSON PHONE',
                        'value' => $patient->contact_person_phone,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'DOOR NUMBER',
                        'value' => $patient->door_no,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'AREA',
                        'value' => $patient->area,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CITY',
                        'value' => $patient->city,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'PINCODE',
                        'value' => $patient->pincode,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'STATE',
                        'value' => $patient->state?->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'COUNTRY',
                        'value' => $patient->country?->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'REFERENCE',
                        'value' => $patient->reference?->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'NOTE',
                        'value' => $patient->note,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CREATED BY',
                        'value' => $patient->creatable->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CREATED AT',
                        'value' => $patient->created_at->format('d-m-Y h:i A'),
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-5',
                        'columnthree' => 'col-7',
                    ])
                    @if ($patient->updated_id)
                        @include('helper.formhelper.showlabel', [
                            'name' => 'UPDATED BY',
                            'value' => $patient->updatable->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'UPDATED AT',
                            'value' => $patient->updated_at->format('d-m-Y h:i A'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
