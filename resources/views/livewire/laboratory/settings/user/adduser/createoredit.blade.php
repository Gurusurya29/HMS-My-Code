<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($laboratory_id) ? 'UPDATE' : 'CREATE' }}
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
                            'required' => true,
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
                            'fieldname' => 'role',
                            'labelname' => 'ROLE',
                            'labelidname' => 'roleid',
                            'default_option' => 'Select Role',
                            'option' => config('archive.investigationrole'),
                            'required' => true,
                            'col' => 'col-md-4',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'access_lab',
                            'labelname' => 'IS LAB',
                            'labelidname' => 'access_lab',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'access_scan',
                            'labelname' => 'IS SCAN',
                            'labelidname' => 'access_scan',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'access_xray',
                            'labelname' => 'IS X-RAY',
                            'labelidname' => 'access_xray',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'active',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @if (!$this->laboratory_id)
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
                            'col' => 'col-md-4',
                        ])

                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div wire:loading wire:target="store">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                    <button wire:loading.remove type="submit" wire:target="store"
                        class="btn btn-primary">{{ isset($laboratory_id) ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
