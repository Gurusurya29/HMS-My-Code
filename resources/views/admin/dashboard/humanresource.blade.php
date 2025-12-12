@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="HUMAN RESOURCE" />
@endsection

@section('main-content')
    @can('Humanresource')
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
