@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OT PRE-OP NOTES" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('OT-Surgerynotes')
                @livewire('admin.operationtheatre.otschedule.otpostopnoteslivewire', ['otschedule_uuid' => $otschedule_uuid])
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#ot_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
