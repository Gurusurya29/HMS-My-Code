@can('Investigation')
    <h5>Investigation Settings</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Investigation-name')
                <div class="col-md-2">
                    <a href="{{ route('adminlabinvestigation') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-file-ruled" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Investigation Name</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Investigation-group')
                <div class="col-md-2">
                    <a href="{{ route('adminlabinvestigationgroup') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-chevron-bar-contract" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Investigation Group</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Unit')
                <div class="col-md-2">
                    <a href="{{ route('adminlabunit') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-rulers" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Unit</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Test-method')
                <div class="col-md-2">
                    <a href="{{ route('adminlabtestmethod') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-list-columns" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Test Method</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
