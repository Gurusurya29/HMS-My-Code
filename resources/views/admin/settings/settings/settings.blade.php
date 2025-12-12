@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SETTINGS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            Settings
        </li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Settings')
        <div class="p-2">
            @include('admin.settings.settings.patientregistersettings')
            @include('admin.settings.settings.patientvisitsettings')
            @include('admin.settings.settings.opsettings')
            @include('admin.settings.settings.ipsettings')
            @include('admin.settings.settings.doctorsettings')
            @include('admin.settings.settings.wardsettings')
            {{-- @include('admin.settings.settings.documentsettings') --}}
            {{-- @include('admin.settings.settings.mastersettings') --}}
            @include('admin.settings.settings.suppliersettings')
            {{-- @include('admin.settings.settings.insurancesettings')
        @include('admin.settings.settings.referencesettings') --}}


            @include('admin.settings.settings.investigationsettings')
            @include('admin.settings.settings.pharmacysettings')
            @include('admin.settings.settings.usersettings')
            @include('admin.settings.settings.addemployeesettings')
            @include('admin.settings.settings.generalsettings')
            @include('admin.settings.settings.trackingsettings')

        </div>
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#setting_sidenav',
    ])
@endsection
