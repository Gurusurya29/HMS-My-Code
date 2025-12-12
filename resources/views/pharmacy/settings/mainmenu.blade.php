@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-.pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            Settings
        </li>
    </x-.pharmacy.layouts.pharmacybreadcrumb>

    <div class="p-2">
        @include('pharmacy.settings.pharmacysetting.pharmbransettings')
        @include('pharmacy.settings.usersetting.usersettings')
        @include('pharmacy.settings.category.categorysettings')
        @include('pharmacy.settings.drugmaster.drugmastersetting')
        @include('pharmacy.settings.product.productsettings')
        @include('pharmacy.settings.supplier.suppliersettings')
    </div>
@endsection

@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
