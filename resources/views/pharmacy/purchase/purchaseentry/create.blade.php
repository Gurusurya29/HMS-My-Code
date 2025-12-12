@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.purchase.purchaseentry.entrynav', [
        'name' => 'pruchasecreate',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacy.purchaseindex') }}">Purchase</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Add/Edit</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Purchase Entry</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('pharmacy.purchaseindex') }}"
                            class="btn btn-sm btn-warning shadow float-end mx-1">
                            Purchase Entry List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @livewire('pharmacy.purchase.purchaseentry.purchaseentrycreatelivewire')
    </div>
@endsection
@section('footerSection')
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
    <script type="text/javascript">
        window.livewire.on('supplierselected', () => {
            document.getElementById("po").focus();
        });
    </script>
@endsection
