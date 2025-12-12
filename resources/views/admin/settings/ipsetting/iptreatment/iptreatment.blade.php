@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SETTINGS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('settings') }}">Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page">IP Treatment</li>
    </x-admin.layouts.adminbreadcrumb>

    @can('IP-treatment')
        @livewire('admin.settings.ipsetting.iptreatment.iptreatmentlivewire')
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#setting_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
