<div class="col-xl-4 mt-1 mb-1 fw-bold mx-auto">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        {{-- <a href="{{ route('pharmacy.hmsprescriptionindex') }}" id="hmsprescriptionindex"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'hmsprescriptionindex' ? 'active' : '' }}">HMS
            Prescription</a> --}}
        <a href="{{ route('pharmacy.salesentrycreate') }}" id="salesentrycreate"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'salesentrycreate' ? 'active' : '' }}">Walk
            In Sales
            Entry</a>
        <a href="{{ route('pharmacy.salesentryindex') }}" id="salesentryindex"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'salesentryindex' ? 'active' : '' }}">Sales
            List</a>
    </nav>
</div>
