@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="WARD AVAILABILTY" />
@endsection

@section('main-content')
    <div class="card col-sm-10 mx-auto border-0">
        <div class="card-body bg-light p-0">

            @include('admin.wardmanagement.wardmanagementhelper.wardmanagementnavbarhelper', [
                'name' => 'wardavailability',
            ])
            @can('Ward-availability')
                @livewire('admin.wardmanagement.wardavailabilitylivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#wardmanagement_sidenav',
    ])
@endsection
