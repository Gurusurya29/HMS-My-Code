@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminpharmacysettings') }}">Settings</a>
        </li>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('adminpharmacyproduct') }}">Product</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Alternative Product</li>
    </x-admin.layouts.adminbreadcrumb>
    @can('Pharmacy-product')
        @livewire('pharmacy.settings.product.pharmacyproduct.alternativepharmacyproductlivewire', ['productid' => $productid])
    @endcan
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
