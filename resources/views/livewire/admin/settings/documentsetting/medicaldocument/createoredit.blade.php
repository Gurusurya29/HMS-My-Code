<div wire:ignore.self class="modal fade" id="createoreditModal" data-bs-backdrop="static" data-bs-keymedicaldocument="false"
    tabindex="-1" aria-labelledby="createoreditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="store" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="createoreditModalLabel">
                        {{ isset($medicaldocument_id) ? 'UPDATE' : 'CREATE' }}
                        MEDICAL DOCUMENT </h5>
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
                            'type' => 'toggle',
                            'fieldname' => 'active',
                            'labelname' => 'ACTIVE',
                            'labelidname' => 'active',
                            'required' => false,
                            'col' => 'col-md-1',
                        ])
                        <div class="col-md-12" wire:ignore>
                            <label for="descriptionid" class="form-label">DESCRIPTION</label>
                            <textarea wire:model.lazy="description" class="form-control summernote" id="descriptionid">{!! $description !!}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'store',
                        'model_id' => $medicaldocument_id,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
