@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="PATIENT REGISTRATION" />
@endsection

@section('main-content')
    <div class="card  border-0">
        <div class="card-body bg-light p-0">
            <div class="col-sm-10 mx-auto">
                @include('admin.patientregistration.patientregistrationhelper.patientregistrationnavbarhelper',
                    ['name' => 'patientregistration'])
            </div>
            @can('Patientvisitentry')
                @livewire('admin.patientregistration.patientvisit.patientvisitlivewire')
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
    @include('helper.modalhelper.livewiremodal')
@endsection
