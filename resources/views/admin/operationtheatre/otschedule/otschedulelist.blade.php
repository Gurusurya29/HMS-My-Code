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
                    'name' => 'otschedulelist',
                ])
            </div>
            @can('OT-Schedule')
                @livewire('admin.operationtheatre.otschedule.otschedulelistlivewire')
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
    <script>
        window.livewire.on('movetoip', () => {
            var myModal = new bootstrap.Modal(document.getElementById('movetoipModal'))
            myModal.show();
        });
        var movetoipModal = document.getElementById('movetoipModal')
        movetoipModal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch('formreset'))
        window.livewire.on('movetoipclosemodal', () => {
            $('#movetoipModal').modal('hide');
        });
    </script>
@endsection
