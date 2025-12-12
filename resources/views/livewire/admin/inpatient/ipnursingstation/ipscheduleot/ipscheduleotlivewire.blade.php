<div class="card-body bg-light">
    <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
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
                        <td>{{ $inpatient->patient->dob ?? '-' }}</td>
                        <td>{{ $inpatient->patient->aadharid ?? '-' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded">Schedule Surgery</div>
            <div class="bg-white row m-2">
                @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'surgery_name',
                    'labelname' => 'SURGERY NAME',
                    'labelidname' => 'surgery_nameid',
                    'required' => true,
                    'col' => 'col-md-3',
                ])
                <div class="col-md-3" wire:ignore>
                    <label for="doctor_id" class="form-label">SURGEON</label>
                    <span class="text-danger fw-bold">*</span>
                    <select wire:model.lazy="doctor_id" class="form-select" id="select2-dropdown">
                        <option value="">Select Surgeon</option>
                        @foreach ($doctorlist as $eachdoctor)
                            <option value="{{ $eachdoctor->id }}" {{ $eachdoctor->id == $doctor_id ? 'selected' : '' }}>
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
                    'col' => 'col-md-3',
                    'option' => $bedorroomnumber_data,
                ])
                @include('helper.formhelper.form', [
                    'type' => 'toggle',
                    'fieldname' => 'is_otactive',
                    'labelname' => 'IS OT ACTIVE',
                    'labelidname' => 'is_otactive',
                    'required' => false,
                    'col' => 'col-md-3',
                ])
                @if ($bedorroomnumber_id)
                    <hr>
                    <div class="fs-5 fw-bold mb-3"><span class="border-2 border-bottom border-dark">Surgery Date &
                            Time(Tentative Date & Time)</span> :
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="surgery_startdateid" class="form-label">START DATE & TIME</label>

                        <span class="text-danger fw-bold">*</span>
                        <input wire:model.lazy="surgery_startdate" type="datetime-local" class="form-control"
                            id="surgery_startdateid" wire:change="surgerydatevaildate('startdate')">
                        @error('surgery_startdate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="surgery_enddateid" class="form-label">END DATE & TIME</label>

                        <span class="text-danger fw-bold">*</span>
                        <input wire:model.lazy="surgery_enddate" type="datetime-local" min="{{ $surgery_startdate }}"
                            class="form-control" id="surgery_enddateid" wire:change="surgerydatevaildate('enddate')"
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
    </script>
@endpush
