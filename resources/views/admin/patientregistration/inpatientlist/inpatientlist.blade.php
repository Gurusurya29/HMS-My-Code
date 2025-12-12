@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="PATIENT REGISTER" />
@endsection

@section('main-content')
    <div class="card col-sm-10 mx-auto border-0 mb-3">
        @include('admin.patientregistration.patientregistrationhelper.patientregistrationnavbarhelper', [
            'name' => 'inpatientlist',
        ])
    </div>
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Inpatientlist')
                @livewire('admin.patientregistration.inpatientlist.inpatientlistlivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientregistration-collapse',
        'nameone' => '#patientregistration_mainmenu',
        'nametwo' => '#patientregistration_sidenav',
    ])
@endsection
