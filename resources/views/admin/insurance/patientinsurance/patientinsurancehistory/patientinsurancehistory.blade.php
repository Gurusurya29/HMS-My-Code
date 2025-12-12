@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="INSURANCE HISTORY" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">

            <div class="col-sm-10 mx-auto mb-1">
                @include('admin.insurance.patientinsurance.patientinsurancehelper.patientinsurancenavbarhelper',
                    [
                        'name' => 'patientinsurancehistory',
                    ])
            </div>
            @can('Insurance-history')
                @livewire('admin.insurance.patientinsurance.patientinsurancehistory.patientinsurancehistorylivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#insurance_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
