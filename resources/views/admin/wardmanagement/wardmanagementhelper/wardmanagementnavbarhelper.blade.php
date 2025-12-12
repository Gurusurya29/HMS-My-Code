<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('Ward-availability')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'wardavailability' ? 'active' : '' }}"
            href="{{ route('wardavailability') }}">Ward Availability</a>
    @endcan
    @can('Ward-typestatus')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'wardtypemanagement' ? 'active' : '' }}"
            aria-current="page" href="{{ route('wardtypemanagement') }}">Ward Type Status</a>
    @endcan
    @can('Ward-floorstatus')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'wardfloormanagement' ? 'active' : '' }}"
            href="{{ route('wardfloormanagement') }}">Ward Floor Status</a>
    @endcan
    @can('Ward-housekeeping')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'wardhousekeeping' ? 'active' : '' }}"
            href="{{ route('wardhousekeeping') }}">House Keeping</a>
    @endcan
    @can('Ward-blockbed')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'wardroomblocked' ? 'active' : '' }}"
            href="{{ route('wardroomblocked') }}">Block Bed/Room</a>
    @endcan
</nav>
