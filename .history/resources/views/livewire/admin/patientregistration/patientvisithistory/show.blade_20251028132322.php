<!-- <div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
        <div class="modal-content">
            <div class="modal-header text-white theme_bg_color px-3 py-2">
                <h5 class="modal-title" id="showModalLabel"> PATIENT VISIT DETAILS </h5> :
                {{ $showdata->uniqid }} </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-dark p-2 shadow-sm border border-2 border-secondary rounded">
                    {{-- theme_bg_color --}}
                    @include('helper.formhelper.showlabel', [
                    'name' => 'VISIT ID',
                    'value' => $showdata->uniqid,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'TOKEN',
                    'value' => $showdata->id,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'DOCTOR',
                    'value' => $showdata->doctor?->name,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'SPECIALTY',
                    'value' => $showdata->doctorspecialization->name,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'VISIT CATEGORY',
                    'value' => config('archive.visit_category')[$showdata->visit_category_id],
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'VISIT TYPE',
                    'value' => config('archive.patient_visittype')[$showdata->patient_visittype],
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @if ($showdata->visit_category_id == 2)
                    @include('helper.formhelper.showlabel', [
                    'name' => 'WARD TYPE',
                    'value' => $showdata->wardtype?->name,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @endif
                    @include('helper.formhelper.showlabel', [
                    'name' => 'BILLING TYPE',
                    'value' => $showdata->billing_type == 1 ? 'SELF BILLING' : 'INSURANCE BILLING',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @if ($showdata->billing_type == 2)
                    @include('helper.formhelper.showlabel', [
                    'name' => 'INSURANCE COMPANY',
                    'value' => optional($showdata->insurancecompany)->name ?? '-',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'TPA NAME',
                    'value' => optional($showdata->tpa)->name ?? '-',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'TPA ID NO',
                    'value' => $showdata->tpaidno ?? '-',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'POLICY NO',
                    'value' => $showdata->policyno ?? '-',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])

                    @endif
                    <hr>
                    @include('helper.formhelper.showlabel', [
                    'name' => 'CURRENT COMPLAINTS',
                    'value' => $showdata->currentcomplaints->pluck('name')->implode(' ,'),
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'COMPLAINT NOTE',
                    'value' => $showdata->complaint_note,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'ALLERGY',
                    'value' => $showdata->allergymaster->pluck('name')->implode(' ,'),
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    <hr>
                    @include('helper.formhelper.showlabel', [
                    'name' => 'TEMPERATURE',
                    'value' => $showdata->temperature,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'BLOOD PRESSURE',
                    'value' => $showdata->bloodpressure,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'HEIGHT',
                    'value' => $showdata->height,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'WEIGHT',
                    'value' => $showdata->weight,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'PULSE RATE',
                    'value' => $showdata->pulserate,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'RESPIRATORY RATE',
                    'value' => $showdata->respiratoryrate,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'SpO2',
                    'value' => $showdata->spo_two,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'PAIN SCALE (1-10)',
                    'value' => $showdata->painscaleone
                    ? config('archive.pain_scale')[$showdata->painscaleone]
                    : '',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'CHARACTER',
                    'value' => $showdata->character,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    <hr>
                    @include('helper.formhelper.showlabel', [
                    'name' => 'ALCOHOL',
                    'value' => $showdata->alcohol ? ($showdata->alcohol ? 'Yes' : 'No') : '',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'SMOKING',
                    'value' => $showdata->smoking ? ($showdata->smoking ? 'Yes' : 'No') : '',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'TOBACCO',
                    'value' => $showdata->tobacco ? ($showdata->tobacco ? 'Yes' : 'No') : '',
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'OTHERS',
                    'value' => $showdata->others,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])

                    <hr>
                    @include('helper.formhelper.showlabel', [
                    'name' => 'ADDITIONAL NOTE',
                    'value' => $showdata->visit_note,
                    'columnone' => 'col-md-12',
                    'columntwo' => 'col-2',
                    'columnthree' => 'col-10',
                    ])

                    @include('helper.formhelper.showlabel', [
                    'name' => 'CREATED BY',
                    'value' => $showdata->creatable->name,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'CREATED AT',
                    'value' => $showdata->created_at->format('d-m-Y h:i A'),
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @if ($showdata->updated_id)
                    @include('helper.formhelper.showlabel', [
                    'name' => 'UPDATED BY',
                    'value' => $showdata->updatedby?->name,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'UPDATED AT',
                    'value' => $showdata->updated_at->format('d-m-Y h:i A'),
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @endif
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- ✅ Bootstrap 5 JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            {{-- Modal Header --}}
            <div class="modal-header text-white theme_bg_color px-3 py-2">
                <h5 class="modal-title" id="showModalLabel">
                    PATIENT VISIT DETAILS
                    @if ($showdata)
                    : {{ $showdata->uniqid }}
                    @endif
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body">
                @if ($showdata)
                <div class="row text-dark p-2 shadow-sm border border-2 border-secondary rounded">
                    {{-- Example Info --}}
                    @include('helper.formhelper.showlabel', [
                    'name' => 'VISIT ID',
                    'value' => $showdata->uniqid,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    @include('helper.formhelper.showlabel', [
                    'name' => 'TOKEN',
                    'value' => $showdata->id,
                    'columnone' => 'col-md-6',
                    'columntwo' => 'col-4',
                    'columnthree' => 'col-8',
                    ])
                    {{-- ... your remaining include blocks remain unchanged ... --}}
                </div>
                @else
                <div class="text-center py-5 text-muted">Loading patient details...</div>
                @endif
            </div>

            {{-- Modal Footer --}}
            <div class="modal-footer bg-light px-2 py-1">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>