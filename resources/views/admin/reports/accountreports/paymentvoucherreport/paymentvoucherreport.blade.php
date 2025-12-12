@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="REPORTS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminreports') }}">Reports</a></li>
        <li class="breadcrumb-item active" aria-current="page">Payment Voucher Report</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Paymentvoucher-report')
        @livewire('admin.reports.accountreports.paymentvoucherreport.paymentvoucherreportlivewire')
    @endcan
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#report_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
