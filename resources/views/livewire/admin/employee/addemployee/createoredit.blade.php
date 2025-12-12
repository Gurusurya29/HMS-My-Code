<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($employee_id) ? 'UPDATE' : 'CREATE' }}
                        EMPLOYEE</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'name',
                            'labelname' => 'NAME',
                            'labelidname' => 'nameid',
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
                            'type' => 'text',
                            'fieldname' => 'phone',
                            'labelname' => 'PHONE',
                            'labelidname' => 'phoneid',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])


                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'dob',
                            'labelname' => 'DOB',
                            'labelidname' => 'dobid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'doj',
                            'labelname' => 'DOJ',
                            'labelidname' => 'dojid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'education_qualification',
                            'labelname' => 'EDUCATION QUALIFICATION',
                            'labelidname' => 'education_qualificationid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'previous_organisation',
                            'labelname' => 'PREVIOUS ORGANISATION',
                            'labelidname' => 'previous_organisationid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'experience',
                            'labelname' => 'EXPERIENCE',
                            'labelidname' => 'experienceid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'aadhar_no',
                            'labelname' => 'AADHAR NO',
                            'labelidname' => 'aadhar_noid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'pan_no',
                            'labelname' => 'PAN NO',
                            'labelidname' => 'pan_noid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_name',
                            'labelname' => 'BANK NAME',
                            'labelidname' => 'bank_nameid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_account_no',
                            'labelname' => 'BANK ACCOUNT NO',
                            'labelidname' => 'bank_account_noid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_ifsc_code',
                            'labelname' => 'BANK IFSC CODE',
                            'labelidname' => 'bank_ifsc_codeid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_branch',
                            'labelname' => 'BANK BRANCH',
                            'labelidname' => 'bank_branchid',
                            'required' => false,
                            'col' => 'col-md-3',
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

                        {{-- @if (!$this->employee_id)
                            @include('helper.formhelper.form', [
                                'type' => 'password',
                                'fieldname' => 'password',
                                'labelname' => 'PASSWORD',
                                'labelidname' => 'passwordid',
                                'required' => false,
                                'col' => 'col-md-3',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'password',
                                'fieldname' => 'password_confirmation',
                                'labelname' => 'CONFIRM PASSWORD',
                                'labelidname' => 'confirmpasswordid',
                                'required' => false,
                                'col' => 'col-md-3',
                            ]) 
                        @endif --}}
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'col' => 'col-md-8',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_accountactive',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'is_accountactive',
                            'required' => false,
                            'col' => 'col-md-1',
                        ])
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'store',
                        'model_id' => $employee_id,
                    ])

                </div>
            </form>
        </div>
    </div>
</div>
