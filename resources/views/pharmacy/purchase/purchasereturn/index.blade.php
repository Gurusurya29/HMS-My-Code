@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.purchase.purchasereturn.returnnav', [
        'name' => 'purchasereturnindex',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Purchase Return</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.purchase.purchasereturn.purchasereturnindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printpurchasereturn', purchacereturnid => {
            var url = "{{ url('/') }}" + "/pharmacy/purchasereturn/purchasereturnprint/" + purchacereturnid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
