@can('Ward')
    <h5>Ward Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Ward-type')
                <div class="col-md-2">
                    <a href="{{ route('wardtype') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-align-start" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Ward Type</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Ward-floor/block')
                <div class="col-md-2">
                    <a href="{{ route('wardfloor') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-hospital" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Ward Floor/Block</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Bed-or-room-number')
                <div class="col-md-2">
                    <a href="{{ route('bedorroomnumber') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-123" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Bed Or Room Number</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
