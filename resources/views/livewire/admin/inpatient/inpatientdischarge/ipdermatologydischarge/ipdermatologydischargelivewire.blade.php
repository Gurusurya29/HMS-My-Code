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
                @if ($dsdermatologydata?->doctor_id)
                    <hr>
                    <div class="col-md-12">
                        <label for="principaldiagnosisid" class="form-label">PRINCIPAL DIAGNOSIS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="principaldiagnosis" data-name="principaldiagnosis" class="form-control ckeditor"
                                id="principaldiagnosisid"></textarea>
                        </div>
                        @error('principaldiagnosis')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="riskfactorid" class="form-label">RISK FACTOR</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="riskfactor" data-name="riskfactor" class="form-control ckeditor" id="riskfactorid"></textarea>
                        </div>
                        @error('riskfactor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="cheifcomplaintid" class="form-label">CHIEF COMPLAINT</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="cheifcomplaint" data-name="cheifcomplaint" class="form-control ckeditor"
                                id="cheifcomplaintid"></textarea>
                        </div>
                        @error('cheifcomplaint')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="historyofpresentillnessid" class="form-label">HISTORY OF PRESENT ILLNESS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="historyofpresentillness" data-name="historyofpresentillness" class="form-control ckeditor"
                                id="historyofpresentillnessid"></textarea>
                        </div>
                        @error('historyofpresentillness')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="historyofpastillnessid" class="form-label">HISTORY OF PAST ILLNESS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="historyofpastillness" data-name="historyofpastillness" class="form-control ckeditor"
                                id="historyofpastillnessid"></textarea>
                        </div>
                        @error('historyofpastillness')
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
                    <div class="col-md-12">
                        <label for="physicalexaminationid" class="form-label">PHYSICAL EXAMINATION</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="physicalexamination" data-name="physicalexamination" class="form-control ckeditor"
                                id="physicalexaminationid"></textarea>
                        </div>
                        @error('physicalexamination')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="hospitalizationcourseid" class="form-label">HOSPITALIZATION COURSE</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="hospitalizationcourse" data-name="hospitalizationcourse" class="form-control ckeditor"
                                id="hospitalizationcourseid"></textarea>
                        </div>
                        @error('hospitalizationcourse')
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

                    <div class="col-md-12">
                        <label for="specialinstructionid" class="form-label">SPECIAL INSTRUCTION TO PATIENT</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="specialinstruction" data-name="specialinstruction" class="form-control ckeditor"
                                id="specialinstructionid"></textarea>
                        </div>
                        @error('specialinstruction')
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
