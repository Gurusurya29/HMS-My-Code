@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OUT PATIENT" />
@endsection

@section('main-content')
    <div class="card col-sm-10 mx-auto border-0">
        <div class="card-body bg-light p-0">

            @include('admin.wardmanagement.wardmanagementhelper.wardmanagementnavbarhelper', [
                'name' => 'wardhousekeeping',
            ])
            @can('Ward-housekeeping')
                @livewire('admin.wardmanagement.wardhousekeepinglivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    <script type="text/javascript">
        ivewire.on('bedorroomnumbermodalclose', () => {
            $('#myModal').modal('hide');
        });
    </script>
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#wardmanagement_sidenav',
    ])
@endsection
