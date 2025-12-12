<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($user_id) ? 'UPDATE' : 'CREATE' }}
                        USER</h5>
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
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'username',
                            'labelname' => 'USER NAME',
                            'labelidname' => 'usernameid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'email',
                            'labelname' => 'EMAIL',
                            'labelidname' => 'emailid',
                            'required' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'phone',
                            'labelname' => 'PHONE',
                            'labelidname' => 'phoneid',
                            'required' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'file',
                            'fieldname' => 'avatar',
                            'labelname' => 'AVATAR',
                            'labelidname' => 'avatarid',
                            'required' => false,
                            'col' => 'col-md-4',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'role_id',
                            'labelname' => 'ROLE',
                            'labelidname' => 'roleid',
                            'default_option' => 'Select Role',
                            'option' => $roles_data,
                            'required' => true,
                            'col' => 'col-md-4',
                        ])

                        @if (!$this->user_id)
                            @include('helper.formhelper.form', [
                                'type' => 'password',
                                'fieldname' => 'password',
                                'labelname' => 'PASSWORD',
                                'labelidname' => 'passwordid',
                                'required' => false,
                                'col' => 'col-md-4',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'password',
                                'fieldname' => 'password_confirmation',
                                'labelname' => 'CONFIRM PASSWORD',
                                'labelidname' => 'confirmpasswordid',
                                'required' => false,
                                'col' => 'col-md-4',
                            ])
                        @endif
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
                        'model_id' => $user_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
