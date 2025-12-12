<div class="row text-dark shadow-sm rounded">
    {{-- theme_bg_color --}}
    @include('helper.formhelper.showlabel', [
        'name' => 'OP ID',
        'value' => $showdata->uniqid,
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
    <hr>
    @include('helper.formhelper.showlabel', [
        'name' => 'CURRENT COMPLAINTS',
        'value' => $showdata->specialable->currentcomplaints->pluck('name')->implode(' ,'),
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'COMPLAINT NOTE',
        'value' => $showdata->specialable->currentcomplaint_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    <hr>
    @include('helper.formhelper.showlabel', [
        'name' => 'PHYSICAL & GENERAL EXAM',
        'value' => $showdata->specialable->physicalexam->pluck('name')->implode(' ,'),
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'PHYSICAL & GENERAL EXAM NOTE',
        'value' => $showdata->specialable->physicalexam_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    <hr>
    @include('helper.formhelper.showlabel', [
        'name' => 'DIAGNOSIS',
        'value' => $showdata->specialable->diagnosismaster->pluck('name')->implode(' ,'),
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'DIAGNOSIS NOTE',
        'value' => $showdata->specialable->diagnosis_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    <hr>
    <div class="d-flex justify-content-between">
        <div class="card-title fw-bold fs-5"><u> Lab Investigation</u></div>
        <div>
            <div>
                <button wire:click="opprintinvestigation({{ $showdata->id }})"
                    class="btn btn-sm btn-success">Investigation
                    List <i class="bi bi-printer"></i></button>
                <button wire:click="opprintinvestigationresult({{ $showdata->id }})"
                    class="btn btn-sm btn-success">Investigation
                    Result <i class="bi bi-printer"></i></button>
            </div>
        </div>
    </div>
    @include('helper.formhelper.showlabel', [
        'name' => 'LAB INVESTIGATION',
        'value' => $showdata->specialable->labinvestigation->pluck('name')->implode(' ,'),
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'LAB INVESTIGATION NOTE',
        'value' => $showdata->specialable->labinvestigation_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @if ($showdata->specialable->labinvestigation_file)
        <div class="row col-md-6 p-1">
            <label class="fw-bolder col-4 ">LAB INVESTIGATION FILE </label>
            <div class="col-8">
                <b> : </b>
                <button
                    wire:click="downloadFile('{{ $showdata->uniqid }}','{{ $showdata->specialable->labinvestigation_file }}')"
                    type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i></button>
            </div>
        </div>
    @endif
    @include('helper.formhelper.showlabel', [
        'name' => 'SCAN INVESTIGATION',
        'value' => $showdata->specialable->scaninvestigation->pluck('name')->implode(' ,'),
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'SCAN INVESTIGATION NOTE',
        'value' => $showdata->specialable->scaninvestigation_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @if ($showdata->specialable->scaninvestigation_file)
        <div class="row col-md-6 p-1">
            <label class="fw-bolder col-4 ">SCAN INVESTIGATION FILE </label>
            <div class="col-8">
                <b> : </b>
                <button
                    wire:click="downloadFile('{{ $showdata->uniqid }}','{{ $showdata->specialable->scaninvestigation_file }}')"
                    type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i></button>
            </div>
        </div>
    @endif
    @include('helper.formhelper.showlabel', [
        'name' => 'X-RAY INVESTIGATION',
        'value' => $showdata->specialable->xrayinvestigation->pluck('name')->implode(' ,'),
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'X-RAY INVESTIGATION NOTE',
        'value' => $showdata->specialable->xrayinvestigation_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @if ($showdata->specialable->xrayinvestigation_file)
        <div class="row col-md-6 p-1">
            <label class="fw-bolder col-4 ">X-RAY INVESTIGATION FILE </label>
            <div class="col-8">
                <b> : </b>
                <button
                    wire:click="downloadFile('{{ $showdata->uniqid }}','{{ $showdata->specialable->xrayinvestigation_file }}')"
                    type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i></button>
            </div>
        </div>
    @endif
    <hr>
    @if ($showdata->prescriptionable)
        <div class="d-flex justify-content-between">
            <div class="card-title fw-bold fs-5"><u> Prescription</u></div>
            <div>
                <button wire:click="printprescription({{ $showdata->id }})" class="btn btn-sm btn-success"><i
                        class="bi bi-printer"></i></button>
            </div>
        </div>
        <div class="table-resposive">
            <table class="table table-sm table-bordered text-center border-dark">
                <thead>
                    <tr>
                        <th style="width: 25%;">DRUG</th>
                        <th style="width: 10%;">MORNING</th>
                        <th style="width: 10%;">AFTERNOON</th>
                        <th style="width: 10%;">EVENING</th>
                        <th style="width: 10%;">NIGHT</th>
                        <th style="width: 10%;">BF</th>
                        <th style="width: 10%;">AF</th>
                        <th style="width: 10%;">COUNT</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($showdata->prescriptionable->prescriptionlist as $eachprescription)
                        <tr>
                            <td>{{ $eachprescription->drug_name }}</td>
                            <td>{{ $eachprescription->morning ? '1' : '' }}</td>
                            <td>{{ $eachprescription->afternoon ? '1' : '' }}</td>
                            <td>{{ $eachprescription->evening ? '1' : '' }}</td>
                            <td>{{ $eachprescription->night ? '1' : '' }}</td>
                            <td>{{ $eachprescription->before_food ? '1' : '' }}
                            </td>
                            <td>{{ $eachprescription->after_food ? '1' : '' }}
                            </td>
                            <td>{{ $eachprescription->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('helper.formhelper.showlabel', [
            'name' => 'PRESCRIPTION NOTE',
            'value' => $showdata->specialable->prescription_note,
            'columnone' => 'col-md-6',
            'columntwo' => 'col-4',
            'columnthree' => 'col-8',
        ])
        @if ($showdata->specialable->prescription_file)
            <div class="row col-md-6 p-1">
                <label class="fw-bolder col-4 ">PRESCRIPTION FILE </label>
                <div class="col-8">
                    <b> : </b>
                    <button
                        wire:click="downloadFile('{{ $showdata->uniqid }}','{{ $showdata->specialable->prescription_file }}')"
                        type="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i></button>
                </div>
            </div>
        @endif
    @endif
    <hr>
    @include('helper.formhelper.showlabel', [
        'name' => 'PAST HISTORY',
        'value' => $showdata->specialable->pasthistory_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'NUTRITIONAL SCREENING',
        'value' => $showdata->specialable->nutritionalscreening_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'PROVISIONAL DIAGNOSIS',
        'value' => $showdata->specialable->provisionaldiagnosis_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'PLAN OF CARE',
        'value' => $showdata->specialable->planofcare_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'SYSTEMIC EXAMINATION FINDING',
        'value' => $showdata->specialable->systemicexamfinding_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'DIET ADVICE',
        'value' => $showdata->specialable->dietadvice_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'NEXT VISIT',
        'value' => $showdata->specialable->nextvisit_date
            ? date('d-m-Y', strtotime($showdata->specialable->nextvisit_date))
            : '-',
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'DOCTOR NOTE',
        'value' => $showdata->specialable->doctor_note,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-4',
        'columnthree' => 'col-8',
    ])
</div>
