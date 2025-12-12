<div class="col-xl-4 mt-1 mb-1 fw-bold mx-auto">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a href="{{ route('pharmacy.purchaseindex') }}" id="purchaseindex"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'purchaseindex' ? 'active' : '' }}">
            Purchase Entry List
        </a>
        <a href="{{ route('pharmacy.pruchasecreate') }}" id="pruchasecreate"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'pruchasecreate' ? 'active' : '' }}">
            Purchase Entry
        </a>
    </nav>
</div>
