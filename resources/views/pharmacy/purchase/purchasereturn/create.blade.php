@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.purchase.purchasereturn.returnnav', [
        'name' => 'purchasereturncreate',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none"
                href="{{ route('pharmacy.purchasereturnindex') }}">Purchase Return</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add/Edit</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Purchase Return</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('pharmacy.purchasereturnindex') }}"
                            class="btn btn-sm btn-warning shadow float-end mx-1">
                            Purchase Return List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @livewire('pharmacy.purchase.purchasereturn.purchasereturncreatelivewire')
    </div>
@endsection
@section('footerSection')
    <script type="text/javascript">
        window.livewire.on('productselected', () => {
            document.getElementById("batch").focus();
        });
        window.livewire.on('focusreturn_q', () => {
            document.getElementById("return_quantity").focus();
            window.scrollTo(0, document.body.scrollHeight);
        });
        window.livewire.on('supplierselected', () => {
            focusproduct();
        });
        window.livewire.on('cleanupfields', () => {
            focusproduct();
        });

        function focusproduct() {
            document.getElementById("product").focus();
        }
    </script>
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
