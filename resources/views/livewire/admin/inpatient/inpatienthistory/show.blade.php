<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">PATIENT DETAILS</h5> : {{ $showdata->uniqid }} </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion accordion-flush" id="inpatienthistorydetails">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-primary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#patientvisitdetails"
                                    aria-expanded="false" aria-controls="patientvisitdetails">
                                    Patient Visit Details
                                </button>
                            </h2>
                            <div id="patientvisitdetails" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#inpatienthistorydetails">
                                <div class="accordion-body">
                                    <div class="row text-dark shadow-sm border border-2 border-secondary rounded p-2">
                                        {{-- theme_bg_color --}}
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'VISIT ID',
                                            'value' => $showdata->patientvisit->uniqid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'TOKEN',
                                            'value' => $showdata->patientvisit->id,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'DOCTOR',
                                            'value' => $showdata->patientvisit->doctor?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SPECIALTY',
                                            'value' => $showdata->patientvisit->doctorspecialization->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'VISIT CATEGORY',
                                            'value' => config('archive.visit_category')[
                                                $showdata->patientvisit->visit_category_id
                                            ],
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'VISIT TYPE',
                                            'value' => config('archive.patient_visittype')[
                                                $showdata->patientvisit->patient_visittype
                                            ],
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @if ($showdata->patientvisit->visit_category_id == 2)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'WARD TYPE',
                                                'value' => $showdata->patientvisit->wardtype?->name,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                        @endif
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'BILLING TYPE',
                                            'value' =>
                                                $showdata->patientvisit->billing_type == 1
                                                    ? 'SELF BILLING'
                                                    : 'INSURANCE BILLING',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @if ($showdata->patientvisit->billing_type == 2)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'INSURANCE COMPANY',
                                                'value' => $showdata->patientvisit->insurancecompany->name,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'TPA NAME',
                                                'value' => $showdata->patientvisit->insurancecompany->name,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'TPA ID NO',
                                                'value' => $showdata->patientvisit->tpaidno,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'POLICY NO',
                                                'value' => $showdata->patientvisit->policyno,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                        @endif
                                        <hr>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CURRENT COMPLAINTS',
                                            'value' => $showdata->patientvisit->currentcomplaints->pluck('name')->implode(' ,'),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'COMPLAINT NOTE',
                                            'value' => $showdata->patientvisit->complaint_note,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ALLERGY',
                                            'value' => $showdata->patientvisit->allergymaster->pluck('name')->implode(' ,'),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        <hr>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'TEMPERATURE',
                                            'value' => $showdata->patientvisit->temperature,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'BLOOD PRESSURE',
                                            'value' => $showdata->patientvisit->bloodpressure,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'HEIGHT',
                                            'value' => $showdata->patientvisit->height,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'WEIGHT',
                                            'value' => $showdata->patientvisit->weight,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PULSE RATE',
                                            'value' => $showdata->patientvisit->pulserate,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'RESPIRATORY RATE',
                                            'value' => $showdata->patientvisit->respiratoryrate,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SpO2',
                                            'value' => $showdata->patientvisit->spo_two,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PAIN SCALE (1-10)',
                                            'value' => $showdata->patientvisit->painscaleone
                                                ? config('archive.pain_scale')[
                                                    $showdata->patientvisit->painscaleone
                                                ]
                                                : '',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CHARACTER',
                                            'value' => $showdata->patientvisit->character,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        <hr>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ALCOHOL',
                                            'value' => $showdata->patientvisit->alcohol
                                                ? ($showdata->patientvisit->alcohol
                                                    ? 'Yes'
                                                    : 'No')
                                                : '',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SMOKING',
                                            'value' => $showdata->patientvisit->smoking
                                                ? ($showdata->patientvisit->smoking
                                                    ? 'Yes'
                                                    : 'No')
                                                : '',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'TOBACCO',
                                            'value' => $showdata->patientvisit->tobacco
                                                ? ($showdata->patientvisit->tobacco
                                                    ? 'Yes'
                                                    : 'No')
                                                : '',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'OTHERS',
                                            'value' => $showdata->patientvisit->others,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])

                                        <hr>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ADDITIONAL NOTE',
                                            'value' => $showdata->patientvisit->visit_note,
                                            'columnone' => 'col-md-12',
                                            'columntwo' => 'col-2',
                                            'columnthree' => 'col-10',
                                        ])

                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CREATED BY',
                                            'value' => $showdata->patientvisit->creatable->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CREATED AT',
                                            'value' => $showdata->patientvisit->created_at->format('d-m-Y h:i A'),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-4',
                                            'columnthree' => 'col-8',
                                        ])
                                        @if ($showdata->patientvisit->updated_id)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'UPDATED BY',
                                                'value' => $showdata->patientvisit->updatedby?->name,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'UPDATED AT',
                                                'value' => $showdata->patientvisit->updated_at->format(
                                                    'd-M-Y h:i'),
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-4',
                                                'columnthree' => 'col-8',
                                            ])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-ipadmission">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-primary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#ipdetails"
                                    aria-expanded="false" aria-controls="ipdetails">
                                    In Patient Details
                                </button>
                            </h2>
                            <div id="ipdetails" class="accordion-collapse collapse show"
                                aria-labelledby="flush-ipadmission" data-bs-parent="#inpatienthistorydetails">
                                <div class="accordion-body">
                                    <div class="row text-dark shadow-sm border border-2 border-secondary rounded p-2">

                                        <div class="fs-5 fw-bold"><span class="border-bottom border-secondary">IP
                                                Admission Details</span>
                                            :</div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'D.O.A',
                                            'value' => Carbon\Carbon::parse(
                                                $showdata->ipadmission->admission_date)->format('d-m-Y h:i A'),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'WARD',
                                            'value' => $showdata->ipadmission->wardtype->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'BED OR ROOM NUMBER',
                                            'value' => $showdata->ipadmission->bedorroomnumber->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'NAME',
                                            'value' => $showdata->ipadmission->salutation
                                                ? config('archive.salutation')[
                                                        $showdata->ipadmission->salutation
                                                    ] .
                                                    ' .' .
                                                    $showdata->ipadmission->name
                                                : $showdata->ipadmission->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'MOBILE NUMBER',
                                            'value' => $showdata->ipadmission->phone,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'GENDER',
                                            'value' => $showdata->ipadmission->gender
                                                ? config('archive.gender')[$showdata->ipadmission->gender]
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AGE',
                                            'value' => $showdata->ipadmission->age ?? '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AADHAR NUMBER',
                                            'value' => $showdata->ipadmission->aadharid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'DATE OF BIRTH',
                                            'value' => $showdata->ipadmission->dob
                                                ? date('d-m-Y', strtotime($showdata->ipadmission->dob))
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PARENT / GUARDIAN',
                                            'value' => $showdata->ipadmission->parentorguardian,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'MARITAL STATUS',
                                            'value' => $showdata->ipadmission->marital_status
                                                ? config('archive.marital_status')[
                                                    $showdata->ipadmission->marital_status
                                                ]
                                                : '',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SPOUSE NAME',
                                            'value' => $showdata->ipadmission->spouse_name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CONTACT PERSON NAME',
                                            'value' => $showdata->ipadmission->contact_person_name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CONTACT PERSON PHONE',
                                            'value' => $showdata->ipadmission->contact_person_phone,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'DOOR NUMBER',
                                            'value' => $showdata->ipadmission->door_no,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AREA',
                                            'value' => $showdata->ipadmission->area,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CITY',
                                            'value' => $showdata->ipadmission->city,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PINCODE',
                                            'value' => $showdata->ipadmission->pincode,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'STATE',
                                            'value' => $showdata->ipadmission->state?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'COUNTRY',
                                            'value' => $showdata->ipadmission->country?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'REFERENCE',
                                            'value' => $showdata->ipadmission->reference?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CREATED AT',
                                            'value' => $showdata->ipadmission->created_at->format('d-m-Y h:i A'),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CREATED BY',
                                            'value' => $showdata->ipadmission->creatable->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @if ($showdata->dsspecialable)
                                            @if ($showdata->dsspecialable->casesheet_file)
                                                <div class="row col-md-6 p-1">
                                                    <label class="fw-bolder col-4 ">CASE SHEET FILE </label>
                                                    <div class="col-8">
                                                        <b> : </b>
                                                        <button
                                                            wire:click="downloadFile('{{ $showdata->uniqid }}','{{ $showdata->dsspecialable->casesheet_file }}')"
                                                            type="button" class="btn btn-sm btn-success"><i
                                                                class="bi bi-download"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        <hr>
                                        <div class="fs-5 fw-bold col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">IP
                                                    Assesment Details</div>
                                                <div class="col-md-7">: <a
                                                        href="{{ route('ipassesmentlist', $showdata->uuid) }}"
                                                        target="_blank" class="link-primary fs-5">Click
                                                        Here for IP
                                                        Assesment Details</a></div>
                                            </div>
                                        </div>
                                        <div class="fs-5 fw-bold col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">IP
                                                    Surgery Details</div>
                                                <div class="col-md-7">: <a
                                                        href="{{ route('ipotscheduledlist', $showdata->uuid) }}"
                                                        target="_blank" class="link-primary fs-5">Click
                                                        Here for IP
                                                        Surgery Details</a></div>
                                            </div>
                                        </div>
                                        @if ($showdata->dsspecialable)
                                            <div class="fs-5 fw-bold col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">Print Discharge
                                                        Summary</div>
                                                    <div class="col-md-7">:
                                                        <a href="{{ route('printdischargesummary', $showdata->id) }}"
                                                            target="_blank" class="btn btn-sm btn-success"><i
                                                                class="bi bi-printer"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        @endif
    </div>
</div>
