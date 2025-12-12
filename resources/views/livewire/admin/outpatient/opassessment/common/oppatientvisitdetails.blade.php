<div class="row align-items-center">
    <div class="accordion accordion-flush col-md-11" id="accordionFlushExample">
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
                            'value' => $outpatient->patientvisit->uniqid,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'OUT PATIENT ID',
                            'value' => $outpatient->uniqid,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TOKEN',
                            'value' => $outpatient->patientvisit->id,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'VISIT TYPE',
                            'value' => config('archive.patient_visittype')[
                                $outpatient->patientvisit->patient_visittype
                            ],
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'DOCTOR',
                            'value' => $outpatient->patientvisit->doctor_id
                                ? $outpatient->patientvisit->doctor->name
                                : '-',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SPECIALTY',
                            'value' => $outpatient->doctorspecialization_id
                                ? $outpatient->doctorspecialization->name
                                : '-',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'VISIT CATEGORY',
                            'value' => config('archive.visit_category')[
                                $outpatient->patientvisit->visit_category_id
                            ],
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CURRENT COMPLAINTS',
                            'value' => $outpatient->patientvisit->currentcomplaints->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'COMPLAINT NOTE',
                            'value' => $outpatient->patientvisit->complaint_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'ALLERGY',
                            'value' => $outpatient->patientvisit->allergymaster->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TEMPERATURE',
                            'value' => $outpatient->patientvisit->temperature,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'BLOOD PRESSURE',
                            'value' => $outpatient->patientvisit->bloodpressure,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'HEIGHT',
                            'value' => $outpatient->patientvisit->height,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'WEIGHT',
                            'value' => $outpatient->patientvisit->weight,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PULSE RATE',
                            'value' => $outpatient->patientvisit->pulserate,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'RESPIRATORY RATE',
                            'value' => $outpatient->patientvisit->respiratoryrate,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SpO2',
                            'value' => $outpatient->patientvisit->spo_two,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAIN SCALE (1-10)',
                            'value' => $outpatient->patientvisit->painscaleone
                                ? config('archive.pain_scale')[$outpatient->patientvisit->painscaleone]
                                : '',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CHARACTER',
                            'value' => $outpatient->patientvisit->character,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'ALCOHOL',
                            'value' => $outpatient->patientvisit->alcohol
                                ? ($outpatient->patientvisit->alcohol
                                    ? 'Yes'
                                    : 'No')
                                : '',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SMOKING',
                            'value' => $outpatient->patientvisit->smoking
                                ? ($outpatient->patientvisit->smoking
                                    ? 'Yes'
                                    : 'No')
                                : '',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TOBACCO',
                            'value' => $outpatient->patientvisit->tobacco
                                ? ($outpatient->patientvisit->tobacco
                                    ? 'Yes'
                                    : 'No')
                                : '',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'OTHERS',
                            'value' => $outpatient->patientvisit->others,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])

                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'ADDITIONAL NOTE',
                            'value' => $outpatient->patientvisit->visit_note,
                            'columnone' => 'col-md-12',
                            'columntwo' => 'col-2',
                            'columnthree' => 'col-10',
                        ])

                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED BY',
                            'value' => $outpatient->creatable->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED AT',
                            'value' => $outpatient->created_at->format('d-m-Y h:i A'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @if ($outpatient->updated_id)
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED BY',
                                'value' => $outpatient->updatedby?->name,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-4',
                                'columnthree' => 'col-8',
                            ])
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED AT',
                                'value' => $outpatient->updated_at->format('d-m-Y h:i A'),
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-4',
                                'columnthree' => 'col-8',
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        @if ($requesttype)
            <a href="{{ route('outpatienthistory') }}" class="btn btn-sm btn-secondary">Back</a>
        @else
            <a href="{{ route('outpatientqueue') }}" class="btn btn-sm btn-secondary">Back</a>
        @endif
    </div>
</div>
