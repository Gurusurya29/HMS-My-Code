<div class="col-xl-4 mt-4 fw-bold mx-auto">
    <nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
        <a href="{{ route('adminlogin') }}" id="adminloginpage"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'admin' ? 'active' : '' }}">Hospital</a>
        <a href="{{ route('pharmacylogin') }}" id="pharmacyloginpage"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'pharmacy' ? 'active' : '' }}">Pharmacy</a>
        <a href="{{ route('laboratorylogin') }}" id="laboratorymenu"
            class="mainnav flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'laboratory' ? 'active' : '' }}">Investigation</a>
    </nav>
</div>
