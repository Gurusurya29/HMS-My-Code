@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacy.purchaseplanning') }}">Purchase
                Planning</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add/Edit</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Purchase Planning</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        @livewire('pharmacy.common.requestproduct.requestedproductlivewire')
                        <a href="{{ route('pharmacy.purchaseplanning') }}"
                            class="btn btn-sm btn-primary shadow float-end mx-1">
                            Purchase Plan List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-pills mb-3 mt-3 d-flex justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">Pruchase Products</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold active" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">Purchase Planning</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold" id="pills-list-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-list" type="button" role="tab" aria-controls="pills-list"
                    aria-selected="false">Purchase Plan List</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('pharmacy.purchase.purchaseplanning.productlist')
            </div>
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @livewire('pharmacy.purchase.purchaseplanning.purchaseplanningcreateoreditlivewire', ['purchaseplanninguuid' => $purchaseplanninguuid])
            </div>
            <div class="tab-pane fade" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                @livewire('pharmacy.purchase.purchaseplanning.purchaseplanningindexlivewire')
            </div>
        </div>
    </div>
@endsection
@section('footerSection')
    <script>
        $('#purchasedropdown').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
    <script type="text/javascript">
        window.livewire.on('requested_product_created', () => {
            window.scrollTo(0, document.body.scrollHeight);
        });
    </script>
@endsection
