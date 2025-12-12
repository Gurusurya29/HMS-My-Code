<div wire:poll.60s>
    @if (count($emghms) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Emergency Alert !!</strong> You should check in on some of those HMS prescriptions.
            <a href="{{ route('pharmacy.hmsprescriptionindex') }}" class="btn btn-sm btn-primary mx-3">Check</a>
        </div>
    @endif
</div>
