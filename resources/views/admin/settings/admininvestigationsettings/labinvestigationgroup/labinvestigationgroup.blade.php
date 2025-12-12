@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="SETTINGS" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('settings') }}">Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page">Investigation Group</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Investigation-group')
        @livewire('laboratory.settings.laboratorymaster.labinvestigationgroup.labinvestigationgrouplivewire')
    @endcan
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
