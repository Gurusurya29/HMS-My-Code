@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="EMPLOYEE" />
@endsection

@section('main-content')
    @can('Employee')
        @livewire('admin.employee.addemployee.addemployeelivewire')
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#hr_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
