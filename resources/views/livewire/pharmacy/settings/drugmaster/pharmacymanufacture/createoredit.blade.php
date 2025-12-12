<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keypharmacygenaric="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($pharmacymanufacture_id) ? 'UPDATE' : 'CREATE' }}
                        MANUFACTURE NAME </h5>
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
                            'fieldname' => 'contact_no',
                            'labelname' => 'CONTACT NO',
                            'labelidname' => 'contact_no',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'address',
                            'labelname' => 'ADDRESS',
                            'labelidname' => 'address',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select a Generic Name',
                            'fieldname' => 'pharmacycategory_id',
                            'labelname' => 'CATEGORY',
                            'labelidname' => 'pharmacycategory_id',
                            'required' => false,
                            'option' => $category_list,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'active',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                    </div>
                </div>
                <div class="modal-footer  d-flex justify-content-end gap-1 align-items-center  px-2 py-1">
                    <div wire:loading wire:target="store" class="mt-2">
                        <div class="spinner-border loadingspinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
