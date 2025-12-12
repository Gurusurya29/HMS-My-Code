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
                    <div class="accordion accordion-flush" id="othistorydetails">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-primary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#patientdetails"
                                    aria-expanded="false" aria-controls="patientdetails">
                                    Patient Details
                                </button>
                            </h2>
                            <div id="patientdetails" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#othistorydetails">
                                <div class="accordion-body">
                                    <div class="row text-dark shadow-sm rounded">
                                        {{-- theme_bg_color --}}
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'UHID',
                                            'value' => $showdata->patient->uhid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])

                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'NAME',
                                            'value' => $showdata->inpatient->ipadmission->salutation
                                                ? config('archive.salutation')[
                                                        $showdata->inpatient->ipadmission->salutation
                                                    ] .
                                                    ' .' .
                                                    $showdata->inpatient->ipadmission->name
                                                : $showdata->inpatient->ipadmission->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'MOBILE NUMBER',
                                            'value' => $showdata->inpatient->ipadmission->phone,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'GENDER',
                                            'value' => $showdata->inpatient->ipadmission->gender
                                                ? config('archive.gender')[
                                                    $showdata->inpatient->ipadmission->gender
                                                ]
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AGE',
                                            'value' => $showdata->inpatient->ipadmission->age ?? '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'WARD',
                                            'value' => $showdata->inpatient->ipadmission->wardtype->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'BED OR ROOM NUMBER',
                                            'value' => $showdata->inpatient->ipadmission->bedorroomnumber->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AADHAR NUMBER',
                                            'value' => $showdata->inpatient->ipadmission->aadharid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'DATE OF BIRTH',
                                            'value' => $showdata->inpatient->ipadmission->dob
                                                ? date('d-m-Y', strtotime($showdata->inpatient->ipadmission->dob))
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'FATHER/HUSBAND',
                                            'value' => $showdata->inpatient->ipadmission->fatherorhusband,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'MARITAL STATUS',
                                            'value' => $showdata->inpatient->ipadmission->marital_status
                                                ? config('archive.marital_status')[
                                                    $showdata->inpatient->ipadmission->marital_status
                                                ]
                                                : '',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SPOUSE NAME',
                                            'value' => $showdata->inpatient->ipadmission->spouse_name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CONTACT PERSON NAME',
                                            'value' => $showdata->inpatient->ipadmission->contact_person_name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CONTACT PERSON PHONE',
                                            'value' => $showdata->inpatient->ipadmission->contact_person_phone,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'DOOR NUMBER',
                                            'value' => $showdata->inpatient->ipadmission->door_no,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AREA',
                                            'value' => $showdata->inpatient->ipadmission->area,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CITY',
                                            'value' => $showdata->inpatient->ipadmission->city,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PINCODE',
                                            'value' => $showdata->inpatient->ipadmission->pincode,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'STATE',
                                            'value' => $showdata->inpatient->ipadmission->state?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'COUNTRY',
                                            'value' => $showdata->inpatient->ipadmission->country?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'REFERENCE',
                                            'value' => $showdata->inpatient->ipadmission->reference?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-primary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#otdetails"
                                    aria-expanded="false" aria-controls="otdetails">
                                    OT Details
                                </button>
                            </h2>
                            <div id="otdetails" class="accordion-collapse collapse show"
                                aria-labelledby="flush-headingOne" data-bs-parent="#othistorydetails">
                                <div class="accordion-body">
                                    <div class="row text-dark shadow-sm rounded">
                                        {{-- theme_bg_color --}}
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'OT ID',
                                            'value' => $showdata->uniqid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'Doctor',
                                            'value' => $showdata->doctor?->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'OPERATION THEATRE',
                                            'value' => $showdata->bedorroomnumber->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SURGERY NAME',
                                            'value' => $showdata->surgery_name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'OT START DATE',
                                            'value' => $showdata->surgery_startdate
                                                ? date('d-m-Y h:i A', strtotime($showdata->surgery_startdate))
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'OT END DATE',
                                            'value' => $showdata->surgery_enddate
                                                ? date('d-m-Y h:i A', strtotime($showdata->surgery_enddate))
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SCHEDULE NOTE',
                                            'value' => $showdata->schedule_note,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CHIEF SURGEON',
                                            'value' => $showdata->chief_surgeon,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SENIOR SURGEON',
                                            'value' => $showdata->senior_surgeon,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ASSISTANT SURGEON',
                                            'value' => $showdata->asst_surgeon,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'NURSING ASSISTANT',
                                            'value' => $showdata->nursing_asst,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'OTHERS',
                                            'value' => $showdata->others,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SURGERY DETAILS',
                                            'value' => $showdata->surgery_details,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @if ($showdata->writtenconsent_file)
                                            <div class="row col-md-6 p-1">
                                                <label class="fw-bolder col-5 ">WRITTEN CONSENT</label>
                                                <div class="col-7">
                                                    <b> : </b>
                                                    <button
                                                        wire:click="downloadFile('{{ $showdata->uniqid }}','{{ $showdata->writtenconsent_file }}')"
                                                        type="button" class="btn btn-sm btn-success"><i
                                                            class="bi bi-download"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($showdata->is_movetoip)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'CONFIRMATION NOTE FOR IP MOVEMENT',
                                                'value' => $showdata->movetoip_note,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                        @endif
                                        @if ($showdata->otsurgerypreop)
                                            <hr>
                                            <div class="card-title fw-bold fs-5"><u> Pre-Op Surgery Notes </u></div>
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'PRE-OP NOTE',
                                                'value' => $showdata->otsurgerypreop->preop_note,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-3',
                                                'columnthree' => 'col-9',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'PRE-OP ADDITIONAL NOTE',
                                                'value' => $showdata->otsurgerypreop->preopadditional_note,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-3',
                                                'columnthree' => 'col-9',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'PRE-OP REMARKS',
                                                'value' => $showdata->otsurgerypreop->preop_remarks,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-3',
                                                'columnthree' => 'col-9',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'WRITTEN CONSENT RECEIVED',
                                                'value' => $showdata->otsurgerypreop->is_writtenconsent
                                                    ? 'YES'
                                                    : 'NO',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'SHAVE & PREPARE SKIN WITH BETADINE',
                                                'value' => $showdata->otsurgerypreop->is_betadine ? 'YES' : 'NO',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'NIL ORAL FROM DATE',
                                                'value' => $showdata->otsurgerypreop->niloral_date
                                                    ? date(
                                                        'd-m-Y',
                                                        strtotime($showdata->otsurgerypreop->niloral_date)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'NIL ORAL FROM TIME',
                                                'value' => $showdata->otsurgerypreop->niloral_time
                                                    ? date(
                                                        'h:i a',
                                                        strtotime($showdata->otsurgerypreop->niloral_time)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'RESERVED UNITS OF COMPATIBLE BLOOD',
                                                'value' => $showdata->otsurgerypreop->res_bloodunits,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'RESERVED BLOOD GROUP',
                                                'value' => $showdata->otsurgerypreop->blood_group
                                                    ? config('archive.res_bloodgroup')[
                                                        $showdata->otsurgerypreop->blood_group
                                                    ]
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'RESERVED DATE OF COMPATIBLE BLOOD',
                                                'value' => $showdata->otsurgerypreop->res_blooddate
                                                    ? date(
                                                        'd-m-Y',
                                                        strtotime($showdata->otsurgerypreop->res_blooddate)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'RESERVED TIME OF COMPATIBLE BLOOD',
                                                'value' => $showdata->otsurgerypreop->res_bloodtime
                                                    ? date(
                                                        'h:i a',
                                                        strtotime($showdata->otsurgerypreop->res_bloodtime)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'SEND THE PATIENT TO THEATRE DATE',
                                                'value' => $showdata->otsurgerypreop->patientsent_date
                                                    ? date(
                                                        'd-m-Y',
                                                        strtotime($showdata->otsurgerypreop->patientsent_date)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'SEND THE PATIENT TO THEATRE TIME',
                                                'value' => $showdata->otsurgerypreop->patientsent_time
                                                    ? date(
                                                        'h:i a',
                                                        strtotime($showdata->otsurgerypreop->patientsent_time)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'ANAESTHETIST',
                                                'value' => $showdata->otsurgerypreop->anaesthetist,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-2',
                                                'columnthree' => 'col-10',
                                            ])
                                        @endif
                                        @if ($showdata->otsurgerypostop)
                                            <hr>
                                            <div class="card-title fw-bold fs-5"><u> Post-Op Surgery Notes </u></div>
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'POST-OP NOTE',
                                                'value' => $showdata->otsurgerypostop->postop_note,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-3',
                                                'columnthree' => 'col-9',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'POST-OP ADDITIONAL NOTE',
                                                'value' => $showdata->otsurgerypostop->postopadditional_note,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-3',
                                                'columnthree' => 'col-9',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'POST-OP REMARKS',
                                                'value' => $showdata->otsurgerypostop->postop_remarks,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-3',
                                                'columnthree' => 'col-9',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'SURGERY START TIME',
                                                'value' => date(
                                                    'h:i a',
                                                    strtotime($showdata->otsurgerypostop->surgerystart_time)
                                                ),
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'SURGERY END TIME',
                                                'value' => $showdata->otsurgerypostop->surgeryend_time
                                                    ? date(
                                                        'h:i a',
                                                        strtotime($showdata->otsurgerypostop->surgeryend_time)
                                                    )
                                                    : '-',
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'OBSERVATION HOURS',
                                                'value' => $showdata->otsurgerypostop->observationhours,
                                                'columnone' => 'col-md-12',
                                                'columntwo' => 'col-2',
                                                'columnthree' => 'col-10',
                                            ])
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
