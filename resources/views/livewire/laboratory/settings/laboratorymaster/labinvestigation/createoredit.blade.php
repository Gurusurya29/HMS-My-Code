<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static"
    data-bs-keylabinvestigation="false" tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($labinvestigation_id) ? 'UPDATE' : 'CREATE' }}
                        INVESTIGATION </h5>
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
                            'fieldname' => 'labinvestigationgroup_id',
                            'labelname' => 'INVESTIGATION GROUP',
                            'labelidname' => 'labinvestigationgroupid',
                            'option' => $labinvestigationgrouplist,
                            'default_option' => 'Select Category',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'labtestmethod_id',
                            'labelname' => 'TEST METHOD',
                            'labelidname' => 'labtestmethodid',
                            'option' => $labtestmethodlist,
                            'default_option' => 'Select Test Method',
                            'required' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'labunit_id',
                            'labelname' => 'UNITS',
                            'labelidname' => 'labunitid',
                            'option' => $labunitslist,
                            'default_option' => 'Select Unit',
                            'required' => false,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'selffee',
                            'labelname' => 'SELF FEE',
                            'labelidname' => 'selffeeid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'insurancefee',
                            'labelname' => 'INSURANCE FEE',
                            'labelidname' => 'insurancefeeid',
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
                            'type' => 'textarea',
                            'fieldname' => 'range',
                            'labelname' => 'RANGE',
                            'labelidname' => 'rangeid',
                            'required' => false,
                            'col' => 'col-md-5',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'noteid',
                            'required' => false,
                            'col' => 'col-md-5',
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
                        class="btn btn-primary">{{ isset($labinvestigation_id) ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
