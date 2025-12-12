@can('Patient-Registration')
    <h5>Patient Registeration Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Referance')
                <div class="col-md-2">
                    <a href="{{ route('referencemaster') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-rolodex" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Referance </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Country')
                <div class="col-md-2">
                    <a href="{{ route('country') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-globe" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Country</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('State')
                <div class="col-md-2">
                    <a href="{{ route('states') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-geo-alt" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">State</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
