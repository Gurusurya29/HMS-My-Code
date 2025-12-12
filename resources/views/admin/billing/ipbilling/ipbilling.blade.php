@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IN PATIENT BILLING" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('IP-Billing')
                @livewire('admin.billing.ipbilling.ipbillinglivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientbilling-collapse',
        'nameone' => '#patientbilling_mainmenu',
        'nametwo' => '#inpatientbilling_sidenav',
    ])
@endsection
