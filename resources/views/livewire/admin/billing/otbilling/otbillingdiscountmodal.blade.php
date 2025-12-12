<div wire:ignore.self class="modal fade" id="otbillingdiscountModal" data-bs-backdrop="static"
    data-bs-keyotservicemaster="false" tabindex="-1" aria-labelledby="otbillingdiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="storediscount" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="otbillingdiscountModalLabel">
                        OT BILLING DISCOUNT </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'discount',
                            'labelname' => 'DISCOUNT',
                            'labelidname' => 'discountid',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'discount_note',
                            'labelname' => 'NOTE',
                            'labelidname' => 'discountnoteid',
                            'required' => true,
                            'rows' => 1,
                            'col' => 'col-md-8',
                        ])
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'storediscount',
                        'model_id' => '',
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
