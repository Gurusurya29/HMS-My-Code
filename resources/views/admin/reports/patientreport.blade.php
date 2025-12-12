<h5>Patient Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        @can('Patientregistration-report')
            <div class="col-md-2">
                <a href="{{ route('patientregisterreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-person-bounding-box" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">New Patient Registeration Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Patientvisit-report')
            <div class="col-md-2">
                <a href="{{ route('patientvisitreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-people-fill" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Patient Visit Report</div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
