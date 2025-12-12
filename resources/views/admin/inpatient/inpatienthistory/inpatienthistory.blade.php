@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IN PATIENT" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">

            <div class="col-sm-10 mx-auto mb-1">
                @include('admin.inpatient.inpatienthelper.inpatientnavbarhelper', [
                    'name' => 'inpatienthistory',
                ])
            </div>
            @can('Inpatient-history')
                @livewire('admin.inpatient.inpatienthistory.inpatienthistorylivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#inpatient_sidenav',
    ])
    <script>
        Livewire.on('printdischargesummary', inpatientid => {
            var url = "{{ url('/') }}" + "/admin/printdischargesummary/" + inpatientid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
