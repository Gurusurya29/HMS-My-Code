@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="REPORTS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminreports') }}">Reports</a></li>
        <li class="breadcrumb-item active" aria-current="page">Discharged Patient Report</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Dischargedpatient-report')
        @livewire('admin.reports.inpatientreports.dischargedpatientreport.dischargedpatientreportlivewire')
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#report_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
