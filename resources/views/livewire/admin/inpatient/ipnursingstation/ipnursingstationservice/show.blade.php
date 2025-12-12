<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">IP ASSESMENT DETAILS</h5> : {{ $showdata->uniqid }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-dark p-2 shadow-sm border border-2 border-secondary rounded">
                        @include('helper.formhelper.showlabel', [
                            'name' => 'IP ASSESMENT ID',
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
                            'value' => $showdata->currentcomplaints->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'COMPLAINT NOTE',
                            'value' => $showdata->currentcomplaint_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PHYSICAL & GENERAL EXAM',
                            'value' => $showdata->physicalexam->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PHYSICAL & GENERAL EXAM NOTE',
                            'value' => $showdata->physicalexam_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'DIAGNOSIS',
                            'value' => $showdata->diagnosismaster->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'DIAGNOSIS NOTE',
                            'value' => $showdata->diagnosis_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="card-title fw-bold fs-5"><u> Lab Investigation</u></div>
                            <div>
                                <button wire:click="printipinvestigation({{ $showdata->id }})"
                                    class="btn btn-sm btn-success">Investigation
                                    List <i class="bi bi-printer"></i></button>
                                <button wire:click="printipinvestigationresult({{ $showdata->id }})"
                                    class="btn btn-sm btn-success">Investigation
                                    Result <i class="bi bi-printer"></i></button>
                            </div>
                        </div>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'LAB INVESTIGATION',
                            'value' => $showdata->labinvestigation->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'LAB INVESTIGATION NOTE',
                            'value' => $showdata->labinvestigation_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @if ($showdata->labinvestigation_file)
                            <div class="row col-md-6 p-1">
                                <label class="fw-bolder col-4 ">LAB INVESTIGATION FILE </label>
                                <div class="col-8">
                                    <b> : </b>
                                    <button
                                        wire:click="downloadFile('{{ $showdata->inpatient->uniqid }}','{{ $showdata->labinvestigation_file }}')"
                                        type="button" class="btn btn-sm btn-success"><i
                                            class="bi bi-download"></i></button>
                                </div>
                            </div>
                        @endif
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SCAN INVESTIGATION',
                            'value' => $showdata->scaninvestigation->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SCAN INVESTIGATION NOTE',
                            'value' => $showdata->scaninvestigation_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @if ($showdata->scaninvestigation_file)
                            <div class="row col-md-6 p-1">
                                <label class="fw-bolder col-4 ">SCAN INVESTIGATION FILE </label>
                                <div class="col-8">
                                    <b> : </b>
                                    <button
                                        wire:click="downloadFile('{{ $showdata->inpatient->uniqid }}','{{ $showdata->scaninvestigation_file }}')"
                                        type="button" class="btn btn-sm btn-success"><i
                                            class="bi bi-download"></i></button>
                                </div>
                            </div>
                        @endif
                        @include('helper.formhelper.showlabel', [
                            'name' => 'X-RAY INVESTIGATION',
                            'value' => $showdata->xrayinvestigation->pluck('name')->implode(' ,'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'X-RAY INVESTIGATION NOTE',
                            'value' => $showdata->xrayinvestigation_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @if ($showdata->xrayinvestigation_file)
                            <div class="row col-md-6 p-1">
                                <label class="fw-bolder col-4 ">X-RAY INVESTIGATION FILE </label>
                                <div class="col-8">
                                    <b> : </b>
                                    <button
                                        wire:click="downloadFile('{{ $showdata->inpatient->uniqid }}','{{ $showdata->xrayinvestigation_file }}')"
                                        type="button" class="btn btn-sm btn-success"><i
                                            class="bi bi-download"></i></button>
                                </div>
                            </div>
                        @endif
                        <hr>
                        @if ($showdata->subprescriptionable)
                            <div class="d-flex justify-content-between">
                                <div class="card-title fw-bold fs-5"><u> Prescription</u></div>
                                <div>
                                    <button wire:click="printipprescription({{ $showdata->id }})"
                                        class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
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
                                        @foreach ($showdata->subprescriptionable->prescriptionlist as $eachprescription)
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
                                'value' => $showdata->prescription_note,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-4',
                                'columnthree' => 'col-8',
                            ])
                            @if ($showdata->prescription_file)
                                <div class="row col-md-6 p-1">
                                    <label class="fw-bolder col-4 ">PRESCRIPTION UPLOADED FILE </label>
                                    <div class="col-8">
                                        <b> : </b>
                                        <button
                                            wire:click="downloadFile('{{ $showdata->inpatient->uniqid }}','{{ $showdata->prescription_file }}')"
                                            type="button" class="btn btn-sm btn-success"><i
                                                class="bi bi-download"></i></button>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <hr>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAST HISTORY',
                            'value' => $showdata->pasthistory_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'NUTRITIONAL SCREENING',
                            'value' => $showdata->nutritionalscreening_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PROVISIONAL DIAGNOSIS',
                            'value' => $showdata->provisionaldiagnosis_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PLAN OF CARE',
                            'value' => $showdata->planofcare_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SYSTEMIC EXAMINATION FINDING',
                            'value' => $showdata->systemicexamfinding_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'DIET ADVICE',
                            'value' => $showdata->dietadvice_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'NEXT VISIT',
                            'value' => $showdata->nextvisit_date,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'DOCTOR NOTE',
                            'value' => $showdata->doctor_note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-4',
                            'columnthree' => 'col-8',
                        ])
                    </div>

                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        @endif
    </div>
</div>
