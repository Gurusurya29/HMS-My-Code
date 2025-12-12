<div>
    {{-- @livewire('admin.patientregistration.patientregistration.patientregistrationlivewire')--}}
    <div class="row g-2 mt-1 col-md-10 mx-auto">
        <div class="col-md-8">
            <input wire:model.debounce.150ms="patient_selected" wire:focus="searchpatientfoucs"
                wire:change="searchpatient" wire:keyup="searchpatient" type="text"
                class="form-control form-control-md bg-white shadow-sm" autofocus
                placeholder="Search Patient Name / Phone / UHID / Patient ID / Aadhar">
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary shadow-sm mx-1" data-bs-toggle="modal"
                data-bs-target="#createoreditModal">
                Add New Patient
            </button>
            @if ($patient_uhid)
            <button wire:click="formreset" type="submit" class="btn btn-secondary shadow-sm">Clear</button>
            @endif
        </div>
    </div>
    @if (!empty($patient_selected))
    <div class="col-md-10 mx-auto bg-light">
        <ul class="dropdown-menu list-group w-75 text-center border-0 py-0">
            @if (!empty($searchpatientlist))
            @foreach ($searchpatientlist as $i => $eachsearchpatientlist)
            <li wire:click="selectpatient('{{ $eachsearchpatientlist->id }}')"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center shadow-sm bg-light fw-bold"
                role="button">
                <h5>
                    <span class="text-danger">{{ $eachsearchpatientlist->uhid }}</span> /
                    <span class="text-dark"> Name : {{ $eachsearchpatientlist->name }} </span>
                </h5>

                <h5>
                    <span class=" badge bg-primary rounded-pill">Ph:
                        {{ $eachsearchpatientlist->phone }}</span>

                    @if ($eachsearchpatientlist->aadharid)
                    <span class="badge bg-success rounded-pill">Aadhar:
                        {{ $eachsearchpatientlist->aadharid }}</span>
                    @elseif($eachsearchpatientlist->dob)
                    <span class="badge bg-success rounded-pill">DOB:
                        {{ \Carbon\Carbon::parse($eachsearchpatientlist->dob)->format('d-m-Y') }}</span>
                    @elseif($eachsearchpatientlist->email)
                    <span class="badge bg-success rounded-pill">Email:
                        {{ $eachsearchpatientlist->email }}</span>
                    @endif
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
    </div>
    @endif
    @if ($patient_uhid)
    <form wire:submit.prevent="store" autocomplete="off">
        <div class="card mt-3 shadow-sm border-0">

            <div class="table-responsive shadow-lg mb-2">
                <table class="table table-bordered table-success p-0 m-0 text-center">
                    <thead class="georgiafont">
                        <tr>
                            <th>UHID</th>
                            <th>NAME</th>
                            <th>PHONE</th>
                            <th>DOB</th>
                            <th>EMAIL</th>
                            <th>AADHAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ $patient_uhid }}</th>
                            <td>{{ $name }}</td>
                            <td>{{ $phone }}</td>
                            <td>{{ $dob }}</td>
                            <td>{{ $email }}</td>
                            <td>{{ $aadharid }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class=" card-header theme_bg_color text-white fw-bold">
                SELECT DOCTOR
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Doctor',
                    'fieldname' => 'doctor_id',
                    'labelname' => 'DOCTOR',
                    'labelidname' => 'doctor_idid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $doctor_data,
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Specialty',
                    'fieldname' => 'doctorspecialization_id',
                    'labelname' => 'SPECIALTY FOR ASSESSMENT',
                    'labelidname' => 'doctorspecializationid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $doctorspecialization_data,
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Visit Type',
                    'fieldname' => 'patient_visittype',
                    'labelname' => 'VISIT TYPE',
                    'labelidname' => 'patient_visittypeid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => config('archive.patient_visittype'),
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Visit Category',
                    'fieldname' => 'visit_category_id',
                    'labelname' => 'VISIT CATEGORY',
                    'labelidname' => 'visit_category_id',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => config('archive.visit_category'),
                    ])

                    @if ($visit_category_id == 2)
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Ward Type',
                    'fieldname' => 'wardtype_id',
                    'labelname' => 'WARD TYPE',
                    'labelidname' => 'wardtype_id',
                    'required' => false,
                    'col' => 'col-md-4',
                    'option' => $wardtype_data,
                    ])
                    @endif
                </div>
            </div>

            <div class="card-header theme_bg_color text-white fw-bold">
                CURRENT COMPLAINTS
            </div>
            <div class="card-body">
                <div class="row g-3 mt-1">
                    <select wire:model="currentcomplaints" id="currentcomplaints"
                        class="form-select  currentcomplaints-dropdown" multiple>
                        @foreach ($currentcomplaints_data as $eachcurrentcomplaints)
                        <option value="{{ $eachcurrentcomplaints->id }}" old()>
                            {{ $eachcurrentcomplaints->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('currentcomplaints')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'complaint_note',
                    'labelname' => '',
                    'labelidname' => 'complaint_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    'placeholder' => 'COMPLAINTS NOTE',
                    ])
                </div>
            </div>
            <div class="card-header theme_bg_color text-white fw-bold">
                VITALS
            </div>
            <div class="card-body">
                <div class="row g-3">

                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'temperature',
                    'labelname' => 'TEMPERATURE',
                    'labelidname' => 'temperatureid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'bloodpressure',
                    'labelname' => 'BLOOD PRESSURE',
                    'labelidname' => 'bloodpressureid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'height',
                    'labelname' => 'HEIGHT',
                    'labelidname' => 'heightid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'weight',
                    'labelname' => 'WEIGHT',
                    'labelidname' => 'weightid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'pulserate',
                    'labelname' => 'PULSE RATE',
                    'labelidname' => 'pulserateid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'respiratoryrate',
                    'labelname' => 'RESPIRATORY RATE',
                    'labelidname' => 'respiratoryrateid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'spo_two',
                    'labelname' => 'SpO2',
                    'labelidname' => 'spo_twoid',
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Pain Scale',
                    'fieldname' => 'painscaleone',
                    'labelname' => 'PAIN SCALE (1-10)',
                    'labelidname' => 'painscaleoneid',
                    'required' => false,
                    'col' => 'col-md-2',
                    'option' => config('archive.pain_scale'),
                    ])

                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'character',
                    'labelname' => 'CHARACTER',
                    'labelidname' => 'characterid',
                    'required' => false,
                    'col' => 'col-md-8',
                    ])
                </div>
            </div>


            <div class="card-header theme_bg_color text-white fw-bold">
                ALLERGY
            </div>
            <div class="card-body">
                <div class="row g-3 mt-1">
                    <select wire:model="allergy" id="allergy" class="form-select allergy-dropdown" multiple>
                        @foreach ($allergy_data as $eachallergy)
                        <option value="{{ $eachallergy->id }}">
                            {{ $eachallergy->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('allergy')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="card-header theme_bg_color text-white fw-bold">
                PSYCHOLOGICAL HISTORY
            </div>
            <div class="card-body">
                <div class="row g-3">

                    @include('helper.formhelper.form', [
                    'type' => 'formswitch',
                    'fieldname' => 'alcohol',
                    'labelname' => 'ALCOHOL',
                    'labelidname' => 'alcoholid',
                    'checked' => old('alcohol', $alcohol ?? false),
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'formswitch',
                    'fieldname' => 'tobacco',
                    'labelname' => 'SMOKING',
                    'labelidname' => 'tobaccoid',
                    'checked' => old('tobacco', $tobacco ?? false),
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'formswitch',
                    'fieldname' => 'smoking',
                    'labelname' => 'TOBACCO',
                    'labelidname' => 'smokingid',
                    'checked' => old('smoking', $smoking ?? false),
                    'required' => false,
                    'col' => 'col-md-2',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'others',
                    'labelname' => 'OTHERS',
                    'labelidname' => 'otherid',
                    'required' => false,
                    'col' => 'col-md-6',
                    ])
                </div>
            </div>


            <div class="card-header theme_bg_color text-white fw-bold">
                BILLING CATEGORY
            </div>
            <div class="card-body">
                <div class="px-4 text-center">
                    <div class="form-check form-check-inline">
                        <input wire:model="billing_type" value=1 class="form-check-input" type="radio"
                            name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            SELF BILLING
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input wire:model="billing_type" value=2 class="form-check-input" type="radio"
                            name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            INSURANCE BILLING
                        </label>
                    </div>
                    {{-- <div class="form-check form-check-inline">
                            <input wire:model="billing_type" value=3 class="form-check-input" type="radio"
                                name="flexRadioDefault" id="flexRadioDefault3" checked>
                            <label class="form-check-label" for="flexRadioDefault3">
                                CORPORATE BILLING
                            </label>
                        </div> --}}

                    @if ($billing_type == 2)
                    <div class="alert alert-warning col-md-6 mx-auto">
                        <strong>Warning!</strong> You Are Selected Insurance Billing.
                    </div>
                    @endif

                </div>

                @if ($billing_type == 2)
                <hr>
                <div class="row g-3">

                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Insurance Company',
                    'fieldname' => 'insurancecompany_id',
                    'labelname' => 'INSURANCE COMPANY',
                    'labelidname' => 'insurancecompanyid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $insurancecompany_data,
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select TPA Name',
                    'fieldname' => 'tpaname_id',
                    'labelname' => 'TPA NAME',
                    'labelidname' => 'tpanameid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $insurancecompany_data,
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'tpaidno',
                    'labelname' => 'TPA ID No.',
                    'labelidname' => 'tpaidno',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'policyno',
                    'labelname' => 'POLICY No.',
                    'labelidname' => 'policynoid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                </div>
                @endif
            </div>



            <div class="card-header theme_bg_color text-white fw-bold">
                ADDITIONAL NOTE
            </div>
            <div class="card-body">
                <div class="row g-3">

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'visit_note',
                    'labelname' => '',
                    'labelidname' => 'visit_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                    ])
                </div>
            </div>
        </div>
        <div class="card-footer float-end bg-light px-2 py-1">
            @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
            'method_name' => 'store',
            'model_id' => $patient_uhid,
            ])
            <button type="button" class="btn btn-secondary" wire:click="formreset">Clear</button>
        </div>
    </form>
    @endif
