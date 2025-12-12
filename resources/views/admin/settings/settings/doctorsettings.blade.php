@can('Doctor')
    <h5>Doctor Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Doctor')
                <div class="col-md-2">
                    <a href="{{ route('adddoctor') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-badge" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Add Doctor</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Doctor-specialization')
                <div class="col-md-2">
                    <a href="{{ route('doctorspecialization') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-journal-plus" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Doctor Specialization</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            {{-- <div class="col-md-2">
            <a href="{{ route('doctorconsultationfee') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-wallet2" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Consultation Fee</div>
                    </div>
                </div>
            </a>
        </div> --}}
        </div>
    </div>
@endcan
