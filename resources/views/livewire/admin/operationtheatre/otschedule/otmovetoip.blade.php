<div wire:ignore.self class="modal fade" id="movetoipModal" data-bs-backdrop="static" data-bs-keyiptreatment="false"
    tabindex="-1" aria-labelledby="movetoipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="storemovetoip" autocomplete="off">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="movetoipModalLabel">
                        CONFIRMATAION FOR MOVE PATIENT TO IP </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check mx-2">
                        <input class="form-check-input p-2" type="checkbox" wire:model="is_movetoip" id="is_movetoip">
                        <label class="form-check-label fs-5 mx-1" for="is_movetoip">
                            Confirm Move Patient to IP Ward
                        </label>
                        <div>
                            @error('is_movetoip')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'movetoip_note',
                        'labelname' => 'NOTE',
                        'labelidname' => 'movetoip_noteid',
                        'required' => false,
                        'col' => 'col-md-12',
                    ])
                    @if ($is_movetoip)
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input wire:model="password" type="password" class="form-control"
                                placeholder="Enter password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                        'method_name' => 'storemovetoip',
                        'model_id' => '',
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
