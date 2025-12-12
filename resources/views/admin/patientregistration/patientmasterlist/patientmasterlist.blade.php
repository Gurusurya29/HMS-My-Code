@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="PATIENT REGISTRATION" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Patientmasterlist')
                @livewire('admin.patientregistration.patientmasterlist.patientmasterlistlivewire')
            @endcan
        </div>
    </div>
@endsection

@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientregistration-collapse',
        'nameone' => '#patientregistration_mainmenu',
        'nametwo' => '#patientmasterlist_sidenav',
    ])
    <script>
        Livewire.on('printlabel', patientid => {
            var url = "{{ url('/') }}" + "/admin/printlabel/" + patientid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
