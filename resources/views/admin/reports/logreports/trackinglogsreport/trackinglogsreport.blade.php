@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="REPORTS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminreports') }}">Reports</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tracking Logs Report</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Trackinglogs-report')
        @livewire('admin.reports.logreports.trackinglogsreport.trackinglogsreportlivewire')
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#report_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
