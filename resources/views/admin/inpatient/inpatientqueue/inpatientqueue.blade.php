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
                    'name' => 'inpatientqueue',
                ])
            </div>
            @can('Inpatient-list')
                @livewire('admin.inpatient.inpatientqueue.inpatientqueuelivewire')
            @endcan

        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#inpatient_sidenav',
    ])

    <script type="text/javascript">
        window.livewire.on('initiatedischarge', () => {
            var myModal = new bootstrap.Modal(document.getElementById('initiatedischargeModal'))
            myModal.show();
        });
        var myModal = document.getElementById('initiatedischargeModal')
        myModal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch('formreset'))
    </script>

    <script>
        Livewire.on('printipbarcode', inpatientid => {
            var url = "{{ url('/') }}" + "/admin/printipbarcode/" + inpatientid;
            window.open(url);
        });
    </script>
@endsection
