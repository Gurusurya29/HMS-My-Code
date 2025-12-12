@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.sales.salesreturn.salesreturnnav', [
        'name' => 'salesreturnindex',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Sales Return List</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.sales.salesreturn.salesreturnindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#salesdropdown').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printsalesreturn', salesreturnid => {
            var url = "{{ url('/') }}" + "/pharmacy/salesreturn/salesreturnprint/" + salesreturnid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
