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
                @if ($dsgynecologydata?->doctor_id)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded mb-3">Summary About Mother</div>

                    <div class="col-md-12">
                        <label for="principaldiagnosisid" class="form-label">PRINCIPAL DIAGNOSIS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="principaldiagnosis" class="form-control ckeditor" data-name="principaldiagnosis"
                                id="principaldiagnosisid"></textarea>
                        </div>
                        @error('principaldiagnosis')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="riskfactorid" class="form-label">RISK FACTOR</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="riskfactor" class="form-control ckeditor" data-name="riskfactor" id="riskfactorid"></textarea>
                        </div>
                        @error('riskfactor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="cheifcomplaintid" class="form-label">CHIEF COMPLAINT</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="cheifcomplaint" class="form-control ckeditor" data-name="cheifcomplaint"
                                id="cheifcomplaintid"></textarea>
                        </div>
                        @error('cheifcomplaint')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="historyofpresentillnessid" class="form-label">HISTORY OF PRESENT ILLNESS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="historyofpresentillness" class="form-control ckeditor" data-name="historyofpresentillness"
                                id="historyofpresentillnessid"></textarea>
                        </div>
                        @error('historyofpresentillness')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="historyofpastillnessid" class="form-label">HISTORY OF PAST ILLNESS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="historyofpastillness" class="form-control ckeditor" data-name="historyofpastillness"
                                id="historyofpastillnessid"></textarea>
                        </div>
                        @error('historyofpastillness')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="othersid" class="form-label">OTHERS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="others" class="form-control ckeditor" data-name="others" id="othersid"></textarea>
                        </div>
                        @error('others')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="physicalexaminationid" class="form-label">PHYSICAL EXAMINATION</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="physicalexamination" class="form-control ckeditor" data-name="physicalexamination"
                                id="physicalexaminationid"></textarea>
                        </div>
                        @error('physicalexamination')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="hospitalizationcourseid" class="form-label">HOSPITALIZATION COURSE</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="hospitalizationcourse" class="form-control ckeditor" data-name="hospitalizationcourse"
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
                    <div class="col-md-12">
                        <label for="progressid" class="form-label">PROGRESS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="progress" class="form-control ckeditor" data-name="progress" id="progressid"></textarea>
                        </div>
                        @error('progress')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="natureofdeliveryid" class="form-label">NATURE OF DELIVERY</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="natureofdelivery" class="form-control ckeditor" data-name="natureofdelivery"
                                id="natureofdeliveryid"></textarea>
                        </div>
                        @error('natureofdelivery')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="pihid" class="form-label">PIH</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="pih" class="form-control ckeditor" data-name="pih" id="pihid"></textarea>
                        </div>
                        @error('pih')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="postnatalperiodid" class="form-label">POST-NATAL PERIOD</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="postnatalperiod" class="form-control ckeditor" data-name="postnatalperiod"
                                id="postnatalperiodid"></textarea>
                        </div>
                        @error('postnatalperiod')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="medicinesgivenid" class="form-label">MEDICINES GIVEN</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="medicinesgiven" class="form-control ckeditor" data-name="medicinesgiven"
                                id="medicinesgivenid"></textarea>
                        </div>
                        @error('medicinesgiven')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded mb-3">Summary About Your Son /
                        Daughter
                    </div>

                    <div class="col-md-12 card border-0">
                        <div class="card-body">
                            <table class="table table-striped">
                                @if ($babydetail)
                                    <thead>
                                        <tr>
                                            <th>GENDER</th>
                                            <th>WEIGHT</th>
                                            <th>APGAR</th>
                                            <th>BIRTH DATE & TIME</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($babydetail as $key => $eachbabydetail)
                                            <tr>
                                                <th>
                                                    <input type="text"
                                                        wire:model="babydetail.{{ $key }}.gender"
                                                        class="form-control">
                                                    @error('babydetail.' . $key . '.gender')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </th>
                                                <th>
                                                    <input type="text"
                                                        wire:model="babydetail.{{ $key }}.weight"
                                                        class="form-control">
                                                    @error('babydetail.' . $key . '.weight')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </th>
                                                <th>
                                                    <input type="text"
                                                        wire:model="babydetail.{{ $key }}.apgar"
                                                        class="form-control">
                                                    @error('babydetail.' . $key . '.apgar')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </th>
                                                <th>
                                                    <input type="datetime-local"
                                                        wire:model="babydetail.{{ $key }}.dateandtime"
                                                        class="form-control">
                                                    @error('babydetail.' . $key . '.dateandtime')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </th>

                                                <th>
                                                    @if ($loop->last)
                                                        <button type="button" wire:click.prevent="addbabydetail"
                                                            class="table-add_line btn btn-sm btn-success mx-1"><i
                                                                class="bi bi-plus-lg"></i></button>
                                                    @endif
                                                    @if (sizeof($babydetail) > 1)
                                                        <button type="button"
                                                            wire:click.prevent="removelineitem({{ $key }}, 'babydetail')"
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
                        <label for="babyfull_detailid" class="form-label">BABY DETAILS</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="babyfull_detail" class="form-control ckeditor" rows="15" data-name="babyfull_detail"
                                id="babyfull_detailid"></textarea>
                        </div>
                        @error('babyfull_detail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    @include('livewire.admin.inpatient.inpatientdischarge.common.dsprescription')

                    <div class="col-md-12">
                        <label for="specialinstructionidid" class="form-label">SPECIAL INSTRUCTION TO PATIENT</label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="specialinstruction" class="form-control ckeditor" data-name="specialinstruction"
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
