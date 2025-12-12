@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IP NURSING STATION" />
@endsection

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('admin.inpatient.ipnursingstation.ipnursingstationhelper.ipnursingnavbarhelper', [
                'name' => 'ipnursingstationservice',
                'uuid' => $inpatient_uuid,
            ])
        </div>
        @can('Inpatient-nursingstation')
            <div class="col-md-12 my-3">
                <div class="card mx-auto">
                    <div class="card-header text-white theme_bg_color">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">IP SERVICES</span></div>
                            <div class="bd-highlight d-flex gap-1">
                                <a href="{{ route('inpatientqueue') }}" class="btn btn-sm btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                    @livewire('admin.inpatient.ipnursingstation.ipnursingstationservice.ipnursingstationservicelivewire', ['inpatient_uuid' => $inpatient_uuid])
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
    <script>
        Livewire.on('printipprescription', ipassessmentid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printipprescription/" + ipassessmentid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });
    </script>
    <script>
        Livewire.on('printipinvestigation', ipassessmentid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printipinvestigation/" + ipassessmentid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });
    </script>
    <script>
        Livewire.on('printipinvestigationresult', ipassessmentid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printipinvestigationresult/" + ipassessmentid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });
    </script>
    <script>
        Livewire.on('printassessment', ipassessmentid => {
            var url = "{{ url('/') }}" + "/admin/printassessment/" + ipassessmentid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
