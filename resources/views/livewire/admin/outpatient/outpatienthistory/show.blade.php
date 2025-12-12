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
                    <div class="accordion accordion-flush" id="outpatienthistorydetails">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-primary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#patientvisitdetails"
                                    aria-expanded="false" aria-controls="patientvisitdetails">
                                    Patient Visit Details
                                </button>
                            </h2>
                            <div id="patientvisitdetails" class="accordion-collapse collapse show"
                                aria-labelledby="flush-headingOne" data-bs-parent="#outpatienthistorydetails">
                                <div class="accordion-body">
                                    <div class="row text-dark shadow-sm rounded">
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
                                                    'd-M-Y h:i'
                                                ),
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
                            <h2 class="accordion-header" id="flush-opassesment">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-primary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#opassesmentdetails"
                                    aria-expanded="false" aria-controls="opassesmentdetails">
                                    OP Assesment Details
                                </button>
                            </h2>
                            <div id="opassesmentdetails" class="accordion-collapse collapse"
                                aria-labelledby="flush-opassesment" data-bs-parent="#outpatienthistorydetails">
                                <div class="accordion-body">
                                    @switch($showdata->patientvisit->doctorspecialization_id)
                                        @case(1)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopgeneral')
                                        @break

                                        @case(2)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopgynecology')
                                        @break

                                        @case(3)
                                            @include('livewire.admin.outpatient.outpatienthistory.showoporthopedic')
                                        @break

                                        @case(4)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopdermatology')
                                        @break

                                        @case(5)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopurology')
                                        @break

                                        @case(6)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopdiabetology')
                                        @break

                                        @case(7)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopcardiology')
                                        @break

                                        @case(8)
                                            @include('livewire.admin.outpatient.outpatienthistory.showoppaediatric')
                                        @break

                                        @case(9)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopophthalmology')
                                        @break

                                        @case(10)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopneurology')
                                        @break

                                        @case(11)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopnephrology')
                                        @break

                                        @case(12)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopanesthesiology')
                                        @break

                                        @case(13)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopsonology')
                                        @break

                                        @case(14)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopgastro')
                                        @break

                                        @case(15)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopdental')
                                        @break

                                        @case(16)
                                            @include('livewire.admin.outpatient.outpatienthistory.showopgeneralsurgeon')
                                        @break
                                    @endswitch
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
