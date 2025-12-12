@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SETTINGS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('settings') }}">Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page">Phramacy Setting</li>
    </x-admin.layouts.adminbreadcrumb>


    @can('Pharmacy-master')
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PHARMACY SETTINGS</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('settings') }}" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @can('Pharmacy-category')
                    <h5>Category</h5>
                    <div class="pb-4 pt-2">
                        <div class="row g-3 row-cols-1 row-cols-md-2">
                            <div class="col-md-2">
                                <a href="{{ route('adminpharmacycategory') }}" class="text-decoration-none text-dark text-center">
                                    <div class="card shadow-sm">
                                        <i class="bi bi-tag" style="font-size: 2.4rem;"></i>
                                        <div class="card-footer">
                                            <div class="fw-b">Product Category</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ route('adminpharmacysubcategory') }}"
                                    class="text-decoration-none text-dark text-center">
                                    <div class="card shadow-sm">
                                        <i class="bi bi-tags" style="font-size: 2.4rem;"></i>
                                        <div class="card-footer">
                                            <div class="fw-b">Product Sub Category</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Pharmacy-drugmaster')
                    <h5>Drug Master</h5>
                    <div class="pb-4 pt-2">
                        <div class="row g-3 row-cols-1 row-cols-md-2">
                            <div class="col-md-2">
                                <a href="{{ route('adminpharmacygenaric') }}" class="text-decoration-none text-dark text-center">
                                    <div class="card shadow-sm">
                                        <i class="bi bi-chevron-bar-contract" style="font-size: 2.4rem;"></i>
                                        <div class="card-footer">
                                            <div class="fw-b">Generic Name</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('adminpharmacymanufacture') }}"
                                    class="text-decoration-none text-dark text-center">
                                    <div class="card shadow-sm">
                                        <i class="bi bi-building" style="font-size: 2.4rem;"></i>
                                        <div class="card-footer">
                                            <div class="fw-b">Manufacture Name</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Pharmacy-product')
                    <h5>Product</h5>
                    <div class="pb-4 pt-2">
                        <div class="row g-3 row-cols-1 row-cols-md-2">
                            <div class="col-md-2">
                                <a href="{{ route('adminpharmacyproduct') }}" class="text-decoration-none text-dark text-center">
                                    <div class="card shadow-sm">
                                        <i class="bi bi-box-seam" style="font-size: 2.4rem;"></i>
                                        <div class="card-footer">
                                            <div class="fw-b">Product</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#setting_sidenav',
    ])
@endsection
