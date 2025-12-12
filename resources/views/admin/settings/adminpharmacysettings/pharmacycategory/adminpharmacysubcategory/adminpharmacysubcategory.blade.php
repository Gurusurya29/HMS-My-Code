@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminpharmacysettings') }}">Settings</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Product Sub Category</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Pharmacy-category')
        @livewire('pharmacy.settings.category.pharmacysubcategory.pharmacysubcategorylivewire')
    @endcan
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
