@can('Pharmacy')
    <h5>Pharmacy Settings</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Pharmacy-master')
                <div class="col-md-2">
                    <a href="{{ route('adminpharmacysettings') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-video3" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Pharmacy Master</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
