<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-key="false" tabindex="-1"
    aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        PATIENT TRANSFER </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Ward Type',
                            'fieldname' => 'changedwardtype_id',
                            'labelname' => 'WARD TYPE',
                            'labelidname' => 'changedwardtype_id',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => $wardtype_data,
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Bed/Room',
                            'fieldname' => 'changedroom_id',
                            'labelname' => 'BED/ROOM NUMBER',
                            'labelidname' => 'changedroom_id',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => $bedorroomnumber_data,
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'store',
                        'model_id' => '',
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
