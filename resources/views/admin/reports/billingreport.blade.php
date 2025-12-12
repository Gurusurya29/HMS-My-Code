<h5>Billing Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        @can('OP Billing-report')
            <div class="col-md-2">
                <a href="{{ route('opbillingreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-card-list" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">OP Billing Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('IP Billing-report')
            <div class="col-md-2">
                <a href="{{ route('ipbillingreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-list-columns" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">IP Billing Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('OT Billing-report')
            <div class="col-md-2">
                <a href="{{ route('otbillingreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-list-stars" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">OT Billing Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
