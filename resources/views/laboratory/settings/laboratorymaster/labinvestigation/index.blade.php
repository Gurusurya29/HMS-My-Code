@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <x-laboratory.layouts.laboratorybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('laboratorysettings') }}">Settings</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Investigation</li>
    </x-laboratory.layouts.laboratorybreadcrumb>

    @livewire('laboratory.settings.laboratorymaster.labinvestigation.labinvestigationlivewire')
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
