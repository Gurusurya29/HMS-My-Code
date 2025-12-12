@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OUT PATIENT" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            <div class="table-responsive-sm">
                @can('Outpatient-assesment')
                    @livewire('admin.outpatient.opassessment.opassessmentgeneral.opassessmentgenerallivewire', ['outpatient' => $outpatient, 'requesttype' => $requesttype])
                @endcan
            </div>
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#outpatient_sidenav',
    ])
    <script>
        window.livewire.on('openconfirmmovetoip', () => {
            var myModal = new bootstrap.Modal(document.getElementById('confirmmovetoipModal'))
            myModal.show();
        });
        window.livewire.on('closeconfirmmovemodal', () => {
            $('#confirmmovetoipModal').modal('hide');
        });
    </script>
@endsection
