<div class="card">
    <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5"> PRE-OP NOTES</span></div>
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
                            <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded mb-3">Pre-Op Orders</div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">WRITTEN CONSENT RECEIVED</label>
                                <span class="text-danger fw-bold">*</span>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-info shadow" type="radio"
                                        id="is_writtenconsentyes" value="1" wire:model="is_writtenconsent">
                                    <label class="form-check-label fw-bold" for="is_writtenconsentyes">YES</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-info shadow" type="radio"
                                        id="is_writtenconsentno" value="0" wire:model="is_writtenconsent">
                                    <label class="form-check-label fw-bold" for="is_writtenconsentno">NO</label>
                                </div>
                                @error('is_writtenconsent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @include('helper.formhelper.form', [
                                'type' => 'file',
                                'fieldname' => 'writtenconsent_file',
                                'labelname' => 'UPLOAD WRITTEN CONSENT',
                                'labelidname' => 'writtenconsent_fileid',
                                'required' => false,
                                'col' => 'col-md-4',
                                'is_uploaded' => $tempwrittenconsent_file ? true : false,
                            ])
                            <div class="col-md-4 mb-3">
                                <label class="form-label">SHAVE & PREPARE SKIN WITH BETADINE</label>
                                <span class="text-danger fw-bold">*</span>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-info shadow" type="radio"
                                        id="is_betadineyes" value="1" wire:model="is_betadine">
                                    <label class="form-check-label fw-bold" for="is_betadineyes">YES</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border border-info shadow" type="radio"
                                        id="is_betadineno" value="0" wire:model="is_betadine">
                                    <label class="form-check-label fw-bold" for="is_betadineno">NO</label>
                                </div>
                                @error('is_betadine')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @include('helper.formhelper.form', [
                                'type' => 'date',
                                'fieldname' => 'niloral_date',
                                'labelname' => 'NIL ORAL FROM DATE',
                                'labelidname' => 'niloral_dateid',
                                'required' => true,
                                'col' => 'col-md-4',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'time',
                                'fieldname' => 'niloral_time',
                                'labelname' => 'NIL ORAL FROM TIME',
                                'labelidname' => 'niloral_timeid',
                                'required' => true,
                                'col' => 'col-md-4',
                            ])
                            <hr>
                            <div class="fs-5 fw-bold mb-3"><span class="border-2 border-bottom border-dark">Reserve
                                    Blood For Surgery</span> :
                            </div>
                            @include('helper.formhelper.form', [
                                'type' => 'number',
                                'fieldname' => 'res_bloodunits',
                                'labelname' => 'NO OF UNITS',
                                'labelidname' => 'res_bloodunitsid',
                                'required' => false,
                                'col' => 'col-md-3',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'select',
                                'default_option' => 'Select Blood Group',
                                'fieldname' => 'res_bloodgroup',
                                'labelname' => 'BLOOG GROUP',
                                'labelidname' => 'res_bloodgroupid',
                                'required' => false,
                                'col' => 'col-md-3',
                                'option' => config('archive.blood_group'),
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'date',
                                'fieldname' => 'res_blooddate',
                                'labelname' => 'RESERVE DATE',
                                'labelidname' => 'res_blooddateid',
                                'required' => false,
                                'col' => 'col-md-3',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'time',
                                'fieldname' => 'res_bloodtime',
                                'labelname' => 'RESERVE TIME',
                                'labelidname' => 'res_bloodtimeid',
                                'required' => false,
                                'col' => 'col-md-3',
                            ])
                            <hr>
                            <div class="fs-5 fw-bold mb-3"><span class="border-2 border-bottom border-dark">Send The
                                    Patient To Theatre Date & Time</span> :
                            </div>
                            @include('helper.formhelper.form', [
                                'type' => 'date',
                                'fieldname' => 'patientsent_date',
                                'labelname' => 'SEND DATE',
                                'labelidname' => 'patientsent_dateid',
                                'required' => true,
                                'col' => 'col-md-3',
                            ]) @include('helper.formhelper.form', [
                                'type' => 'time',
                                'fieldname' => 'patientsent_time',
                                'labelname' => 'SEND TIME',
                                'labelidname' => 'patientsent_timeid',
                                'required' => true,
                                'col' => 'col-md-3',
                            ]) <div class="mb-3 row fs-5">
                                <label for="anaesthetistid" class="col-sm-3 col-form-label">Inform anesthetist
                                    Dr.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="anaesthetistid"
                                        wire:model="anaesthetist">
                                </div>
                                <label for="anaesthetistid" class="col-sm-6 col-form-label">and carry out his/her
                                    orders.</label>
                            </div>
                            <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded mb-3">Pre-Op Notes</div>
                            @include('helper.formhelper.form', [
                                'type' => 'textarea',
                                'fieldname' => 'preop_note',
                                'labelname' => 'PRE-OP NOTE',
                                'labelidname' => 'preop_noteid',
                                'required' => true,
                                'col' => 'col-md-12',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'textarea',
                                'fieldname' => 'preopadditional_note',
                                'labelname' => 'PRE-OP ADDITIONAL NOTE',
                                'labelidname' => 'preopadditional_noteid',
                                'required' => true,
                                'col' => 'col-md-12',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'textarea',
                                'fieldname' => 'preop_remarks',
                                'labelname' => 'PRE-OP REMARKS',
                                'labelidname' => 'preop_remarksid',
                                'required' => true,
                                'col' => 'col-md-12',
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
