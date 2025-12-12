<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keybedorroomnumber="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($bedorroomnumber_id) ? 'UPDATE' : 'CREATE' }}
                        BED OR ROOM NUMBER </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Type',
                            'fieldname' => 'wardtype_id',
                            'labelname' => 'WARD TYPE',
                            'labelidname' => 'wardtypeid',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => $wardtypeoption,
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Floor',
                            'fieldname' => 'wardfloor_id',
                            'labelname' => 'WARD FLOOR / BLOCK',
                            'labelidname' => 'wardfloorid',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => $wardflooroption,
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'name',
                            'labelname' => 'BED OR ROOM NUMBER',
                            'labelidname' => 'nameid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'insurancefee',
                            'labelname' => 'INSURANCE FEE',
                            'labelidname' => 'insurancefeeid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'selffee',
                            'labelname' => 'SELF FEE',
                            'labelidname' => 'selffeeid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'active',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_ot',
                            'labelname' => 'IS OT',
                            'labelidname' => 'is_otid',
                            'required' => false,
                            'col' => 'col-md-2',
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
                        'model_id' => $bedorroomnumber_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
