@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IP ASEESMENT LIST" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @livewire('admin.inpatient.ipassesmentlist.ipassesmentlistlivewire', compact('uuid'))
        </div>
    </div>
@endsection
@section('footerSection')
    {{-- @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#inpatient_sidenav',
    ])
    <script>
        Livewire.on('printdischargesummary', inpatientid => {
            var url = "{{ url('/') }}" + "/admin/printdischargesummary/" + inpatientid;
            window.open(url);
        });
    </script> --}}
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
    @include('helper.modalhelper.livewiremodal')
@endsection
