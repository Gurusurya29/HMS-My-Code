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
                                <option value="{{ $eachcurrentcomplaint->id }}" @if(collect($currentcomplaint)->contains($eachcurrentcomplaint->id)) selected @endif>
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
<!-- <script>
    document.addEventListener('livewire:init', () => {

        const waitForOptionsAndInit = ($el, initFn, tries = 0) => {
            // if options already present, init immediately
            if ($el.find('option').length > 0 || tries > 10) {
                initFn();
                return;
            }
            // otherwise retry shortly (for cases where options are injected later)
            setTimeout(() => waitForOptionsAndInit($el, initFn, tries + 1), 80);
        };

        const initSelect2Single = (el, property) => {
            const $el = $(el);

            // avoid double init
            if ($el.data('select2-initialized')) return;
            $el.data('select2-initialized', true);

            // find Livewire component id
            const $comp = $el.closest('[wire\\:id]');
            const compId = $comp.length ? $comp.attr('wire:id') : null;
            if (!compId) {
                console.warn('Select2 init: no Livewire component for', el);
                return;
            }

            // safe destroy if weird state
            try {
                if ($el.data('select2')) $el.select2('destroy');
            } catch (e) {}

            // choose dropdownParent (fixes modal clipping)
            const $modal = $el.closest('.modal');
            const dropdownParent = $modal.length ? $modal : $(document.body);

            // init Select2
            $el.select2({
                width: '100%',
                placeholder: $el.attr('placeholder') || 'Select an option',
                allowClear: true,
                dropdownParent: dropdownParent
            });

            // preselect from Livewire (handle array / single / string)
            try {
                const currentVal = Livewire.find(compId).get(property);
                if (currentVal !== undefined && currentVal !== null) {
                    if (Array.isArray(currentVal)) {
                        $el.val(currentVal.map(v => String(v))).trigger('change.select2');
                    } else {
                        $el.val(String(currentVal)).trigger('change.select2');
                    }
                }
            } catch (err) {
                console.warn('Select2 preselect error for', property, err);
            }

            // sync back to Livewire on change
            $el.off('change.select2.select2sync').on('change.select2.select2sync', function() {
                Livewire.find(compId).set(property, $el.val(), false);
            });
        };

        // mapping list - keep this as your single source of truth
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

        // initialize all that exist now (or will soon)
        const initAll = (root = document) => {
            selectMappings.forEach(({
                selector,
                property
            }) => {
                // find elements under root (root may be subtree after morph)
                $(root).find(selector).each(function() {
                    const $el = $(this);
                    // wait for options if they might be populated later
                    waitForOptionsAndInit($el, () => initSelect2Single($el, property));
                });
            });
        };

        // initial run
        initAll();

        // re-run after Livewire morph updates. Use the subtree for efficiency.
        Livewire.hook('morph.updated', ({
            el
        }) => {
            requestAnimationFrame(() => {
                if (el instanceof Element) initAll(el);
                else initAll();
            });
        });

        // optional: helpful debug command in console to re-init manually
        window.debugReinitSelect2 = () => initAll();

    });
</script> -->
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