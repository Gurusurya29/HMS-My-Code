@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OPERATION THEATRE" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">

            <div class="col-sm-6 mx-auto mb-1">
                @include('admin.operationtheatre.operationtheatrehelper.otnavbarhelper', [
                    'name' => 'othistory',
                ])
            </div>
            @can('OT-history')
                @livewire('admin.operationtheatre.othistory.othistorylivewire')
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
