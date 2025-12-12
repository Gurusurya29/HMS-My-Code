@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IP DISCHARGE" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Inpatient-discharge')
                @livewire('admin.inpatient.inpatientdischarge.ipdiabetologydischarge.ipdiabetologydischargelivewire', ['inpatient_uuid' => $inpatient_uuid])
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
@endsection
