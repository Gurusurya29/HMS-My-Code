<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keyfacility="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($facility_id) ? 'UPDATE' : 'CREATE' }}
                        FACILITY </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'name',
                            'labelname' => 'ASSET OR EQUIPMENT NAME',
                            'labelidname' => 'nameid',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'assetid',
                            'labelname' => 'ASSET ID',
                            'labelidname' => 'assetid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'location',
                            'labelname' => 'LOCATION',
                            'labelidname' => 'locationid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'location_comment',
                            'labelname' => 'LOCATION COMMENT',
                            'labelidname' => 'locationcommentid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'manufacture',
                            'labelname' => 'MANUFACTURER',
                            'labelidname' => 'manufactureid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'model_no',
                            'labelname' => 'MODEL NO',
                            'labelidname' => 'modelnoid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'serial_no',
                            'labelname' => 'SERIAL NO',
                            'labelidname' => 'serailnoid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'installation_date',
                            'labelname' => 'INSTALLATION DATE',
                            'labelidname' => 'installationdateid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'supplied_date',
                            'labelname' => 'SUPPLIED DATE',
                            'labelidname' => 'supplieddateid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'asset_type',
                            'labelname' => 'ASSET TYPE',
                            'labelidname' => 'assettypeid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'asset_description',
                            'labelname' => 'ASSET DESCRIPTION',
                            'labelidname' => 'assetdescriptionid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'supplied_by_vendor',
                            'labelname' => 'SUPPLIED BY VENDOR',
                            'labelidname' => 'suppliedbyvendorid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'asset_install_verifiedby',
                            'labelname' => 'ASSET INSTALLATION VERIFIED BY',
                            'labelidname' => 'assetinstallverifiedbyid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'asset_comment',
                            'labelname' => 'ASSET COMMENTS',
                            'labelidname' => 'assetcommentid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'asset_custodian',
                            'labelname' => 'ASSET CUSTODIAN',
                            'labelidname' => 'asset_custodianid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'warranty_exp_date',
                            'labelname' => 'WARRANTY EXPIRY DATE',
                            'labelidname' => 'warrantyexpdateid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'warranty_contact_person',
                            'labelname' => 'WARRANTY OR SERVICE CONTACT PERSON',
                            'labelidname' => 'warrantycontactpersonid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        {{-- @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'asset_custodian',
                            'labelname' => 'ASSET CUSTODIAN',
                            'labelidname' => 'assetcustodianid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ]) --}}

                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Condition',
                            'fieldname' => 'asset_condition',
                            'labelname' => 'ASSET CONDITION',
                            'labelidname' => 'asset_conditionid',
                            'required' => false,
                            'col' => 'col-md-3',
                            'option' => config('archive.asset_condition'),
                        ])


                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'col' => 'col-md-6',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'active',
                            'required' => false,
                            'col' => 'col-md-1',
                        ])
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'store',
                        'model_id' => $facility_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
