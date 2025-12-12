@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="INSURANCE" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Insurance-process')
                @livewire('Admin.Insurance.Patientinsurance.atientinsurancecreate.Patientinsurancelivewire', compact('patientinsurance_uuid', 'type'))
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
