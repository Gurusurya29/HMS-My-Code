<h5>Out Patient Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        @can('Outpatient-report')
            <div class="col-md-2">
                <a href="{{ route('outpatientreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-person-workspace" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Out Patient Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Doctor Wise OP Visit-report')
            <div class="col-md-2">
                <a href="{{ route('doctorwiseopvisitreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-window-dock" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Doctor Wise OP Visit Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Doctor Wise OP Bill-report')
            <div class="col-md-2">
                <a href="{{ route('doctorwiseopbillreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-calendar4-range" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Doctor Wise OP Bill Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
