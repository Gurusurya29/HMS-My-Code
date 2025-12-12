@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SCHEDULE OT" />
@endsection

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('admin.inpatient.ipnursingstation.ipnursingstationhelper.ipnursingnavbarhelper', [
                'name' => 'ipscheduleotlist',
                'uuid' => $inpatient_uuid,
            ])
        </div>
        @can('IP-otschedule')
            <div class="col-md-12 my-3">

                <div class="card mx-auto">
                    <div class="card-header text-white theme_bg_color">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">OT SCHEDULE</span></div>
                            <div class="bd-highlight d-flex gap-1">
                                <a href="{{ route('inpatientqueue') }}" class="btn btn-sm btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                    @livewire('admin.inpatient.ipnursingstation.ipscheduleot.ipscheduleotlistlivewire', ['inpatient_uuid' => $inpatient_uuid])
                </div>
            </div>
        @endcan
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#inpatient_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
@endsection
