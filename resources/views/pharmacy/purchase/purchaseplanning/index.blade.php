@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Purchase Planning</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.purchase.purchaseplanning.purchaseplanningindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
