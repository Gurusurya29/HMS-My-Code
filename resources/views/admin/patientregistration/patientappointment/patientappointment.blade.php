@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="PATIENT REGISTER" />
@endsection

@section('main-content')
    <div class="card col-sm-10 mx-auto border-0">
        <div class="card-body bg-light p-0">


            @include(
                'admin.patientregistration.patientregistrationhelper.patientregistrationnavbarhelper',
                ['name' => 'patientappointment']
            )


        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#patientregistration_sidenav',
    ])
@endsection
