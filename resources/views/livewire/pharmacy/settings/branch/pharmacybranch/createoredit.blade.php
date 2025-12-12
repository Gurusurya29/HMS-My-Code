<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static"
    data-bs-keypharmacycategory="false" tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($pharmbranch_id) ? 'UPDATE' : 'CREATE' }}
                        BRANCH</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'contact_person',
                            'labelname' => 'CONTACT PERSON',
                            'labelidname' => 'contact_person',
                            'required' => true,
                            'col' => 'col-md-6',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'branch_name',
                            'labelname' => 'BRANCH NAME',
                            'labelidname' => 'branch_name',
                            'required' => true,
                            'col' => 'col-md-6',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'gstin',
                            'labelname' => 'GST IN',
                            'labelidname' => 'gstin',
                            'required' => true,
                            'col' => 'col-md-6',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'pan',
                            'labelname' => 'PAN',
                            'labelidname' => 'pan',
                            'required' => true,
                            'col' => 'col-md-6',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'col' => 'col-md-12',
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
