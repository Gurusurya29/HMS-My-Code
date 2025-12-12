<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static"
    data-bs-keypharmacydrugmaster="false" tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        ADD REQUESTED PRODUCT </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
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
                            'type' => 'select',
                            'default_option' => 'Select a Category',
                            'fieldname' => 'pharmacycategory_id',
                            'labelname' => 'CATEGORY',
                            'labelidname' => 'pharmacycategory_id',
                            'required' => false,
                            'option' => $pharmacycategory_option,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select a Sub Category',
                            'fieldname' => 'pharmacysubcategory_id',
                            'labelname' => 'SUB CATEGORY',
                            'labelidname' => 'pharmacysubcategory_id',
                            'required' => false,
                            'option' => $pharmacysubcategory_option,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select a Manufacture Name',
                            'fieldname' => 'pharmacymanufacture_id',
                            'labelname' => 'MANUFACTURE NAME',
                            'labelidname' => 'pharmacymanufacture_id',
                            'required' => false,
                            'option' => $pharmacymanufacture_option,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select a Generic Name',
                            'fieldname' => 'pharmacygenaric_id',
                            'labelname' => 'GENERIC NAME',
                            'labelidname' => 'pharmacygenaric_id',
                            'required' => false,
                            'option' => $pharmacygenaric_option,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'product_code',
                            'labelname' => 'PRODUCT CODE',
                            'labelidname' => 'product_code',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'product_sku',
                            'labelname' => 'SKU',
                            'labelidname' => 'product_sku',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'hsn',
                            'labelname' => 'HSN',
                            'labelidname' => 'hsn',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'min_stock',
                            'labelname' => 'MIN STOCK & REORDER LEVEL',
                            'labelidname' => 'min_stock',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'mrp',
                            'labelname' => 'MRP',
                            'labelidname' => 'mrp',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'purchase_rate',
                            'labelname' => 'PURCHASE RATE',
                            'labelidname' => 'purchase_rate',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'sgst',
                            'labelname' => 'SGST',
                            'labelidname' => 'sgst',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'cgst',
                            'labelname' => 'CGST',
                            'labelidname' => 'cgst',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])

                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'igst',
                            'labelname' => 'IGST',
                            'labelidname' => 'igst',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'cess',
                            'labelname' => 'CESS',
                            'labelidname' => 'cess',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'stock_required',
                            'labelname' => 'STOCK REQUIRED',
                            'labelidname' => 'stock_required',
                            'required' => false,
                            'col' => 'col-md-2',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'is_schedule',
                            'labelname' => 'IS SCHEDULE?',
                            'labelidname' => 'is_schedule',
                            'required' => false,
                            'col' => 'col-md-3',
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
