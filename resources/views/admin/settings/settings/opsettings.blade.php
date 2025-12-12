@can('Out-Patient')
    <h5>Out Patient Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Diagnosis')
                <div class="col-md-2">
                    <a href="{{ route('diagnosismaster') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-video3" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Diagnosis</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Physical-and-general')
                <div class="col-md-2">
                    <a href="{{ route('physicalexam') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-lines-fill" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Physical & General Examination</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('OP-billing-services')
                <div class="col-md-2">
                    <a href="{{ route('opservicemaster') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-clipboard-plus" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">OP Billing Services</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
