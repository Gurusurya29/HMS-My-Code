@can('User')
    <h5>User</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('Add-user')
                <div class="col-md-2">
                    <a href="{{ route('usercreateoredit') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-people" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Add User </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('Change-password')
                <div class="col-md-2">
                    <a href="{{ route('userchangepassword') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-key" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">Change Password </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('User-role')
                <div class="col-md-2">
                    <a href="{{ route('userrole') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-person-badge" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b">User Role </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endcan
