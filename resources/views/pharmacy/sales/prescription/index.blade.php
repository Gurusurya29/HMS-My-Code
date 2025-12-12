@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">HMS Prescription List</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.sales.prescription.prescriptionindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#salesdropdown').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
