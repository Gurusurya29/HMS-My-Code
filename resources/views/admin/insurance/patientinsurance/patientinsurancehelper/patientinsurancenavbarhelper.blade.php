<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('Insurance-list')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientinsurancelist' ? 'active' : '' }}"
            aria-current="page" href="{{ route('patientinsurancelist') }}">Insurance</a>
    @endcan
    @can('Insurance-history')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientinsurancehistory' ? 'active' : '' }}"
            href="{{ route('patientinsurancehistory') }}">Insurance History</a>
    @endcan
</nav>
