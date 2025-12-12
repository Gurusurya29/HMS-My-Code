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
                'name' => 'wardtypemanagement',
            ])
            @include('admin.wardmanagement.wardmanagementhelper.roomlegendhelper')
            @can('Ward-typestatus')
                @livewire('admin.wardmanagement.wardtypemanagementlivewire')
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
