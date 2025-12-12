<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button
                class="accordion-button collapsed  bg-white shadow-sm border border-2 border-secondary rounded fs-5 p-2"
                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                aria-controls="flush-collapseOne">
                Patient Visit Details
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="row text-dark p-2 shadow-sm border border-2 border-secondary rounded">
                    {{-- theme_bg_color --}}
                    @include('helper.formhelper.showlabel', [
                        'name' => 'VISIT ID',
                        'value' => $inpatient->patientvisit->uniqid,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'IN PATIENT ID',
                        'value' => $inpatient->uniqid,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'TOKEN',
                        'value' => $inpatient->patientvisit->id,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'DOCTOR',
                        'value' => $inpatient->patientvisit->doctor?->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'SPECIALTY',
                        'value' => $inpatient->patientvisit->doctorspecialization?->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'VISIT CATEGORY',
                        'value' => config('archive.visit_category')[$inpatient->patientvisit->visit_category_id],
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'VISIT TYPE',
                        'value' => config('archive.patient_visittype')[
                            $inpatient->patientvisit->patient_visittype
                        ],
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'BILLING TYPE',
                        'value' =>
                            $inpatient->patientvisit->billing_type == 1 ? 'SELF BILLING' : 'INSURANCE BILLING',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @if ($inpatient->patientvisit->billing_type == 2)
                        @include('helper.formhelper.showlabel', [
                            'name' => 'INSURANCE COMPANY',
                            'value' => $inpatient->patientvisit->insurancecompany?->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TPA NAME',
                            'value' => $inpatient->patientvisit->insurancecompany?->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TPA ID NO',
                            'value' => $inpatient->patientvisit->tpaidno,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'POLICY NO',
                            'value' => $inpatient->patientvisit->policyno,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                    @endif
                    <hr>
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CURRENT COMPLAINTS',
                        'value' => $inpatient->patientvisit->currentcomplaints->pluck('name')->implode(' ,'),
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'COMPLAINT NOTE',
                        'value' => $inpatient->patientvisit->complaint_note,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'ALLERGY',
                        'value' => $inpatient->patientvisit->allergymaster->pluck('name')->implode(' ,'),
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    <hr>
                    @include('helper.formhelper.showlabel', [
                        'name' => 'TEMPERATURE',
                        'value' => $inpatient->patientvisit->temperature,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'BLOOD PRESSURE',
                        'value' => $inpatient->patientvisit->bloodpressure,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'HEIGHT',
                        'value' => $inpatient->patientvisit->height,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'WEIGHT',
                        'value' => $inpatient->patientvisit->weight,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'PULSE RATE',
                        'value' => $inpatient->patientvisit->pulserate,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'RESPIRATORY RATE',
                        'value' => $inpatient->patientvisit->respiratoryrate,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'SpO2',
                        'value' => $inpatient->patientvisit->spo_two,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'PAIN SCALE (1-10)',
                        'value' => $inpatient->patientvisit->painscaleone
                            ? config('archive.pain_scale')[$inpatient->patientvisit->painscaleone]
                            : '',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'CHARACTER',
                        'value' => $inpatient->patientvisit->character,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    <hr>
                    @include('helper.formhelper.showlabel', [
                        'name' => 'ALCOHOL',
                        'value' => $inpatient->patientvisit->alcohol
                            ? ($inpatient->patientvisit->alcohol
                                ? 'Yes'
                                : 'No')
                            : '',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'SMOKING',
                        'value' => $inpatient->patientvisit->smoking
                            ? ($inpatient->patientvisit->smoking
                                ? 'Yes'
                                : 'No')
                            : '',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'TOBACCO',
                        'value' => $inpatient->patientvisit->tobacco
                            ? ($inpatient->patientvisit->tobacco
                                ? 'Yes'
                                : 'No')
                            : '',
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'OTHERS',
                        'value' => $inpatient->patientvisit->others,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])

                    <hr>
                    @include('helper.formhelper.showlabel', [
                        'name' => 'ADDITIONAL NOTE',
                        'value' => $inpatient->patientvisit->visit_note,
                        'columnone' => 'col-md-12',
                        'columntwo' => 'col-2',
                        'columnthree' => 'col-10',
                    ])

                    {{-- @include('helper.formhelper.showlabel', [
                    'name' => 'CREATED BY',
                    'value' => $inpatient->creatable->name,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                ])
                @include('helper.formhelper.showlabel', [
                    'name' => 'CREATED AT',
                    'value' => $inpatient->created_at->format('d-m-Y h:i A'),
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                ])
                @if ($inpatient->updated_id)
                    @include('helper.formhelper.showlabel', [
                        'name' => 'UPDATED BY',
                        'value' => $inpatient->updatedby?->name,
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                        'name' => 'UPDATED AT',
                        'value' => $inpatient->updated_at->format('d-m-Y h:i A'),
                        'columnone' => 'col-md-6',
                        'columntwo' => 'col-4',
                        'columnthree' => 'col-8',
                    ])
                @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
