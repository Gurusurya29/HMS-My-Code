@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SETTINGS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('settings') }}">Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page">General Settings</li>
    </x-admin.layouts.adminbreadcrumb>

    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">GENERAL SETTINGS</span>
                </div>
                <div class="bd-highlight">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body row g-3 mb-5">
            <div class="container">
                @can('General')
                    @livewire('admin.settings.generalsetting.generalsetting.generalsettinglivewire')
                @endcan
            </div>





        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#setting_sidenav',
    ])
@endsection
