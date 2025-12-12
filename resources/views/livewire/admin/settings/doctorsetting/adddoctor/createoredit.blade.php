<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keyadddoctor="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($adddoctor_id) ? 'UPDATE' : 'CREATE' }}
                        ADD DOCTOR </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'name',
                            'labelname' => 'DOCTOR NAME',
                            'labelidname' => 'nameid',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'surname',
                            'labelname' => 'DOCTOR SURNAME',
                            'labelidname' => 'surnameid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Specialization',
                            'fieldname' => 'doctorspecialization_id',
                            'labelname' => 'DOCTOR SPECIALIZATION',
                            'labelidname' => 'doctorspecialization_id',
                            'required' => false,
                            'col' => 'col-md-3',
                            'option' => $doctorspecializationlist,
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'department',
                            'labelname' => 'DEPARTMENT',
                            'labelidname' => 'departmentid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'designation',
                            'labelname' => 'DESIGNATION',
                            'labelidname' => 'designationid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'doj',
                            'labelname' => 'DATE OF JOINING',
                            'labelidname' => 'dojid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'doctor_type',
                            'labelname' => 'DOCTOR TYPE',
                            'labelidname' => 'doctortypeid',
                            'default_option' => 'Select Type',
                            'option' => [
                                1 => 'Permanent',
                                2 => 'Consultant',
                            ],
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'registration_validdays',
                            'labelname' => 'REGISTRATION VALID DAYS',
                            'labelidname' => 'registration_validdaysid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'no_of_freevisit',
                            'labelname' => 'NO OF FREE VISITS',
                            'labelidname' => 'no_of_freevisitid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'showinchargememos',
                            'labelname' => 'SHOW IN CHARGE MEMOS',
                            'labelidname' => 'showinchargememosid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'consultation_fee',
                            'labelname' => 'CONSULTATION FEE',
                            'labelidname' => 'consultation_feeid',
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
                            'type' => 'number',
                            'fieldname' => 'emergency_number',
                            'labelname' => 'EMERGENCY CONTACT NUMBER',
                            'labelidname' => 'emergency_numberid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_surgeon',
                            'labelname' => 'IS SURGEON',
                            'labelidname' => 'is_surgeon',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'active',
                            'required' => false,
                            'col' => 'col-md-1',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'col' => 'col-md-8',
                        ])
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'store',
                        'model_id' => $adddoctor_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
