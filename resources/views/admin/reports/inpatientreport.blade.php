<h5>In Patient Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        @can('Inpatient-report')
            <div class="col-md-2">
                <a href="{{ route('inpatientreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-thermometer-half" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">In Patient Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Scheduled Surgery-report')
            <div class="col-md-2">
                <a href="{{ route('scheduledsurgeryreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-calendar3-week" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Scheduled Surgery Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Completed Surgery-report')
            <div class="col-md-2">
                <a href="{{ route('completedsurgeryreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-calendar3-week-fill" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Completed Surgery Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Dischargedpatient-report')
            <div class="col-md-2">
                <a href="{{ route('dischargedpatientreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-card-heading" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Discharged Patient Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
