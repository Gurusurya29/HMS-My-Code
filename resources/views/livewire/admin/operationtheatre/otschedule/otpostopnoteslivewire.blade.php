<div class="card">
    <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5"> POST-OP NOTES</span></div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('otschedulelist') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                @if ($otschedule)
                    <div class="table-responsive px-5 mt-4">
                        <table class="table table-bordered shadow-sm table-success text-center">
                            <thead class="fw-bold " style="font-size: 16px;">
                                <tr>
                                    <th scope="col">UHID</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Aadhar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fs-5">
                                    <td>{{ $otschedule->patient->uhid }}</td>
                                    <td>{{ $otschedule->patient->name }}</td>
                                    <td>{{ $otschedule->patient->phone }}</td>
                                    <td>{{ $otschedule->patient->dob ?? '-' }}</td>
                                    <td>{{ $otschedule->patient->aadharid ?? '-' }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="bg-white row m-2">
                            <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded mb-3">Surgery Time</div>
                            @include('helper.formhelper.form', [
                                'type' => 'time',
                                'fieldname' => 'surgerystart_time',
                                'labelname' => 'SURGERY START TIME',
                                'labelidname' => 'surgerystart_timeid',
                                'required' => true,
                                'col' => 'col-md-3',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'time',
                                'fieldname' => 'surgeryend_time',
                                'labelname' => 'SURGERY END TIME',
                                'labelidname' => 'surgeryend_timeid',
                                'required' => true,
                                'col' => 'col-md-3',
                            ])
                            <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded mb-3">Post-Op Notes</div>

                            @include('helper.formhelper.form', [
                                'type' => 'textarea',
                                'fieldname' => 'postop_note',
                                'labelname' => 'POST-OP NOTE',
                                'labelidname' => 'postop_noteid',
                                'required' => true,
                                'col' => 'col-md-12',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'textarea',
                                'fieldname' => 'postopadditional_note',
                                'labelname' => 'POST-OP ADDITIONAL NOTE',
                                'labelidname' => 'postopadditional_noteid',
                                'required' => true,
                                'col' => 'col-md-12',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'textarea',
                                'fieldname' => 'postop_remarks',
                                'labelname' => 'POST-OP REMARKS',
                                'labelidname' => 'postop_remarksid',
                                'required' => true,
                                'col' => 'col-md-12',
                            ])


                            @include('helper.formhelper.form', [
                                'type' => 'number',
                                'fieldname' => 'observationhours',
                                'labelname' => 'OBSERVATION HOURS',
                                'labelidname' => 'observationhoursid',
                                'required' => true,
                                'col' => 'col-md-3',
                            ])

                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if ($otschedule)
            <div class="card-footer text-center">
                <a href="" class="btn btn-secondary">Cancel</a>
                @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                    'method_name' => 'store',
                    'model_id' => '',
                ])
            </div>
        @endif
    </form>
</div>
