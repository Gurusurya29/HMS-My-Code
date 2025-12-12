<div>
    <button type="button" class="btn btn-sm btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#confirm-{{$pharmplanningid}}"
        wire:loading.remove wire:target='movetopo'>
        PO
    </button>
    <div class="text-center" wire:loading wire:target='movetopo'>
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="modal fade" data-bs-backdrop="static" id="confirm-{{$pharmplanningid}}" tabindex="-1" aria-labelledby="confirmLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="fs-4 fw-bold">
                        Are you sure you want to move this purchase planning to purchase order. <br>
                        ⚠️ These changes can not be undone! ⚠️
                    </span>

                    <div class="d-flex justify-content-center gap-2 m-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="movetopo">Move
                            to PO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
