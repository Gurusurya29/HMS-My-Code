<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-key="false" tabindex="-1"
    aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" autocomplete="off">
                <!-- Modal Header -->
                <div class="modal-header theme_bg_color text-white px-3 py-2">
                    <h5 class="modal-title">{{ isset($patient_id) ? 'UPDATE' : 'NEW' }} PATIENT REGISTRATION</h5>
                    <button type="button" wire:click="formreset" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- <div class="col-md-6 mb-3">
    <label for="patientnameid" class="form-label">PATIENT FIRST NAME</label>
    <div class="input-group">
        <span class="input-group-text p-0">
            <select wire:model.lazy="salutation" class="form-select">
                @foreach (config('archive.salutation') as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                            </select>
                            </span>
                            <input wire:model.lazy="name" type="text" class="form-control"
                                id="patientnameid">
                        </div>
                    </div> --}}
                    @include('helper.formhelper.form', [
                    'type' => 'select',
                    'default_option' => 'Select Salutation',
                    'fieldname' => 'salutation',
                    'labelname' => 'SALUTATION ',
                    'labelidname' => 'salutationid',
                    'required' => false,
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
                    'type' => 'select',
                    'default_option' => 'Select Blood Group',
                    'fieldname' => 'blood_group',
                    'labelname' => 'BLOOG GROUP',
                    'labelidname' => 'blood_groupid',
                    'required' => false,
                    'col' => 'col-md-3',
                    'option' => config('archive.blood_group'),
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
                    'fieldname' => 'occupation',
                    'labelname' => 'OCCUPATION',
                    'labelidname' => 'occupationid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'contact_person_name',
                    'labelname' => 'CONTACT PERSON NAME',
                    'labelidname' => 'contact_person_nameid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'contact_person_phone',
                    'labelname' => 'CONTACT PERSON PHONE',
                    'labelidname' => 'contact_person_phoneid',
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
                    'type' => 'file',
                    'fieldname' => 'avatar',
                    'labelname' => 'PHOTO (Passport Size)',
                    'labelidname' => 'avatarid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                    @if (isset($avatar))
                    <div class="col-md-2">
                        <img class="img-fluid mx-auto d-block rounded-md" style="width: 85px; height:85px;"
                            src="{{ $avatar->temporaryUrl() }}">
                    </div>
                    @elseif ($existingavatar)
                    <div class="col-md-2">
                        <img class="img-fluid mx-auto d-block rounded-md" style="width: 85px; height:85px;"
                            src="{{ url('storage/' . $existingavatar) }}">
                    </div>
                    @endif

                    @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'note',
                    'labelname' => 'NOTE',
                    'labelidname' => 'noteid',
                    'required' => false,
                    'col' => 'col-md-3',
                    ])
                </div>
        </div>
    </div>
    <div class="modal-footer bg-light px-2 py-1">

        <button type="button" wire:click="formreset" class="btn btn-secondary"
            data-bs-dismiss="modal">Close</button>
        @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
        'method_name' => 'store',
        'model_id' => $patient_id,
        ])
    </div>
    </form>
</div>
</div>
</div>