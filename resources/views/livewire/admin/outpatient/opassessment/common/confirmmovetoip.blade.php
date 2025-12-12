<div wire:ignore.self class="modal fade" id="confirmmovetoipModal" data-bs-backdrop="static"
    data-bs-keyadddoctor="false" tabindex="-1" aria-labelledby="confirmmovetoipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white theme_bg_color px-3 py-2">
                <h5 class="modal-title" id="confirmmovetoipModalLabel">
                    COMFIRMATION </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="fs-3 fw-bold text-center text-danger">Are You Sure?</div>
                <p class="text-center fs-4 fw-bold">Move this Patient To IP</p>
            </div>
            <div class="modal-footer bg-light px-2 py-1">
                <button type="button" wire:click="cancelmovetoip" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" wire:click="confirmmovetoip" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
