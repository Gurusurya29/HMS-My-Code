<h5>Log Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        @can('Loginlogs-report')
            <div class="col-md-2">
                <a href="{{ route('loginlogsreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-door-open" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Login Logs Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Trackinglogs-report')
            <div class="col-md-2">
                <a href="{{ route('trackinglogsreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-binoculars" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Tracking Logs Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
