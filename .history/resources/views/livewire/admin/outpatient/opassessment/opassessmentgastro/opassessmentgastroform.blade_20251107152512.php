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
document.addEventListener('livewire:init', () => {

    const initSelect2 = (selector, property) => {
        $(selector).each(function () {
            const $el = $(this);

            // find Livewire component id
            const comp = $el.closest('[wire\\:id]');
            const compId = comp.length ? comp.attr('wire:id') : null;
            if (!compId) return;

            // destroy any previous Select2 instance (avoid duplicates)
            if ($el.hasClass('select2-hidden-accessible')) {
                try { $el.select2('destroy'); } catch (e) { /* ignore */ }
            }

            // choose dropdownParent (works well for modals)
            const $modal = $el.closest('.modal');
            const dropdownParent = $modal.length ? $modal : $(document.body);

            // init Select2 with sensible defaults
            $el.select2({
                width: '100%',
                placeholder: $el.attr('placeholder') || 'Select an option',
                allowClear: true,
                dropdownParent: dropdownParent
            });

            // Preselect existing value(s) from Livewire (edit page)
            try {
                const lv = Livewire.find(compId).get(property);
                if (lv !== undefined && lv !== null) {
                    // ensure value format matches option values (array or single)
                    if (Array.isArray(lv)) {
                        $el.val(lv.map(String)).trigger('change.select2');
                    } else {
                        // single value - set as array for select2 multi OR single
                        $el.val(String(lv)).trigger('change.select2');
                    }
                }
            } catch (err) {
                // Livewire component might not be ready yet; ignore safely
                // console.warn('Livewire.get failed for', property, err);
            }

            // when user changes selection, update Livewire immediately without forcing full re-render
            $el.off('change.select2').on('change.select2', function () {
                const newVal = $el.val();
                Livewire.find(compId).set(property, newVal, false);
            });
        });
    };

    // list all selects you want initialized (add/remove as needed)
    const initAllSelects = () => {
        initSelect2('.currentcomplaint-dropdown', 'currentcomplaint');
        initSelect2('.physicalexam-dropdown', 'physicalexam');
        initSelect2('.diagnosismaster-dropdown', 'diagnosismaster');
        initSelect2('.labinvestigation-dropdown', 'labinvestigation');
        initSelect2('.scaninvestigation-dropdown', 'scaninvestigation');
        initSelect2('.xrayinvestigation-dropdown', 'xrayinvestigation');
        initSelect2('.allergy-dropdown', 'allergy');
        initSelect2('.currentcomplaints-dropdown', 'currentcomplaints');
    };

    // initial run
    initAllSelects();

    // re-run after Livewire morph updates (safe, efficient)
    Livewire.hook('morph.updated', ({ el }) => {
        requestAnimationFrame(() => {
            // if Livewire gives an element subtree, initialize inside it; otherwise re-init all
            if (el instanceof Element) {
                initAllSelects();
            } else {
                initAllSelects();
            }
        });
    });

});
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {

        /**
         * Get the Livewire component ID for a given element
         */
        function findComponentId(el) {
            const comp = el.closest('[wire\\:id]');
            return comp ? comp.getAttribute('wire:id') : null;
        }

        /**
         * Initialize a Select2 element and sync it with a Livewire property
         */
        function initSelectElement(el, property) {
            const $el = $(el);

            // Destroy existing Select2 instance to avoid duplicates
            if ($el.hasClass('select2-hidden-accessible')) {
                try {
                    $el.select2('destroy');
                } catch (e) {
                    console.warn('Select2 destroy failed:', e);
                }
            }

            // Initialize Select2
            $el.select2();

            // Bind change event to update Livewire
            $el.off('change.select2').on('change.select2', function() {
                const compId = findComponentId(this);
                if (!compId) {
                    console.warn('No Livewire component ID found for:', this);
                    return;
                }
                Livewire.find(compId).set(property, $el.val());
            });
        }

        /**
         * Initialize all Select2 dropdowns mapped to Livewire properties
         */
        function initAllSelects(root = document) {
            const selectMappings = [{
                    selector: '.currentcomplaint-dropdown',
                    property: 'currentcomplaint'
                },
                {
                    selector: '.physicalexam-dropdown',
                    property: 'physicalexam'
                },
                {
                    selector: '.diagnosismaster-dropdown',
                    property: 'diagnosismaster'
                },
                {
                    selector: '.labinvestigation-dropdown',
                    property: 'labinvestigation'
                },
                {
                    selector: '.scaninvestigation-dropdown',
                    property: 'scaninvestigation'
                },
                {
                    selector: '.xrayinvestigation-dropdown',
                    property: 'xrayinvestigation'
                },
            ];

            selectMappings.forEach(({
                selector,
                property
            }) => {
                root.querySelectorAll(selector).forEach(el => {
                    initSelectElement(el, property);
                });
            });
        }

        // Run once on page load
        initAllSelects();

        Livewire.hook('morph.updated', ({
            el
        }) => {
            requestAnimationFrame(() => {
                if (el instanceof Element) {
                    initAllSelects(el);
                } else {
                    initAllSelects();
                }
            });
        });
    });
</script> -->
@endpush
<!-- @push('scripts')
<script>
    $(document).ready(function() {

        // Generic Select2 initializer with Livewire binding
        function initSelect2(selector, property, eventName) {
            let $el = $(selector);

            // Destroy if already initialized to prevent duplicates
            if ($el.hasClass("select2-hidden-accessible")) {
                $el.select2('destroy');
            }

            // Initialize Select2
            $el.select2().on('change', function() {
                @this.set(property, $(this).val());
            });

            // Re-hydrate when Livewire triggers the event
            window.livewire.on(eventName, () => {
                initSelect2(selector, property, eventName);
            });
        }

        // Register all dropdowns here
        initSelect2('.currentcomplaint-dropdown', 'currentcomplaint', 'loadCurrentcomplaintsSelect2Hydrate');
        initSelect2('.physicalexam-dropdown', 'physicalexam', 'loadPhysicalexamSelect2Hydrate');
        initSelect2('.diagnosismaster-dropdown', 'diagnosismaster', 'loadDiagnosismasterSelect2Hydrate');
        initSelect2('.labinvestigation-dropdown', 'labinvestigation', 'loadLabinvestigationSelect2Hydrate');
        initSelect2('.scaninvestigation-dropdown', 'scaninvestigation', 'loadScaninvestigationSelect2Hydrate');
        initSelect2('.xrayinvestigation-dropdown', 'xrayinvestigation', 'loadXrayinvestigationSelect2Hydrate');
    });
</script>
@endpush -->
<!-- @push('scripts')
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