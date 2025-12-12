@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="FACILITY" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('facility') }}">Facility</a></li>
        <li class="breadcrumb-item active" aria-current="page">Facility Details</li>
    </x-admin.layouts.adminbreadcrumb>

    @can('Facility')
        @livewire('admin.facility.facilitymaster.facilitylivewire')
    @endcan
@endsection


@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#facility_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
