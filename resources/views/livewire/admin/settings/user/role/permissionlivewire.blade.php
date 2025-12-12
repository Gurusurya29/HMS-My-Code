<div class="card">
    <div class="card-header text-white theme_bg_color">
        PERMISSION
        <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('userrole') }}" role="button">Back</a>
    </div>
    <div class="card-body">

        <div class="col-md-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="permission" wire:model="selectallstatus">
                <label class="form-check-label" for="permission">
                    Select All
                </label>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white theme_bg_color">
                SIDE NAV
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'side_nav')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                REGISTRATION
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'registration_subnav')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'newpatientregistration_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'patientvisithistory')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'patientmasterlist')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                BILLING
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'billing_subnav')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'opbilling')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'ipbilling')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'otbilling')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'receipt_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'billdiscount_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                PAYMENT VOUCHER
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'paymentvoucher_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                INSURANCE
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'insurance_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                OUT PATIENT
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'outpatient_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'outpatient_list')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'outpatient_history')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                IN PATIENT
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'inpatient_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'inpatient_list')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'inpatient_nursingstation')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'inpatient_history')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                OPERATION THEATRE
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'operationtheatre_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'ot_schedule')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'ot_history')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                WARD MANAGEMENT
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'wardmanagement_tab')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                FACILITY
            </div>
            <div class="card-body">
                @foreach ($permission->where('permissionsheading', 'facility')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                REPORTS
            </div>
            <div class="card-body">
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Reports
                        Main Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'reports_menu')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <hr>
                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Patient Reports Menu:</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'patient_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Out Patient Report Menu :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'outpatient_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">In Patient Report Menu :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'inpatient_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Billing Report Menu :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'billing_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Finance Report Menu :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'finance_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>
                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Facility Report Menu :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'facility_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>
                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Log Report Menu :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'log_report_menu')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header text-white theme_bg_color">
                SETTINGS
            </div>
            <div class="card-body">
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Settings
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_menu')->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <hr>
                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Patient-Registration :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_patientreg')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Patient-Visit :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_patientvisit')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Out
                        Patient :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_outpatient')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">In
                        Patient :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_inpatient')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Doctor :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_doctor')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Ward :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_ward')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Supplier :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_supplier')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Investigation :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_investigation')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Pharmacy :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_pharmacy')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">User :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_user')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Employee :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_employee')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">General :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_general')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>

                <dl class="row mb-1">
                    <dt class="col-md-3 fw-bold text-uppercase">Logs :</dt>
                    <dd class="col-md-9">
                        @foreach ($permission->where('permissionsheading', 'settings_logs')->chunk(4) as $chunk)
                            <div class="row g-2">
                                @foreach ($chunk as $value)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permission{{ $value->id }}"
                                                wire:click="markpermission({{ $value->id }})"
                                                {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </dd>
                </dl>
                <hr>
                <div class="card-title fw-bold fs-5"><span
                        class="border-bottom border-dark border-1">Patient-Registration
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_patientreg_referance')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Referance</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'settings_patientreg_country')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Country</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'settings_patientreg_state')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            State</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Patient-Visit
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_patientvisit_allergy')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Allergy</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'settings_patientvisit_currentcomplaints')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">Current Complaints</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($permission->where('permissionsheading', 'settings_patientvisit_insurancecompany')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">Insurance Company</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Out-Patient
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_outpatient_diagnosis')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Diagnosis</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_outpatient_physicalandgeneral')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Physical & General Examination</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_outpatient_opbillingservices')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            OP Billing Services</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">In-Patient
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_inpatient_iptreatment')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            IP Treatment</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_inpatient_ipservicecategory')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            IP Service Category</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_inpatient_ipbillingservices')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            IP Billing Services</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Doctor
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_doctor_adddoctor')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Add Doctor</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Ward
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_ward_wardtype')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Ward Type</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_ward_wardfloor/block')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Ward Floor/Block</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_ward_bed/roomnumber')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Bed Or Room Number</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Supplier
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_supplier_addsupplier')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Supplier</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Phramacy
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_pharmacymaster')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Phramacy Master</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">User
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_user_adduser')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Add User</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @foreach ($permission->where('permissionsheading', 'settings_user_userrole')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            User Role</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <br>
                <div class="card-title fw-bold fs-5"><span class="border-bottom border-dark border-1">Employee
                        Menu</span>
                </div>
                @foreach ($permission->where('permissionsheading', 'settings_employee_addemployee')->chunk(4) as $chunk)
                    <div class="row">
                        <div class="col-md-3 fw-bold text-uppercase">
                            Add Employee</div>
                        @foreach ($chunk as $value)
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                        id="permission{{ $value->id }}"
                                        wire:click="markpermission({{ $value->id }})"
                                        {{ $role->hasPermissionTo($value->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
