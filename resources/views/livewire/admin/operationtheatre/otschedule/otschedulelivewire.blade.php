<div class="card">
    <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5"> SURGERY DETAILS</span></div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('otschedulelist') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                @if (empty($otscheduledata))
                    <div class="my-3 col-md-8">
                        <div class="dropdown">
                            <label class="form-label fs-5" for="searchquery">Search Patient :</label>
                            <input type="text" class="form-control shadow-sm" placeholder="Search Patient..."
                                wire:model="searchquery"   wire:model.live.debounce.300ms="searchquery" />

                              <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                                <li class="ist-group-item d-flex justify-content-between align-items-center">
                                    Searching...</li>
                            </ul>

                            @if (!empty($searchquery))
                                <ul class="dropdown-menu list-group w-100 p-0">
                                    @if (!empty($inpatientlist))
                                        @foreach ($inpatientlist as $i => $eachinpatientlist)
                                            <li wire:click="selectedpatient({{ $eachinpatientlist->id }})"
                                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                                role="button">
                                                <h6> {{ $eachinpatientlist->patient->name }} </h6>

                                                <h5>
                                                    <span class=" badge bg-primary rounded-pill">
                                                        {{ $eachinpatientlist->patient->uhid }}</span>
                                                </h5>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            No results!
                                            <span class="badge bg-primary rounded-pill">0</span>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
                @if ($inpatient)
                    @if (empty($otscheduledata))
                        <div class="my-3 col-md-2 align-self-end">
                            <a href="{{ route('otscheduling') }}" class="btn btn-secondary">Clear</a>
                        </div>
                    @endif
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
                                    <td>{{ $inpatient->patient->uhid }}</td>
                                    <td>{{ $inpatient->patient->name }}</td>
                                    <td>{{ $inpatient->patient->phone }}</td>
                                    <td>{{ $inpatient->patient->dob ? date('d-m-Y', strtotime($inpatient->patient->dob)) : '-' }}
                                    </td>
                                    <td>{{ $inpatient->patient->aadharid ?? '-' }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded">Surgery Schedule</div>
                        <div class="bg-white row m-2">

                            @include('helper.formhelper.form', [
                                'type' => 'text',
                                'fieldname' => 'surgery_name',
                                'labelname' => 'SURGERY NAME',
                                'labelidname' => 'surgery_nameid',
                                'required' => true,
                                'col' => 'col-md-4',
                            ])
                            <div class="col-md-4" wire:ignore>
                                <label for="doctor_id" class="form-label">SURGEON</label>
                                <span class="text-danger fw-bold">*</span>
                                <select wire:model.lazy="doctor_id" class="form-select" id="select2-dropdown">
                                    <option value="">Select Surgeon</option>
                                    @foreach ($doctorlist as $eachdoctor)
                                        <option value="{{ $eachdoctor->id }}"
                                            {{ $eachdoctor->id == $doctor_id ? 'selected' : '' }}>
                                            {{ $eachdoctor->name }} ({{ $eachdoctor->uniqid }})</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @include('helper.formhelper.form', [
                                'type' => 'select',
                                'default_option' => 'Select OT',
                                'fieldname' => 'bedorroomnumber_id',
                                'labelname' => 'OPERATION THEATRE',
                                'labelidname' => 'bedorroomnumber_id',
                                'required' => true,
                                'col' => 'col-md-4',
                                'option' => $bedorroomnumber_data,
                            ])
                            @if ($bedorroomnumber_id)
                                <hr>
                                <div class="fs-5 fw-bold mb-3"><span class="border-2 border-bottom border-dark">Surgery
                                        Date
                                        &
                                        Time(Tentative Date & Time)</span> :
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="surgery_startdateid" class="form-label">START DATE & TIME</label>

                                    <span class="text-danger fw-bold">*</span>
                                    <input wire:model.lazy="surgery_startdate" type="datetime-local"
                                        class="form-control" id="surgery_startdateid"
                                        wire:change="surgerydatevaildate('startdate')">
                                    @error('surgery_startdate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="surgery_enddateid" class="form-label">END DATE & TIME</label>

                                    <span class="text-danger fw-bold">*</span>
                                    <input wire:model.lazy="surgery_enddate" type="datetime-local"
                                        min="{{ $surgery_startdate }}" class="form-control" id="surgery_enddateid"
                                        wire:change="surgerydatevaildate('enddate')"
                                        {{ $surgery_startdate ? '' : 'disabled' }}>
                                    @error('surgery_enddate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @include('helper.formhelper.form', [
                                    'type' => 'textarea',
                                    'fieldname' => 'schedule_note',
                                    'labelname' => 'SPECIAL NOTE FOR SURGERY',
                                    'labelidname' => 'schedule_noteid',
                                    'required' => true,
                                    'col' => 'col-md-5',
                                ])
                            @endif
                        </div>
                    </div>
                    @if ($otscheduledata)
                        <div class="col-md-12">
                            <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded">Surgery Details</div>
                            <div class="bg-white row m-2">
                                @include('helper.formhelper.form', [
                                    'type' => 'toggle',
                                    'fieldname' => 'is_movedto_ot',
                                    'labelname' => 'IS PATIENT MOVED TO OT',
                                    'labelidname' => 'is_movedto_ot',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'text',
                                    'fieldname' => 'chief_surgeon',
                                    'labelname' => 'CHIEF SURGEON',
                                    'labelidname' => 'chief_surgeonid',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'text',
                                    'fieldname' => 'senior_surgeon',
                                    'labelname' => 'SENIOR SURGEON',
                                    'labelidname' => 'senior_surgeonid',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'text',
                                    'fieldname' => 'asst_surgeon',
                                    'labelname' => 'ASSISTANT SURGEON',
                                    'labelidname' => 'asst_surgeonid',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'text',
                                    'fieldname' => 'nursing_asst',
                                    'labelname' => 'NURSING ASSISTANT',
                                    'labelidname' => 'nursing_asstid',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'text',
                                    'fieldname' => 'anaesthetist',
                                    'labelname' => 'ANAESTHETIST',
                                    'labelidname' => 'anaesthetistid',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'text',
                                    'fieldname' => 'others',
                                    'labelname' => 'OTHERS',
                                    'labelidname' => 'othersid',
                                    'required' => true,
                                    'col' => 'col-md-4',
                                ])
                                @include('helper.formhelper.form', [
                                    'type' => 'textarea',
                                    'fieldname' => 'surgery_details',
                                    'labelname' => 'SURGERY DETAILS',
                                    'labelidname' => 'surgery_detailsid',
                                    'required' => true,
                                    'col' => 'col-md-8',
                                ])


                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        @if ($inpatient)
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
@push('scripts')
    <script>
        $(function() {
            window.loaddoctorSelect2 = () => {
                $('#select2-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('doctor_id', data);
                });
            }
            loaddoctorSelect2();
            window.livewire.on('loaddoctorSelect2Hydrate', () => {
                loaddoctorSelect2();
            });
        });
    </script>
@endpush
