<div class="col-xl-4 mt-1 mb-1 fw-bold mx-auto">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a href="{{ route('pharmacy.purchasereturnindex') }}" id="purchasereturnindex"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'purchasereturnindex' ? 'active' : '' }}">
            Purchase Return List
        </a>
        <a href="{{ route('pharmacy.purchasereturncreate') }}" id="purchasereturncreate"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'purchasereturncreate' ? 'active' : '' }}">
            Purchase Return
        </a>
    </nav>
</div>
