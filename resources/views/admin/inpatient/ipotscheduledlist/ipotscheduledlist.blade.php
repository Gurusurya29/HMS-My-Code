@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OT SCHEDULED LIST" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @livewire('admin.inpatient.ipotscheduledlist.ipotscheduledlistlivewire', compact('uuid'))
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.modalhelper.livewiremodal')
@endsection
