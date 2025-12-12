<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static"
    data-bs-keydoctorconsultationfee="false" tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($doctorconsultationfee_id) ? 'UPDATE' : 'CREATE' }}
                        DOCTOR CONSULTATION FEE </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Doctor',
                            'fieldname' => 'doctor_id',
                            'labelname' => 'DOCTOR NAME',
                            'labelidname' => 'doctorid',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => $doctoroption,
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'default_option' => 'Select Specialization',
                            'fieldname' => 'doctorspecialization_id',
                            'labelname' => 'SPECIALIZATION',
                            'labelidname' => 'doctorspecializationid',
                            'required' => true,
                            'col' => 'col-md-4',
                            'option' => $doctorspecializationoption,
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
                        'model_id' => $doctorconsultationfee_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
