<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static"
    data-bs-keylabinvestigationgroup="false" tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($labinvestigationgroup_id) ? 'UPDATE' : 'CREATE' }}
                        INVESTIGATION GROUP </h5>
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
                            'type' => 'select',
                            'default_option' => 'Select Investigation Type',
                            'fieldname' => 'labinvestigationtype',
                            'labelname' => 'INVESTIGATION TYPE',
                            'labelidname' => 'labinvestigationtype',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => config('archive.labinvestigationtype'),
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
                    <div wire:loading wire:target="store">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                    <button wire:loading.remove type="submit" wire:target="store"
                        class="btn btn-primary">{{ isset($labinvestigationgroup_id) ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
