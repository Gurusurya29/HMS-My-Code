@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="INSURANCE" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">

            <div class="col-sm-10 mx-auto mb-1">
                @include('admin.insurance.patientinsurance.patientinsurancehelper.patientinsurancenavbarhelper',
                    [
                        'name' => 'patientinsurancelist',
                    ])
            </div>
            @can('Insurance-list')
                @livewire('admin.insurance.patientinsurance.patientinsurancelist.patientinsurancelistlivewire')
            @endcan

        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#insurance_sidenav',
    ])
@endsection
