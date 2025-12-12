@can('In-Patient')
    <h5>In Patient Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('IP-treatment')
                <div class="col-md-2">
                    <a href="{{ route('iptreatment') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-clipboard-plus-fill" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">IP Treatment</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('IP-service-category')
                <div class="col-md-2">
                    <a href="{{ route('ipservicecategory') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-file-earmark-diff-fill" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">IP Service Category</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('IP-billing-services')
                <div class="col-md-2">
                    <a href="{{ route('ipservicemaster') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-card-checklist" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">IP Billing Services</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
