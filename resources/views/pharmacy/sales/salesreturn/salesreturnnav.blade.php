<div class="col-xl-4 mt-1 mb-1 fw-bold mx-auto">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a href="{{ route('pharmacy.salesreturnindex') }}" id="salesreturnindex"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'salesreturnindex' ? 'active' : '' }}">
            Sales Return List
        </a>
        <a href="{{ route('pharmacy.salesreturncreate') }}" id="salesreturncreate"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'salesreturncreate' ? 'active' : '' }}">
            Sales Return
        </a>
    </nav>
</div>
