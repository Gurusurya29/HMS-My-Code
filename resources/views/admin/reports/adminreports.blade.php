@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="REPORT" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            Reports
        </li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Reports')
        <div class="p-2">
            @can('Patient Report-Menu')
                @include('admin.reports.patientreport')
            @endcan
            @can('Outpatient Report-Menu')
                @include('admin.reports.outpatientreport')
            @endcan
            @can('Inpatient Report-Menu')
                @include('admin.reports.inpatientreport')
            @endcan
            @can('Billing Report-Menu')
                @include('admin.reports.billingreport')
            @endcan
            @can('Finance Report-Menu')
                @include('admin.reports.accountreport')
            @endcan
            @can('Facility Report-Menu')
                @include('admin.reports.facilityreport')
            @endcan
            @can('Log Report-Menu')
                @include('admin.reports.logreport')
            @endcan
        </div>
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#report_sidenav',
    ])
@endsection
