@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.purchase.purchaseentry.entrynav', [
        'name' => 'purchaseindex',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Purchase</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.purchase.purchaseentry.purchaseentryindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printpurchaseentry', purchaseentryid => {
            var url = "{{ url('/') }}" + "/pharmacy/purchase/purchaseentryreceiptprint/" + purchaseentryid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
