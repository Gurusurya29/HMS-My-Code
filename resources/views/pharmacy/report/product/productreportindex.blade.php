@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacy.reportindex') }}">Report</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Product Report</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>
    @livewire('pharmacy.report.product.productreportindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#report').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
