@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OPERATION THEATRE" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @if (auth()->user()->can('OT-New_Surgery') ||
                auth()->user()->can('OT-Surgerydetails'))
                @livewire('admin.operationtheatre.otschedule.otschedulelivewire', ['otschedule_uuid' => $otschedule_uuid])
            @endif
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
        $(function() {
            window.livewire.on('datealert', () => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'The Date & time has been already blocked, please choose another Date & time.',
                })
            });
        });
    </script>
@endsection
