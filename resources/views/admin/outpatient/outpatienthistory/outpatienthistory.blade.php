@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OUT PATIENT" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0 m-0 p-0">
        <div class="card-body bg-light p-0">

            <div class="col-sm-10 mx-auto mb-1">
                @include('admin.outpatient.outpatienthelper.outpatientnavbarhelper', [
                    'name' => 'outpatienthistory',
                ])
            </div>
            @can('Outpatient-history')
                @livewire('admin.outpatient.outpatienthistory.outpatienthistorylivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#outpatient_sidenav',
    ])
    <script>
        Livewire.on('printprescription', outpatientid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printprescription/" + outpatientid;
            window.open(url);
        });
    </script>
    <script>
        Livewire.on('opprintinvestigation', outpatientid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/opprintinvestigation/" + outpatientid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });

        Livewire.on('opprintinvestigationresult', outpatientid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/opprintinvestigationresult/" + outpatientid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });

        Livewire.on('printassessment', outpatientid => {
            var url = "{{ url('/') }}" + "/admin/printassessment/" + outpatientid;
            window.open(url);
        });

        window.livewire.on('closeshowmodal', () => {
            $('#showModal').modal('hide');
        });
    </script>

    @include('helper.modalhelper.livewiremodal')
@endsection
