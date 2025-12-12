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
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {

        /**
         * Find the Livewire component ID for an element
         */
        function findComponentId(el) {
            const comp = el.closest('[wire\\:id]');
            return comp ? comp.getAttribute('wire:id') : null;
        }

        /**
         * Initialize a Select2 element and bind it to Livewire
         */
        function initSelectElement(el, property) {
            const $el = $(el);

            // Destroy any existing Select2 instance
            if ($el.hasClass('select2-hidden-accessible')) {
                try {
                    $el.select2('destroy');
                } catch (e) {
                    /* ignore error */
                }
            }

            // Initialize Select2
            $el.select2();

            // Bind change event to update Livewire property
            $el.off('change.select2').on('change.select2', function() {
                const compId = findComponentId(this);
                if (!compId) {
                    return console.warn('Livewire component ID not found for select:', this);
                }
                Livewire.find(compId).set(property, $el.val());
            });
        }

        /**
         * Initialize all mapped Select2 dropdowns
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

        // Initial load
        initAllSelects();

        // Re-initialize after Livewire DOM updates
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
    $(document).ready(function () {

        /**
         * Initialize a Select2 dropdown and bind it to a Livewire property
         */
        function initSelect2(selector, property) {
            let $el = $(selector);

            // Destroy old instance if exists
            if ($el.hasClass("select2-hidden-accessible")) {
                $el.select2("destroy");
            }

            // Init Select2
            $el.select2();

            // On change, update Livewire property
            $el.off("change").on("change", function () {
                @this.set(property, $(this).val());
            });
        }

        /**
         * Map of dropdown selectors -> Livewire property names
         */
        const mappings = {
            ".currentcomplaint-dropdown": "currentcomplaint",
            ".physicalexam-dropdown": "physicalexam",
            ".diagnosismaster-dropdown": "diagnosismaster",
            ".labinvestigation-dropdown": "labinvestigation",
            ".scaninvestigation-dropdown": "scaninvestigation",
            ".xrayinvestigation-dropdown": "xrayinvestigation",
        };

        /**
         * Initialize all Select2 dropdowns
         */
        function initAll() {
            Object.entries(mappings).forEach(([selector, property]) => {
                initSelect2(selector, property);
            });
        }

        // Run once on page load
        initAll();

        // Listen for Livewire refreshes
        Object.entries(mappings).forEach(([selector, property]) => {
            window.livewire.on(`load${property.charAt(0).toUpperCase() + property.slice(1)}Select2Hydrate`, () => {
                initSelect2(selector, property);
            });
        });

    });
</script>
@endpush -->