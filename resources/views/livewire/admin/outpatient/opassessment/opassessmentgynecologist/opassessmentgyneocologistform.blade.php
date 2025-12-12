<form wire:submit.prevent="store" enctype="multipart/form-data" class="bg-white shadow mt-2" autocomplete="off"
    onkeydown="return event.key != 'Enter';">

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    CURRENT COMPLAINTS
                </div>
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-md-12">
                            <select wire:model="currentcomplaint" id="currentcomplaint"
                                class="form-select currentcomplaint-dropdown" multiple>
                                @foreach ($currentcomplaint_data as $eachcurrentcomplaint)
                                <option value="{{ $eachcurrentcomplaint->id }}">
                                    {{ $eachcurrentcomplaint->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('currentcomplaint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'currentcomplaint_note',
                        'labelname' => '',
                        'labelidname' => 'currentcomplaint_noteid',
                        'required' => false,
                        'col' => 'col-md-12',
                        'placeholder' => 'CHIEF COMPLAINTS WITH DURATION',
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    PHYSICAL & GENERAL EXAM
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <select wire:model="physicalexam" id="physicalexam"
                                class="form-select physicalexam-dropdown" multiple>
                                @foreach ($physicalexam_data as $eachphysicalexam)
                                <option value="{{ $eachphysicalexam->id }}">
                                    {{ $eachphysicalexam->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('physicalexam')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'physicalexam_note',
                        'labelname' => '',
                        'placeholder' => 'MORBIDITY',
                        'labelidname' => 'physicalexam_noteid',
                        'required' => false,
                        'col' => 'col-md-12',
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    DIAGNOSIS
                </div>
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-md-12">
                            <select wire:model="diagnosismaster" id="diagnosismaster"
                                class="form-select diagnosismaster-dropdown" multiple>
                                @foreach ($diagnosismaster_data as $eachdiagnosismaster)
                                <option value="{{ $eachdiagnosismaster->id }}">
                                    {{ $eachdiagnosismaster->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('diagnosismaster')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'diagnosis_note',
                        'labelname' => '',
                        'placeholder' => 'DIAGNOSIS NOTE',
                        'labelidname' => 'diagnosis_noteid',
                        'required' => false,
                        'rows' => 5,
                        'col' => 'col-md-12',
                        ])
                    </div>
                </div>
            </div>
        </div>



        @include('livewire.admin.outpatient.opassessment.common.oppatientlabinvestigation')
        @include('livewire.admin.outpatient.opassessment.common.oppatientscaninvestigation')
        @include('livewire.admin.outpatient.opassessment.common.oppatientxrayinvestigation')


        @include('livewire.admin.outpatient.opassessment.common.oppateintprescription')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    GENERAL EXAMINATION
                </div>
                <div class="card-body fs-5 text-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="checkbox"
                            wire:model="is_pallor" id="is_pallor" value="1">
                        <label class="form-check-label" for="is_pallor">Pallor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="checkbox"
                            wire:model="is_cyanosis" id="is_cyanosis" value="1">
                        <label class="form-check-label" for="is_cyanosis">Cyanosis</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="checkbox"
                            wire:model="is_icterus" id="is_icterus" value="1">
                        <label class="form-check-label" for="is_icterus">Icterus</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="checkbox"
                            wire:model="is_clubbing" id="is_clubbing" value="1">
                        <label class="form-check-label" for="is_clubbing">Clubbing</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="checkbox"
                            wire:model="is_pedaledema" id="is_pedaledema" value="1">
                        <label class="form-check-label" for="is_pedaledema">Pedaledema</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="checkbox"
                            wire:model="is_anasarca" id="is_anasarca" value="1">
                        <label class="form-check-label" for="is_anasarca">Anasarca</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    FUNCTIONAL ASSESMENT
                </div>
                <div class="card-body fs-5 text-center">
                    <label class="form-label">Ability to perform routine activities :</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="radio"
                            wire:model="functional_assesment" id="functional_assesment" value="1">
                        <label class="form-check-label" for="functional_assesment">YES</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-1 border-primary" type="radio"
                            wire:model="functional_assesment" id="functional_assesment" value="0">
                        <label class="form-check-label" for="functional_assesment">NO</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    ABDOMINAL EXAMINATION
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'abdominalexamination_note',
                    'labelname' => '',
                    'placeholder' => 'ABDOMINAL EXAMINATION',
                    'labelidname' => 'abdominalexamination_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    NERVOUS SYSTEM EXAMINATION
                </div>
                <div class="card-body">
                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'nervoussystemexamination_note',
                    'labelname' => '',
                    'placeholder' => 'NERVOUS SYSTEM EXAMINATION',
                    'labelidname' => 'nervoussystemexamination_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    PER RECTAL EXAMINATION
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'perrectalexamination_note',
                    'labelname' => '',
                    'placeholder' => 'PER RECTAL EXAMINATION',
                    'labelidname' => 'perrectalexamination_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    PER VAGINAL EXAMINATION
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'pervaginalexamination_note',
                    'labelname' => '',
                    'placeholder' => 'PER VAGINAL EXAMINATION',
                    'labelidname' => 'pervaginalexamination_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    ADD PAST HISTORY
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'pasthistory_note',
                    'labelname' => '',
                    'placeholder' => 'PAST HISTORY',
                    'labelidname' => 'pasthistory_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    ADD NUTRITIONAL SCREENING
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'nutritionalscreening_note',
                    'labelname' => '',
                    'placeholder' => 'NUTRITIONAL SCREENING',
                    'labelidname' => 'nutritionalscreening_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    PROVISIONAL DIAGNOSIS
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'provisionaldiagnosis_note',
                    'labelname' => '',
                    'placeholder' => 'PROVISIONAL DIAGNOSIS',
                    'labelidname' => 'provisionaldiagnosis_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    ADD PLAN OF CARE
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'planofcare_note',
                    'labelname' => '',
                    'placeholder' => 'PLAN OF CARE',
                    'labelidname' => 'planofcare_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    ADD SYSTEMIC EXAMINATION FINDING
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'systemicexamfinding_note',
                    'labelname' => '',
                    'placeholder' => 'SYSTEMIC EXAMINATION FINDING',
                    'labelidname' => 'systemicexamfinding_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    ADD DIET ADVICE
                </div>
                <div class="card-body">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'dietadvice_note',
                    'labelname' => '',
                    'placeholder' => 'DIET ADVICE',
                    'labelidname' => 'dietadvice_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    OTHERS
                </div>
                <div class="card-body row">
                    @include('helper.formhelper.form', [
                    'type' => 'date',
                    'fieldname' => 'nextvisit_date',
                    'labelname' => 'NEXT VISIT DATE',
                    'labelidname' => 'nextvisit_dateid',
                    'required' => false,
                    'col' => 'col-md-6',
                    ])
                    @if ($is_movetoip == false)
                    @include('helper.formhelper.form', [
                    'type' => 'toggle',
                    'fieldname' => 'movetoipconfirm',
                    'labelname' => 'MOVE TO IP',
                    'labelidname' => 'movetoipconfirmid',
                    'required' => false,
                    'col' => 'col-md-6',
                    ])
                    @else
                    <div class="col-md-6 mb-3">
                        <label class="form-label">MOVE TO IP</label>
                        <div class="text-success fs-5 fw-bold">Move to IP Confirmed</div>

                    </div>
                    @endif

                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    NOTE
                </div>
                <div class="card-body">
                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'doctor_note',
                    'labelname' => '',
                    'placeholder' => 'DOCTOR NOTE',
                    'labelidname' => 'doctor_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-light px-2 py-1">
        <a href="" class="btn btn-secondary">Cancel</a>
        @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
        'method_name' => 'store',
        'model_id' => '',
        ])
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Find Livewire component ID for an element
        function findComponentId(el) {
            const comp = el.closest('[wire\\:id]');
            return comp ? comp.getAttribute('wire:id') : null;
        }

        // Initialize a Select2 element and bind it to Livewire
        function initSelectElement(el, property) {
            const $el = $(el);

            // Destroy previous Select2 instance to prevent duplicates
            if ($el.hasClass('select2-hidden-accessible')) {
                try {
                    $el.select2('destroy');
                } catch (e) {
                    /* ignore destroy errors */
                }
            }

            // Initialize Select2
            $el.select2();

            // Bind change event to update Livewire property
            $el.off('change.select2').on('change.select2', function() {
                const compId = findComponentId(this);
                if (!compId) {
                    return console.warn('Livewire component id not found for select', this);
                }
                Livewire.find(compId).set(property, $el.val());
            });
        }

        // Initialize all required Select2 dropdowns
        function initAllSelects(root = document) {
            const selectMappings = [{
                    class: '.currentcomplaint-dropdown',
                    property: 'currentcomplaint'
                },
                {
                    class: '.physicalexam-dropdown',
                    property: 'physicalexam'
                },
                {
                    class: '.diagnosismaster-dropdown',
                    property: 'diagnosismaster'
                },
                {
                    class: '.labinvestigation-dropdown',
                    property: 'labinvestigation'
                },
                {
                    class: '.scaninvestigation-dropdown',
                    property: 'scaninvestigation'
                },
                {
                    class: '.xrayinvestigation-dropdown',
                    property: 'xrayinvestigation'
                },
            ];

            selectMappings.forEach(mapping => {
                root.querySelectorAll(mapping.class).forEach(el =>
                    initSelectElement(el, mapping.property)
                );
            });
        }

        // Initial load
        initAllSelects();

        // Re-initialize after Livewire DOM updates
        Livewire.hook('morph.updated', ({
            el
        }) => {
            setTimeout(() => {
                try {
                    if (el instanceof Element) {
                        initAllSelects(el);
                    } else {
                        initAllSelects();
                    }
                } catch (err) {
                    initAllSelects();
                }
            }, 0);
        });

    });
</script>
@endpush
<!-- 
@push('scripts')
    <script>
        $(document).ready(function() {
            // Current Complaint
            window.loadCurrentcomplaintsSelect2 = () => {
                $('.currentcomplaint-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('currentcomplaint', data);
                });
            }
            loadCurrentcomplaintsSelect2();
            window.livewire.on('loadCurrentcomplaintsSelect2Hydrate', () => {
                loadCurrentcomplaintsSelect2();
            });

            // Physical Exam
            window.loadPysicalexamSelect2 = () => {
                $('.physicalexam-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('physicalexam', data);
                });
            }
            loadPysicalexamSelect2();
            window.livewire.on('loadPhysicalexamSelect2Hydrate', () => {
                loadPysicalexamSelect2();
            });

            // Diagnosis Master
            window.loadDiagnosismasterSelect2 = () => {
                $('.diagnosismaster-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('diagnosismaster', data);
                });
            }
            loadDiagnosismasterSelect2();
            window.livewire.on('loadDiagnosismasterSelect2Hydrate', () => {
                loadDiagnosismasterSelect2();
            });

            // Lab Investigation
            window.loadLabinvestigationSelect2 = () => {
                $('.labinvestigation-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('labinvestigation', data);
                });
            }
            loadLabinvestigationSelect2();
            window.livewire.on('loadLabinvestigationSelect2Hydrate', () => {
                loadLabinvestigationSelect2();
            });

            // Scan Investigation
            window.loadScaninvestigationSelect2 = () => {
                $('.scaninvestigation-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('scaninvestigation', data);
                });
            }
            loadScaninvestigationSelect2();
            window.livewire.on('loadScaninvestigationSelect2Hydrate', () => {
                loadScaninvestigationSelect2();
            });

            // Xray Investigation
            window.loadXrayinvestigationSelect2 = () => {
                $('.xrayinvestigation-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('xrayinvestigation', data);
                });
            }
            loadXrayinvestigationSelect2();
            window.livewire.on('loadXrayinvestigationSelect2Hydrate', () => {
                loadXrayinvestigationSelect2();
            });

        });
    </script>
@endpush -->