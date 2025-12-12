@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminpharmacysettings') }}">Settings</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Generic Name</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Pharmacy-drugmaster')
        @livewire('pharmacy.settings.drugmaster.pharmacygenaric.pharmacygenariclivewire')
    @endcan
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
