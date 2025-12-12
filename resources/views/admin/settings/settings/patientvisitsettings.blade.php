@can('Patient-Visit')
    <h5>Patient Visit Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Allergy')
                <div class="col-md-2">
                    <a href="{{ route('allergymaster') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-badge" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Allergy</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Current-complaints')
                <div class="col-md-2">
                    <a href="{{ route('currentcomplaints') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-file-medical" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Current Complaints</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Insurance-company')
                <div class="col-md-2">
                    <a href="{{ route('insurancecompanymaster') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-file-earmark-medical" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Insurance Company </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
