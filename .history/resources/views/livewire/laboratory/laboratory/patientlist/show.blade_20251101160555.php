<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">INVESTIGATION DETAILS : {{ $showdata->uniqid }} </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @include('helper.formhelper.showlabel', [
                            'name' => 'UNIQID',
                            'value' => $showdata->uniqid,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'NAME',
                            'value' => $showdata->patient->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'UHID',
                            'value' => $showdata->patient->uhid,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PHONE',
                            'value' => $showdata->patient->phone,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'AGE',
                            'value' => $showdata->patient->age ?? '-',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TOTAL',
                            'value' => $showdata->labpatientlist->sum('fee'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'MOVED BILL TOTAL',
                            'value' => $showdata->total,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        <div class="row col-md-6 p-1">
                            <label class="fw-bolder col-5 ">DISCOUNT(%) </label>
                            <label class="fst-normal text-break col-7"><b> : </b>
                                {{ $showdata->discount_value }}({{ $showdata->discount_percentage }}%)</label>
                        </div>
                        @include('helper.formhelper.showlabel', [
                            'name' => 'GRAND TOTAL',
                            'value' => $showdata->grand_total,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'NOTE',
                            'value' => $showdata->note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED BY',
                            'value' => $showdata->creatable->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])

                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED AT',
                            'value' => $showdata->created_at->format('d-m-Y h:i A'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @if ($showdata->updatable_id)
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED BY',
                                'value' => $showdata->updatable->name,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED AT',
                                'value' => $showdata->updated_at->format('d-m-Y h:i A'),
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive shadow-sm mb-2">
                        <table class="table table-bordered  p-0 m-0">
                            <thead class="theme_bg_color text-white">
                                <tr class="text-center">
                                    <th>S.NO</th>
                                    <th>INVESTIGATION GROUP NAME</th>
                                    <th>INVESTIGATION NAME</th>
                                    <th>EXTERNAL LAB</th>
                                    <th>MOVED TO BILL</th>
                                    <th>SAMPLE DONE</th>
                                    <th>UPDATE RESULT</th>
                                    <th>FEE</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($showdata->labpatientlist as $key => $eachlablist)
                                    <tr class="text-center">
                                        <td class="{{ $eachlablist->is_resultupdated ? 'text-success' : '' }}">
                                            {{ $key + 1 }}</td>
                                        <td class="{{ $eachlablist->is_resultupdated ? 'text-success' : '' }}">
                                            {{ $eachlablist->labinvestigationgroup_name }}</td>
                                        <td class="{{ $eachlablist->is_resultupdated ? 'text-success' : '' }}">
                                            {{ $eachlablist->labinvestigation_name }}</td>
                                        <td> {{ $eachlablist->is_senttoexternallab ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {{ $eachlablist->is_movedtobill ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            {{ $eachlablist->is_sampletaken ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            {{ $eachlablist->is_resultupdated ? 'Yes' : 'No' }}
                                        </td>
                                        <td>{{ $eachlablist->fee }}</td>
                                        <td>
                                            <button class="accordion-button collapsed p-1" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#lab_{{ $key }}"
                                                aria-expanded="true" aria-controls="lab_{{ $key }}">More
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="p-0 table-light">
                                            <div id="lab_{{ $key }}" class="accordion-collapse collapse">
                                                <div class="row px-3">
                                                    @include('helper.formhelper.showlabel', [
                                                        'name' => 'UNITS',
                                                        'value' => $eachlablist->units,
                                                        'columnone' => 'col-md-6',
                                                        'columntwo' => 'col-5',
                                                        'columnthree' => 'col-7',
                                                    ])
                                                    @include('helper.formhelper.showlabel', [
                                                        'name' => 'NORMAL RANGE',
                                                        'value' => $eachlablist->range,
                                                        'columnone' => 'col-md-6',
                                                        'columntwo' => 'col-5',
                                                        'columnthree' => 'col-7',
                                                    ])
                                                    @include('helper.formhelper.showlabel', [
                                                        'name' => 'TEST METHOD',
                                                        'value' => $eachlablist->testmethod,
                                                        'columnone' => 'col-md-6',
                                                        'columntwo' => 'col-5',
                                                        'columnthree' => 'col-7',
                                                    ])
                                                    @include('helper.formhelper.showlabel', [
                                                        'name' => 'SAMPLE NOTE',
                                                        'value' => $eachlablist->sample_note,
                                                        'columnone' => 'col-md-6',
                                                        'columntwo' => 'col-5',
                                                        'columnthree' => 'col-7',
                                                    ])
                                                    @include('helper.formhelper.showlabel', [
                                                        'name' => 'RESULT VALUE',
                                                        'value' => $eachlablist->result_note,
                                                        'columnone' => 'col-md-6',
                                                        'columntwo' => 'col-5',
                                                        'columnthree' => 'col-7',
                                                    ])
                                                    @if ($eachlablist->is_senttoexternallab)
                                                        @include('helper.formhelper.showlabel', [
                                                            'name' => 'EXTERNAL LAB NOTE',
                                                            'value' => $eachlablist->senttoexternal_note,
                                                            'columnone' => 'col-md-6',
                                                            'columntwo' => 'col-5',
                                                            'columnthree' => 'col-7',
                                                        ])
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
document.addEventListener('livewire:load', () => {
    window.addEventListener('show-lab-modal', () => {
        const modal = new bootstrap.Modal(document.getElementById('showModal'));
        modal.show();
    });
});
</script>
