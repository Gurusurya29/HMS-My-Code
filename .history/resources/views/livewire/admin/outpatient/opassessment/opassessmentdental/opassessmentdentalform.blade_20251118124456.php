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
                        'placeholder' => '',
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
                        'rows' => 2,
                        'col' => 'col-md-12',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- EXAMINATION STEP 2: TOOTH CHAT WITH CHECK BOX (DYNAMIC FIELD) <br>
    EXAMINATION STEP 3: SKIP --}}

    <nav class="navbar navbar-expand-lg navbar-dark theme_bg_color fw-bold">
        <div class="container">
            <a class="navbar-brand" href="#">Treatment Plan</a>
        </div>
    </nav>


    <div class="clearfix p-2 mr-2">


        <div class="form-check form-check-inline">
            <input wire:model="showpimaryteeth" class="form-check-input" type="checkbox" value=""
                id="pimary_teeth">
            <label class="form-check-label" for="pimary_teeth">
                Show primary teeth structure
            </label>
        </div>

        {{-- <div class="form-check form-check-inline">
            <input wire:model="selectalltooth" class="form-check-input" type="checkbox" value=""
                id="select_all_tooth">
            <label class="form-check-label" for="select_all_tooth">
                Select All Tooth
            </label>
        </div> --}}
    </div>

    {{-- TREATMENT PLAN - CHOOSE TEETH & SELECT PLAN --}}

    <div class="row p-2">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Upper Right(1)</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="btn-check" id="btn-check-18" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-18">18</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-17" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-17">17</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-16" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-16">16</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-15" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-15">15</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-14" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-14">14</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-13" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-13">13</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-12" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-12">12</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-11" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-11">11</label><br>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="btn-check" id="btn-check-48" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-48">48</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-47" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-47">47</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-46" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-46">46</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-45" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-45">45</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-44" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-44">44</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-43" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-43">43</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-42" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-42">42</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-41" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-41">41</label><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">Lower Right(4)</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Upper Left(2)</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="btn-check" id="btn-check-21" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-21">21</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-22" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-22">22</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-23" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-23">23</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-24" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-24">24</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-25" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-25">25</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-26" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-26">26</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-27" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-27">27</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-28" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-28">28</label><br>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="btn-check" id="btn-check-31" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-31">31</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-32" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-32">32</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-33" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-33">33</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-34" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-34">34</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-35" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-35">35</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-36" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-36">36</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-37" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-37">37</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-38" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-38">38</label><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">Lower Left(3)</h5>
                </div>
            </div>
        </div>
    </div>

    @if ($showpimaryteeth)
    <div class="row p-2">

        <div class="col-md-2">
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Upper Right(1)</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="btn-check" id="btn-check-1E"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-1E">1E</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-1D"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-1D">1D</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-1C"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-1C">1C</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-1B"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-1B">1B</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-1A"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-1A">1A</label><br>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="btn-check" id="btn-check-4E"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-4E">4E</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-4D"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-4D">4D</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-4C"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-4C">4C</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-4B"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-4B">4B</label><br>
                                </td>
                                <td><input type="checkbox" class="btn-check" id="btn-check-4A"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-4A">4A</label><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">Lower Right(4)</h5>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Upper Left(2)</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-2A"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-2A">2A</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-2B"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-2B">2B</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-2C"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-2C">2C</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-2D"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-2D">2D</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-2E"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-2E">2E</label><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-3A"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-3A">3A</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-3B"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-3B">3B</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-3C"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-3C">3C</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-3D"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-3D">3D</label><br>
                                </td>
                                <td>
                                    <input type="checkbox" class="btn-check" id="btn-check-3E"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn-check-3E">3E</label><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">Lower Left(3)</h5>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    @endif


    @include('livewire.admin.outpatient.opassessment.common.oppateintprescription')


    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold">
                    OBERSERVATION / NOTES
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

        // Get Livewire component id for a select element
        function findComponentId(el) {
            const comp = el.closest('[wire\\:id]');
            return comp ? comp.getAttribute('wire:id') : null;
        }

        // Initialize Select2 for an element and bind it to Livewire
        function initSelectElement(el, property) {
            const $el = $(el);

            // Destroy old instance to avoid duplicates
            if ($el.hasClass('select2-hidden-accessible')) {
                try {
                    $el.select2('destroy');
                } catch (e) {
                    /* ignore */
                }
            }

            // Initialize Select2
            $el.select2();

            // Bind change event -> update Livewire
            $el.off('change.select2').on('change.select2', function() {
                const compId = findComponentId(this);
                if (!compId) {
                    return console.warn('Livewire component id not found for', this);
                }
                Livewire.find(compId).set(property, $el.val());
            });
        }

        // Initialize all dropdowns
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
            ];

            selectMappings.forEach(mapping => {
                root.querySelectorAll(mapping.class).forEach(el => {
                    initSelectElement(el, mapping.property);
                });
            });
        }

        // First load
        initAllSelects();

        // Re-run after Livewire DOM changes
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


        });
    </script>
@endpush -->