<nav class="navbar navbar-expand-lg navbar-light p-0 theme_bg_color">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pharmacytopmenu"
            aria-controls="pharmacytopmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="pharmacytopmenu">
            {{-- @livewire('pharmacy.common.selectpharmacy.selectpharmacylivewire') --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto gap-4">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="homenav"
                        href="{{ route('pharmacydashboard') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="salesdropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sales
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="salesdropdown">
                        <li><a class="dropdown-item" href="{{ route('pharmacy.salesentrycreate') }}">Sales
                                Entry</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('pharmacy.salesreturncreate') }}">Sales
                                Return</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('pharmacy.hmsprescriptionindex') }}">HMS
                                Prescription</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="purchasedropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Purchase
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="purchasedropdown">
                        <li><a class="dropdown-item"
                                href="{{ route('pharmacy.pruchaseplanningcreateoredit') }}">Purchase
                                Planning</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('pharmacy.purchaseorder') }}">Purchase
                                Order</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('pharmacy.pruchasecreate') }}">Purchase
                                Entry</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('pharmacy.purchasereturncreate') }}">Purchase
                                Return</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="paymentvoucher"
                        href="{{ route('pharmacy.pharmacypaymentvoucherhistory') }}">Payment Voucher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="receiptentry"
                        href="{{ route('pharmacy.pharmacyreceipt') }}">Receipt Entry</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="report"
                        href="{{ route('pharmacy.reportindex') }}">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="settingnav"
                        href="{{ route('pharmacysettings') }}">Settings</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <div class="px-2 mt-1 text-white"><i class="bi bi-person-circle"></i>
                    {{ auth()->guard('pharmacy')->user()->name }}</div>
                <a class="btn btn-sm btn-warning" href="{{ route('postpharmacylogout') }}" type="submit">Logout</a>
            </div>
        </div>
    </div>
</nav>
