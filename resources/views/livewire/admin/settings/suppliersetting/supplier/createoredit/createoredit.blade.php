<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keysupplier="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl text-black">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($supplier_id) ? 'UPDATE' : 'CREATE' }}
                        SUPPLIER</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'company_name',
                            'labelname' => 'COMPANY NAME',
                            'labelidname' => 'company_name',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'company_person_name',
                            'labelname' => 'CONTACT PERSON NAME',
                            'labelidname' => 'company_person_name',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'contact_mobile_no',
                            'labelname' => 'CONTACT MOBILE NO',
                            'labelidname' => 'contact_mobile_no',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'contact_phone_no',
                            'labelname' => 'CONTACT PHONE NO',
                            'labelidname' => 'contact_phone_no',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'email',
                            'fieldname' => 'email',
                            'labelname' => 'EMAIL',
                            'labelidname' => 'email',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'address',
                            'labelname' => 'ADDRESS',
                            'labelidname' => 'address',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select a Country',
                            'fieldname' => 'country_id',
                            'labelname' => 'COUNTRY',
                            'labelidname' => 'country_id',
                            'required' => false,
                            'option' => $countrylist,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select a State',
                            'fieldname' => 'state_id',
                            'labelname' => 'STATE',
                            'labelidname' => 'state_id',
                            'required' => false,
                            'option' => $statelist,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'city',
                            'labelname' => 'city',
                            'labelidname' => 'city',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'pincode',
                            'labelname' => 'PINCODE',
                            'labelidname' => 'pincode',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'gstin',
                            'labelname' => 'GSTIN',
                            'labelidname' => 'gstin',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'pan',
                            'labelname' => 'PAN',
                            'labelidname' => 'pan',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_name',
                            'labelname' => 'BANK NAME',
                            'labelidname' => 'bank_name',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_ifsc',
                            'labelname' => 'BANK IFSC',
                            'labelidname' => 'bank_ifsc',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_branch',
                            'labelname' => 'BANK BRANCH',
                            'labelidname' => 'bank_branch',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_ac_number',
                            'labelname' => 'BANK AC NUMBER',
                            'labelidname' => 'bank_ac_number',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_hms',
                            'labelname' => 'HMS',
                            'labelidname' => 'is_hms',
                            'required' => false,
                            'col' => 'col-md-1',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_pharmacy',
                            'labelname' => 'PHARMACY',
                            'labelidname' => 'is_pharmacy',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_equipment',
                            'labelname' => 'EQUIPMENT',
                            'labelidname' => 'is_equipment',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_inventory',
                            'labelname' => 'INVENTORY',
                            'labelidname' => 'is_inventory',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_canteen',
                            'labelname' => 'CANTEEN',
                            'labelidname' => 'is_canteen',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_laboratory',
                            'labelname' => 'LABORATORY',
                            'labelidname' => 'is_laboratory',
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
                            'col' => 'col-md-6',
                        ])
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    @include('common.create.spinner', ['target' => 'store'])
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'store',
                        'model_id' => $supplier_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
