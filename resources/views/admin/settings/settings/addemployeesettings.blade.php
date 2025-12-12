@can('Employee')
    <h5>Employee Setting</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Add-employee')
                <div class="col-md-2">
                    <a href="{{ route('addemployee') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-plus" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Add Employee</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
