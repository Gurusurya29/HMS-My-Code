@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-.pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            Reports
        </li>
    </x-.pharmacy.layouts.pharmacybreadcrumb>

    <div class="p-2">
        @include('pharmacy.report.purchase.main')
        @include('pharmacy.report.sale.main')
        @include('pharmacy.report.product.main')
        @include('pharmacy.report.receipt.main')
        @include('pharmacy.report.paymentvoucher.main')
    </div>
@endsection

@section('footerSection')
    <script>
        $('#report').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
