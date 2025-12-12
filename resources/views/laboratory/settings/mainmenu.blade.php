@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <x-.laboratory.layouts.laboratorybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            Settings
        </li>
    </x-.laboratory.layouts.laboratorybreadcrumb>

    <div class="p-2">
        @include('laboratory.settings.usersetting.usersettings')
        @include('laboratory.settings.laboratorymaster.labmastersetting')
    </div>
@endsection

@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
