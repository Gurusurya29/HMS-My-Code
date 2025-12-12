@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="BILL DISOCUNT/CANCEL" />
@endsection

@section('main-content')
    <div class="card  border-0">
        <div class="card-body bg-light p-0">
            <div class="col-md-6 mx-auto">
                @include('admin.billing.billdiscount.billdiscounthelper.billdiscountnavbarhelper', [
                    'name' => 'billdiscount',
                ])
            </div>
            @can('Bill discount-entry')
                @livewire('admin.billing.billdiscount.billdiscountentry.billdiscountlivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientbilling-collapse',
        'nameone' => '#patientbilling_mainmenu',
        'nametwo' => '#billdiscount_sidenav',
    ])
@endsection
