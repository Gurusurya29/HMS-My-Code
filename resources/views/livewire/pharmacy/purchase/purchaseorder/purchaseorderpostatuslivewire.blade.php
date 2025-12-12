<div>
    @if ($po_status)
        <button type="button" class="btn btn-sm btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#revoke-{{$po_id}}"
            wire:loading.remove wire:target='updatepostatus'>
            Revoke
        </button>
        <div class="text-center" wire:loading wire:target='updatepostatus'>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="modal fade" data-bs-backdrop="static" id="revoke-{{$po_id}}" tabindex="-1" aria-labelledby="revokeLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="fs-4 fw-bold">
                            Are you sure you want to revoke this purchase order.
                        </span>
                        <div class="d-flex justify-content-center gap-2 m-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                wire:click="updatepostatus">Revoke PO</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <button type="button" class="btn btn-sm btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#confirm-{{$po_id}}"
            wire:loading.remove wire:target='updatepostatus'>
            Complete
        </button>
        <div class="text-center" wire:loading wire:target='updatepostatus'>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="modal fade" data-bs-backdrop="static" id="confirm-{{$po_id}}" tabindex="-1" aria-labelledby="confirmLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="fs-4 fw-bold">
                            Are you sure you want to complete this purchase order.
                        </span>
                        <div class="d-flex justify-content-center gap-2 m-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                wire:click="updatepostatus">Complete PO</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
