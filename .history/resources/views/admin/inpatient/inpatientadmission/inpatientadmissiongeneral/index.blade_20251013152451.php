@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IN PATIENT" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            <div class="table-responsive-sm">
                @can('Inpatient-admission')
                    @livewire('admin.npatient.inpatientadmission.inpatientadmissiongeneral.inpatientadmissiongenerallivewire', ['inpatient_uuid' => $inpatient_uuid])
                @endcan
            </div>
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#inpatient_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