</div>
@push('scripts')
<!-- <script>
        $(document).ready(function() {

            window.loadAllergySelect2 = () => {
                $('.allergy-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('allergy', data);
                });
            }
            loadAllergySelect2();
            window.livewire.on('loadaAllergySelect2Hydrate', () => {
                loadAllergySelect2();
            });

            window.loadCurrentcomplaintsSelect2 = () => {
                $('.currentcomplaints-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('currentcomplaints', data);
                });
            }
            loadCurrentcomplaintsSelect2();
            window.livewire.on('loadCurrentcomplaintsSelect2Hydrate', () => {
                loadCurrentcomplaintsSelect2();
            });
        });
    </script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // find Livewire component id for an element
        function findComponentId(el) {
            const comp = el.closest('[wire\\:id]');
            return comp ? comp.getAttribute('wire:id') : null;
        }

        // initialize a single select element for Select2 and bind change to Livewire
        function initSelectElement(el, property) {
            const $el = $(el);

            // destroy if Select2 is already attached (prevents duplicate bindings)
            if ($el.hasClass('select2-hidden-accessible')) {
                try {
                    $el.select2('destroy');
                } catch (e) {
                    /* ignore */
                }
            }

            // init Select2
            $el.select2();

            // remove previous handler then bind
            $el.off('change.select2').on('change.select2', function() {
                const compId = findComponentId(this);
                if (!compId) {
                    console.warn('Livewire component id not found for select', this);
                    return;
                }
                // set Livewire property on server-side component
                Livewire.find(compId).set(property, $el.val());
            });
        }

        // init all present selects on page
        function initAllSelects() {
            document.querySelectorAll('.allergy-dropdown').forEach(el => initSelectElement(el, 'allergy'));
            document.querySelectorAll('.currentcomplaints-dropdown').forEach(el => initSelectElement(el, 'currentcomplaints'));
        }

        // initial init
        initAllSelects();

        // Re-init only the selects that were inside an updated subtree after Livewire morph
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
</script>
@endpush