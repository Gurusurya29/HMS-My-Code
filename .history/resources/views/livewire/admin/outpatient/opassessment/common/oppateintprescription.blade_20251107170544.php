<div class="col-md-12">
    <div class="card">
        <div class="card-header theme_bg_color text-white fw-bold">
            R<sub class="fs-6">x</sub> - ADD PRESCRIPTION
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="dropdown">
                    <input type="text" class="form-control shadow-sm" placeholder="Search Drug..." wire:model.live.debounce.150ms="searchquery" />

                      <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                        <li class="ist-group-item d-flex justify-content-between align-items-center">
                            Searching...</li>
                    </ul>

                    @if (!empty($searchquery))
                        <ul class="dropdown-menu list-group w-100 p-0 bg-gray shadow-sm">
                            @if (!empty($pharmacyproduct))
                                @foreach ($pharmacyproduct as $i => $eachpharmacyproduct)
                                    <li wire:click="additem({{ $eachpharmacyproduct['id'] }})"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <h6> {{ $eachpharmacyproduct['name'] }} </h6>

                                        <h5>
                                            <span class=" badge bg-primary rounded-pill">SKU:
                                                {{ $eachpharmacyproduct['product_sku'] }}</span>
                                        </h5>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    No results!
                                    <span class="badge bg-primary rounded-pill">0</span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
                <table class="table table-bordered shadow-sm  text-center">
                    <thead class="fw-bold table-primary" style="font-size: 14px;">
                        <tr>
                            <th style="width: 25%;">DRUG</th>
                            <th style="width: 10%;">MORNING</th>
                            <th style="width: 10%;">AFTERNOON</th>
                            <th style="width: 10%;">EVENING</th>
                            <th style="width: 10%;">NIGHT</th>
                            <th style="width: 10%;">BF</th>
                            <th style="width: 10%;">AF</th>
                            <th style="width: 10%;">COUNT</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($prescriptionlist)
                            @foreach ($prescriptionlist as $key => $eachprescriptionlist)
                                <tr>
                                    <td>
                                        <span class="timesfont fw-bold">
                                            {{ $eachprescriptionlist['drug_name'] }}</span>
                                    </td>
                                    <th>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model="prescriptionlist.{{ $key }}.morning">
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model="prescriptionlist.{{ $key }}.afternoon">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model="prescriptionlist.{{ $key }}.evening">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model="prescriptionlist.{{ $key }}.night">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model="prescriptionlist.{{ $key }}.before_food">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model="prescriptionlist.{{ $key }}.after_food">
                                        </div>
                                    </td>
                                    <td style="width:90px;">
                                        <input type="text" class="form-control form-control-sm"
                                            wire:model="prescriptionlist.{{ $key }}.count">
                                        @error('prescriptionlist.' . $key . '.count')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <button wire:click.prevent="removeitem({{ $key }})"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i> </button>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">No prescription added</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @include('helper.formhelper.form', [
                    'type' => 'toggle',
                    'fieldname' => 'is_prescriptionemergency',
                    'labelname' => 'IS EMERGENCY',
                    'labelidname' => 'is_prescriptionemergencyid',
                    'required' => false,
                    'col' => 'col-md-2',
                ])
                @include('helper.formhelper.form', [
                    'type' => 'file',
                    'fieldname' => 'prescription_file',
                    'labelname' => 'PRESCRIPTION FILE',
                    'labelidname' => 'prescription_fileid',
                    'required' => false,
                    'col' => 'col-md-4',
                    'is_uploaded' => $tempprescription_file ? true : false,
                ])
                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'prescription_note',
                    'labelname' => '',
                    'placeholder' => 'PRESCRIPTION NOTE',
                    'labelidname' => 'prescription_noteid',
                    'required' => false,
                    'col' => 'col-md-6',
                ])

            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('livewire:init', () => {

    /**
     * Wait for options to be loaded before initializing Select2
     */
    const waitForOptionsAndInit = ($el, initFn, tries = 0) => {
        if ($el.find('option').length > 0 || tries > 10) {
            initFn();
            return;
        }
        setTimeout(() => waitForOptionsAndInit($el, initFn, tries + 1), 80);
    };

    /**
     * Initialize a single Select2 element
     */
    const initSelect2Element = (el, property) => {
        const $el = $(el);

        // Avoid duplicate initialization
        if ($el.data('select2-initialized')) return;
        $el.data('select2-initialized', true);

        // Find Livewire component ID
        const $comp = $el.closest('[wire\\:id]');
        const compId = $comp.length ? $comp.attr('wire:id') : null;
        if (!compId) {
            console.warn('Select2 initialization failed: No Livewire component found', el);
            return;
        }

        // Safely destroy any existing Select2 instance
        try {
            if ($el.data('select2')) $el.select2('destroy');
        } catch (e) {
            console.warn('Select2 destroy failed:', e);
        }

        // Ensure dropdown renders properly (even inside modals)
        const $modal = $el.closest('.modal');
        const dropdownParent = $modal.length ? $modal : $(document.body);

        // Initialize Select2
        $el.select2({
            width: '100%',
            placeholder: $el.attr('placeholder') || 'Select an option',
            allowClear: true,
            dropdownParent: dropdownParent
        });

        // Set current value from Livewire property
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

        // Sync changes from Select2 → Livewire
        $el.off('change.select2sync').on('change.select2sync', function() {
            Livewire.find(compId).set(property, $el.val(), false);
        });
    };

    /**
     * List of Select2 mappings (dropdown selector → Livewire property)
     */
    const selectMappings = [
        { selector: '.currentcomplaint-dropdown', property: 'currentcomplaint' },
        { selector: '.allergy-dropdown', property: 'allergy' },
        { selector: '.physicalexam-dropdown', property: 'physicalexam' },
        { selector: '.diagnosismaster-dropdown', property: 'diagnosismaster' },
        { selector: '.labinvestigation-dropdown', property: 'labinvestigation' },
        { selector: '.scaninvestigation-dropdown', property: 'scaninvestigation' },
        { selector: '.xrayinvestigation-dropdown', property: 'xrayinvestigation' },
    ];

    /**
     * Initialize all Select2 dropdowns in a given DOM scope
     */
    const initAllSelect2 = (root = document) => {
        selectMappings.forEach(({ selector, property }) => {
            $(root).find(selector).each(function() {
                const $el = $(this);
                waitForOptionsAndInit($el, () => initSelect2Element($el, property));
            });
        });
    };

    // Run once on initial load
    initAllSelect2();

    // Re-run after Livewire DOM updates (morphing)
    Livewire.hook('morph.updated', ({ el }) => {
        requestAnimationFrame(() => {
            if (el instanceof Element) initAllSelect2(el);
            else initAllSelect2();
        });
    });

    // Manual helper for debugging
    window.reinitSelect2 = () => initAllSelect2();
});
</script>