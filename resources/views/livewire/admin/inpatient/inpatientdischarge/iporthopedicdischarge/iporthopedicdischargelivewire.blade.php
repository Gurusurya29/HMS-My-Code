<div class="card">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">IP DISCHARGE SUMMARY</span></div>
            <div class="bd-highlight d-flex gap-1">
                <a href="{{ route('inpatientqueue') }}" class="btn btn-sm btn-secondary">Back</a>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="store" autocomplete="off" onkeydown="return event.key != 'Enter';">
        <div class="card-body">
            @include('livewire.admin.inpatient.inpatientdischarge.common.dspatientregistrationdetails')
            <div class="row g-3">
                <div class="col-md-4" wire:ignore:self>
                    <label for="doctor_id" class="form-label">DISCHARGE APPROVAL BY DOCTOR</label>
                    <span class="text-danger fw-bold">*</span>
                    <select wire:model.lazy="doctor_id" class="form-select" id="select2-dropdown">
                        <option value="">Select Doctor</option>
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
                    'type' => 'formswitch',
                    'fieldname' => 'is_billpaid',
                    'labelname' => 'IS BILL PAID',
                    'labelidname' => 'is_billpaidid',
                    'required' => true,
                    'col' => 'col-md-2',
                ])
                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'dischargeinitiate_note',
                    'labelname' => 'DISCHARGE INITIATE NOTE',
                    'labelidname' => 'dischargeinitiate_noteid',
                    'required' => true,
                    'rows' => 1,
                    'col' => 'col-md-6',
                ])

                @if ($dsorthopedicdata?->doctor_id)
                    <hr>
                    <div class="col-md-12">
                        <label for="primary_consultantsid" class="form-label">PRIMARY CONSULTANTS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="primary_consultants" data-name="primary_consultants" class="form-control ckeditor"
                                id="primary_consultantsid"></textarea>
                        </div>
                        @error('primary_consultants')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="consultantid" class="form-label">CONSULTANT</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="consultant" data-name="consultant" class="form-control ckeditor" id="consultantid"></textarea>
                        </div>
                        @error('consultant')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="diagnosisid" class="form-label">DIAGNOSIS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="diagnosis" data-name="diagnosis" class="form-control ckeditor" id="diagnosisid"></textarea>
                        </div>
                        @error('diagnosis')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="drug_allergyid" class="form-label">DRUG ALLERGY</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="drug_allergy" data-name="drug_allergy" class="form-control ckeditor" id="drug_allergyid"></textarea>
                        </div>
                        @error('drug_allergy')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="proceduresid" class="form-label">PROCEDURES</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="procedures" data-name="procedures" class="form-control ckeditor" id="proceduresid"></textarea>
                        </div>
                        @error('procedures')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="historyofpastillnessid" class="form-label">PAST HISTORY</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="historyofpastillness" data-name="historyofpastillness" class="form-control ckeditor"
                                id="historyofpastillnessid"></textarea>
                        </div>
                        @error('historyofpastillness')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="generalexaminationid" class="form-label">GENERAL EXAMINATION</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="generalexamination" data-name="generalexamination" class="form-control ckeditor"
                                id="generalexaminationid"></textarea>
                        </div>
                        @error('generalexamination')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="localexaminationid" class="form-label">LOCAL EXAMINATION</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="localexamination" data-name="localexamination" class="form-control ckeditor"
                                id="localexaminationid"></textarea>
                        </div>
                        @error('localexamination')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-12">
                        <label for="investigationsid" class="form-label">INVESTIGATION</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="investigations" data-name="investigations" class="form-control ckeditor" rows="1"
                                id="historyofpastillnessid"></textarea>
                        </div>
                        @error('investigations')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="courseduringstayid" class="form-label">COURSE DURING STAY</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="courseduringstay" data-name="courseduringstay" class="form-control ckeditor"
                                id="courseduringstayid"></textarea>
                        </div>
                        @error('courseduringstay')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="operativesummaryid" class="form-label">OPERATIVE SUMMARY</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="operativesummary" data-name="operativesummary" class="form-control ckeditor"
                                id="operativesummaryid"></textarea>
                        </div>
                        @error('operativesummary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="conditionatdischargeid" class="form-label">CONDITION AT DISCHARGE</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="conditionatdischarge" data-name="conditionatdischarge" class="form-control ckeditor"
                                id="conditionatdischargeid"></textarea>
                        </div>
                        @error('conditionatdischarge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @include('livewire.admin.inpatient.inpatientdischarge.common.dsprescription')
                    <div class="col-md-12 card border-0">
                        <div class="card-title fs-5 fw-bold">PATIENT OWN DRUG</div>

                        <div class="card-body">
                            <table class="table table-bordered shadow-sm  text-center" style="width:100%;">
                                <thead class="fw-bold table-primary" style="font-size: 14px;">
                                    <tr>
                                        <th style="width: 20%;">DRUG</th>
                                        <th style="width: 10%;">DURATION</th>
                                        <th style="width: 10%;">MORNING</th>
                                        <th style="width: 10%;">AFTERNOON</th>
                                        <th style="width: 10%;">EVENING</th>
                                        <th style="width: 10%;">NIGHT</th>
                                        <th style="width: 10%;">BF</th>
                                        <th style="width: 10%;">AF</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                @if ($patientowndrug)
                                    <tbody>
                                        @foreach ($patientowndrug as $key => $eachpatientowndrug)
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        wire:model.lazy="patientowndrug.{{ $key }}.drug_name">
                                                    @error('patientowndrug.' . $key . '.drug_name')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        wire:model.lazy="patientowndrug.{{ $key }}.duration">
                                                    @error('patientowndrug.' . $key . '.duration')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <th>
                                                    <div
                                                        class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model.lazy="patientowndrug.{{ $key }}.morning">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div
                                                        class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model.lazy="patientowndrug.{{ $key }}.afternoon">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model.lazy="patientowndrug.{{ $key }}.evening">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model.lazy="patientowndrug.{{ $key }}.night">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model.lazy="patientowndrug.{{ $key }}.before_food">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model.lazy="patientowndrug.{{ $key }}.after_food">
                                                    </div>
                                                </td>
                                                <th>
                                                    @if ($loop->last)
                                                        <button type="button" wire:click.prevent="addpatientowndrug"
                                                            class="table-add_line btn btn-sm btn-success mx-1"><i
                                                                class="bi bi-plus-lg"></i></button>
                                                    @endif
                                                    @if (sizeof($patientowndrug) > 1)
                                                        <button type="button"
                                                            wire:click.prevent="removelineitem({{ $key }}, 'patientowndrug')"
                                                            class="table-remove-btn btn btn-sm btn-danger mx-1"><i
                                                                class="bi bi-trash-fill"></i></button>
                                                    @endif
                                                </th>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="physioadviceid" class="form-label">PHYSIO ADVICE</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="physioadvice" data-name="physioadvice" class="form-control ckeditor" id="physioadviceid"></textarea>
                        </div>
                        @error('physioadvice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="adviceondischargeid" class="form-label">ADVICE ON DISCHARGE TO PATIENT</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="adviceondischarge" data-name="adviceondischarge" class="form-control ckeditor"
                                id="adviceondischargeid"></textarea>
                        </div>
                        @error('adviceondischarge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="othersid" class="form-label">OTHERS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="others" data-name="others" class="form-control ckeditor" id="othersid"></textarea>
                        </div>
                        @error('others')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'date',
                        'fieldname' => 'discharge_date',
                        'labelname' => 'DISCHARGE DATE',
                        'labelidname' => 'discharge_dateid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'file',
                        'fieldname' => 'casesheet_file',
                        'labelname' => 'CASE SHEET FILE',
                        'labelidname' => 'casesheet_fileid',
                        'required' => false,
                        'col' => 'col-md-3',
                        'is_uploaded' => $tempcasesheet_file ? true : false,
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'written_by',
                        'labelname' => 'WRITTEN BY',
                        'labelidname' => 'written_byid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'checked_by',
                        'labelname' => 'CHECKED BY',
                        'labelidname' => 'checked_byid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('livewire.admin.inpatient.inpatientdischarge.common.dsfollowupvisit')
                    <div class="form-check col-md-12 mx-3">
                        <input wire:model.lazy="is_patientdischarged" class="form-check-input p-2" type="checkbox"
                            id="is_patientdischarged">
                        <label class="form-check-label mx-1" for="is_patientdischarged">
                            IS PATIENT DISCHARGED<span class="fs-5"> (<span class="text-danger">Note:</span> If
                                checked, the discharge
                                summary cannot be updated again.)</span>
                        </label>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="" class="btn btn-secondary">Cancel</a>
            @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                'method_name' => 'store',
                'model_id' => '',
            ])
        </div>
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


            // Ck Editor
            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                const name = allEditors[i].getAttribute("data-name");
                ClassicEditor.create(allEditors[i])
                    .then(editor => {
                        document.querySelector("#submit").addEventListener("click", () => {
                            @this.set(name, editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
@endpush
