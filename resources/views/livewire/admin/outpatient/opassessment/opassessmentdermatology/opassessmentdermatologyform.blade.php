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

        // --- Select2 Initialization Logic ---
        const initSelect2Single = (el, property) => {
            const $el = $(el);

            // 1. Find Livewire Component ID
            const $comp = $el.closest('[wire\\:id]');
            const compId = $comp.length ? $comp.attr('wire:id') : null;
            if (!compId) {
                console.warn('Select2 init: no Livewire component found for', el);
                return;
            }

            // 2. Destroy Existing Select2 Instance (Crucial for Livewire)
            // This prevents duplicate event listeners and UI corruption.
            if ($el.data('select2')) {
                $el.select2('destroy');
                $el.removeData('select2-initialized');
            }

            // Avoid double init during a single morph cycle
            if ($el.data('select2-initialized')) return;
            $el.data('select2-initialized', true);


            // 3. Choose Dropdown Parent (Fixes modal/scroll clipping)
            const $modal = $el.closest('.modal');
            const dropdownParent = $modal.length ? $modal : $(document.body);

            // 4. Init Select2
            $el.select2({
                width: '100%',
                placeholder: $el.attr('placeholder') || 'Select an option',
                allowClear: true,
                dropdownParent: dropdownParent
            });

            // 5. Sync Select2 change to Livewire property
            $el.off('change.select2.select2sync').on('change.select2.select2sync', function() {
                // Use a proper property check for single/multi-select
                const value = $el.val();
                Livewire.find(compId).set(property, value, false);
            });

            // 6. Preselect Value from Livewire (optional: but ensures initial state is correct)
            try {
                // The issue where options are injected later is handled by placing the
                // `initAll` call *after* the morph has completed.
                const livewireValue = Livewire.find(compId).get(property);
                if (livewireValue !== undefined && livewireValue !== null) {
                    // Normalize value to an array or string as needed by Select2
                    const normalizedValue = Array.isArray(livewireValue) ? livewireValue.map(String) : String(livewireValue);
                    $el.val(normalizedValue).trigger('change.select2');
                }
            } catch (err) {
                console.warn('Select2 preselect error for', property, err);
            }
        };


        // --- Mapping List (Keep as is) ---
        const selectMappings = [{
                selector: '.currentcomplaint-dropdown',
                property: 'currentcomplaint'
            },
            {
                selector: '.allergy-dropdown',
                property: 'allergy'
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
            }
        ];

        // --- Initialization Loop ---
        const initAll = (root = document) => {
            selectMappings.forEach(({
                selector,
                property
            }) => {
                // Find elements under the root (document for initial, element for morph)
                $(root).find(selector).each(function() {
                    initSelect2Single(this, property);
                });
            });
        };

        // --- Livewire Hooks ---

        // 1. Initial Run (on page load)
        initAll();

        // 2. Re-run after Livewire updates the DOM
        // This is the most crucial part for dynamic components.
        // The `morph.updated` hook triggers after the DOM has been updated, 
        // ensuring the new <option> elements are present.
        Livewire.hook('morph.updated', ({
            el
        }) => {
            // Use requestAnimationFrame for a slight delay, ensuring the browser is ready
            requestAnimationFrame(() => {
                if (el instanceof Element) initAll(el);
                else initAll();
            });
        });

        // 3. (Optional) Cleanup hook when a component is removed
        Livewire.hook('element.removed', ({
            el
        }) => {
            $(el).find('select').each(function() {
                if ($(this).data('select2')) {
                    $(this).select2('destroy');
                }
            });
        });

    });
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {

        // Find Livewire component id
        function findComponentId(el) {
            const comp = el.closest('[wire\\:id]');
            return comp ? comp.getAttribute('wire:id') : null;
        }

        // Initialize Select2 for a dropdown and bind to Livewire
        function initSelectElement(el, property) {
            const $el = $(el);

            // Destroy previous instance (avoid duplicates)
            if ($el.hasClass('select2-hidden-accessible')) {
                try {
                    $el.select2('destroy');
                } catch (e) {
                    /* ignore */
                }
            }

            // Initialize Select2
            $el.select2();

            // Sync with Livewire
            $el.off('change.select2').on('change.select2', function() {
                const compId = findComponentId(this);
                if (!compId) {
                    return console.warn('Livewire component id not found for', this);
                }
                Livewire.find(compId).set(property, $el.val());
            });
        }

        // Map all dropdowns
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
                root.querySelectorAll(mapping.class).forEach(el => {
                    initSelectElement(el, mapping.property);
                });
            });
        }

        // Initial load
        initAllSelects();

        // Re-initialize after Livewire updates
        Livewire.on('refreshSelect2Options', ({
            className,
            data
        }) => {
            const $el = $('.' + className);
            if (!$el.length) return;

            $el.empty();
            data.forEach(item => {
                const selected = item.selected ? 'selected' : '';
                $el.append(`<option value="${item.id}" ${selected}>${item.text}</option>`);
            });
            $el.trigger('change');
        });
    });
</script> -->
@endpush
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