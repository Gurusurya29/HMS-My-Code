<form wire:submit.prevent="store" class="bg-white shadow mt-2" autocomplete="off">

    <div class="row">
        <div class="col-md-12">
            <div class="card-header text-white theme_bg_color fw-bold">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1">PATIENT DETAILS FOR IP ADMISSION</div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('inpatientqueue') }}" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Salutation',
                    'fieldname' => 'salutation',
                    'labelname' => 'SALUTATION ',
                    'labelidname' => 'salutationid',
                    'required' => true,
                    'col' => 'col-md-3',
                    'option' => config('archive.salutation'),
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'name',
                    'labelname' => 'PATIENT FIRST NAME',
                    'labelidname' => 'patientnameid',
                    'required' => true,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'last_name',
                    'labelname' => 'LAST NAME',
                    'labelidname' => 'lastnameid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'number',
                    'fieldname' => 'phone',
                    'labelname' => 'MOBILE NUMBER',
                    'labelidname' => 'phoneid',
                    'required' => true,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'email',
                    'labelname' => 'EMAIL',
                    'labelidname' => 'emailid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Gender',
                    'fieldname' => 'gender',
                    'labelname' => 'GENDER',
                    'labelidname' => 'genderid',
                    'required' => true,
                    'col' => 'col-md-3',
                    'option' => config('archive.gender'),
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'age',
                    'labelname' => 'AGE',
                    'labelidname' => 'ageid',
                    'required' => true,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'date',
                    'fieldname' => 'dob',
                    'labelname' => 'DATE OF BIRTH',
                    'labelidname' => 'dobid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])

                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'aadharid',
                    'labelname' => 'AADHAR',
                    'labelidname' => 'aadharid_id',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'parentorguardian',
                    'labelname' => 'PARENT / GUARDIAN',
                    'labelidname' => 'parentorguardianid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])

                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Marital Status',
                    'fieldname' => 'marital_status',
                    'labelname' => 'MARITAL STATUS',
                    'labelidname' => 'marital_statusid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => config('archive.marital_status'),
                    ])

                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'spouse_name',
                    'labelname' => 'SPOUSE NAME',
                    'labelidname' => 'spouse_nameid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'door_no',
                    'labelname' => 'DOOR NUMBER',
                    'labelidname' => 'door_noid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'area',
                    'labelname' => 'AREA',
                    'labelidname' => 'areaid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'city',
                    'labelname' => 'CITY',
                    'labelidname' => 'cityid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'number',
                    'fieldname' => 'pincode',
                    'labelname' => 'PINCODE',
                    'labelidname' => 'pincodeid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select State',
                    'fieldname' => 'state_id',
                    'labelname' => 'STATE',
                    'labelidname' => 'stateid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $statelist,
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Country',
                    'fieldname' => 'country_id',
                    'labelname' => 'COUNTRY',
                    'labelidname' => 'countryid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $countrylist,
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Reference',
                    'fieldname' => 'reference_id',
                    'labelname' => 'REFERENCE',
                    'labelidname' => 'referenceid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => $referencelist,
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
                    'type' => 'formswitch',
                    'fieldname' => 'is_hospitalemployee',
                    'labelname' => 'IS HOSPITAL EMPLOYEE',
                    'labelidname' => 'is_hospitalemployeeid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @if ($is_hospitalemployee == true)
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'hospitalemployee_uniqid',
                    'labelname' => 'EMPLOYEE ID',
                    'labelidname' => 'hospitalemployee_uniqid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @endif
                    @include('helper.formhelper.form', [
                    'type' => 'formswitch',
                    'fieldname' => 'is_foreigner',
                    'labelname' => 'IS FOREIGNER',
                    'labelidname' => 'is_foreignerid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    {{-- @include('helper.formhelper.form', [
                        'type' => 'date',
                        'fieldname' => 'admission_date',
                        'labelname' => 'ADMISSION DATE',
                        'labelidname' => 'admission_dateid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ]) --}}
                    <div class="col-md-3 mb-3">
                        <label for="admission_dateid" class="form-label">ADMISSION DATE</label>

                        <span class="text-danger fw-bold">*</span>
                        <input wire:model.lazy="admission_date" type="datetime-local" class="form-control"
                            id="admission_dateid">
                        @error('admission_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @if ($is_foreigner == true)
        <div class="col-md-12">
            <div class="card-header theme_bg_color text-white fw-bold">
                FOREIGNER DETAILS
            </div>
            <div class="card-body">
                <div class="row g-2">
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'passport',
                    'labelname' => 'PASSPORT',
                    'labelidname' => 'passportid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'visa_details',
                    'labelname' => 'VISA DETAILS',
                    'labelidname' => 'visa_detailsid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'date',
                    'fieldname' => 'visa_expirydate',
                    'labelname' => 'VISA EXPIRY DATE',
                    'labelidname' => 'visa_expirydateid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'indian_contactperson',
                    'labelname' => 'INDIAN CONTACT PERSON',
                    'labelidname' => 'indian_contactpersonid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'number',
                    'fieldname' => 'indian_contactphone',
                    'labelname' => 'INDIAN CONTACT NO',
                    'labelidname' => 'indian_contactphoneid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])

                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'foreign_contactperson',
                    'labelname' => 'FOREIGN CONTACT PERSON',
                    'labelidname' => 'foreign_contactpersonid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'number',
                    'fieldname' => 'foreign_contactphone',
                    'labelname' => 'FOREIGN CONTACT NO',
                    'labelidname' => 'foreign_contactphoneid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'lang_knowntopatient',
                    'labelname' => 'LANGUAGES KNOWN TO PATIENT',
                    'labelidname' => 'lang_knowntopatientid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'lang_knowntocaretaker',
                    'labelname' => 'LANGUAGES KNOWN TO CARE TAKER',
                    'labelidname' => 'lang_knowntocaretakerid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold rounded-0">
                    ATTENDER DETAILS
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'attender_name',
                        'labelname' => 'ATTENDER NAME',
                        'labelidname' => 'attendernameid',
                        'required' => true,
                        'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                        'type' => 'select',
                        'fieldname' => 'attender_relationship',
                        'labelname' => 'RELATIONSHIP TO PATIENT',
                        'labelidname' => 'attenderrelationshipid',
                        'default_option' => 'Select Relationship',
                        'option' => config('archive.relationship'),
                        'required' => true,
                        'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'attender_phone',
                        'labelname' => 'CONTACT NO',
                        'labelidname' => 'attenderphoneid',
                        'required' => true,
                        'col' => 'col-md-3',
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold rounded-0">
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold rounded-0">
                    WARD DETAILS
                </div>
                <div class="card-body">
                    @if ($inpatient->ipadmission)
                    <div class="fw-bold fs-4">Ward Type :
                        <span class="text-success">{{ $inpatient->ipadmission->wardtype->name }}</span>
                    </div>
                    <div class="fw-bold fs-4">Bed/Room Number :
                        <span class="text-success">{{ $inpatient->ipadmission->bedorroomnumber->name }}</span>
                    </div>
                    @else
                    <div class="row g-2">
                        @include('helper.formhelper.form', [
                        'type' => 'select',
                        'default_option' => 'Select Ward Type',
                        'fieldname' => 'wardtype_id',
                        'labelname' => 'WARD TYPE',
                        'labelidname' => 'wardtype_id',
                        'required' => true,
                        'col' => 'col-md-6',
                        'option' => $wardtype_data,
                        ])
                        @include('helper.formhelper.form', [
                        'type' => 'select',
                        'default_option' => 'Select Bed/Room',
                        'fieldname' => 'bedorroomnumber_id',
                        'labelname' => 'BED/ROOM NUMBER',
                        'labelidname' => 'bedorroomnumber_id',
                        'required' => true,
                        'col' => 'col-md-6',
                        'option' => $bedorroomnumber_data,
                        ])
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header theme_bg_color text-white fw-bold rounded-0">
                    NOTE
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'note',
                        'labelname' => 'NOTE',
                        'labelidname' => 'noteid',
                        'rows' => 1,
                        'required' => false,
                        'col' => 'col-md-12',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center bg-light px-2 py-4">
        <a href="" class="btn btn-secondary">Cancel</a>
        @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
        'method_name' => 'store',
        'model_id' => '',
        ])
    </div>
</form>

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

    });
</script>
@endpush