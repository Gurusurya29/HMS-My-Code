@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Purchase Order</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.purchase.purchaseorder.purchaseorderindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printpurchaseorder', purchaceorderid => {
            var url = "{{ url('/') }}" + "/pharmacy/pruchaseorder/purchaseorderprint/" + purchaceorderid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
