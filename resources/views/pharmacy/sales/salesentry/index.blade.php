@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.sales.helper.salesnavheper', [
        'name' => 'salesentryindex',
    ])
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Sales List</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.sales.salesentry.salesentryindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#salesdropdown').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printsalesentry', salesentryid => {
            var url = "{{ url('/') }}" + "/pharmacy/salesentry/salesentryprint/" + salesentryid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
