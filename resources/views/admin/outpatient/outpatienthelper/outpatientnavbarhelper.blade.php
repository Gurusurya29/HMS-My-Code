<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('Outpatient-list')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'outpatientqueue' ? 'active' : '' }}"
            aria-current="page" href="{{ route('outpatientqueue') }}">Out Patient List</a>
    @endcan
    @can('Outpatient-visitentry')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'outpatientvisitentry' ? 'active' : '' }}"
            href="{{ route('outpatientvisitentry') }}">New Patient / Visit Entry</a>
    @endcan
    @can('Outpatient-history')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'outpatienthistory' ? 'active' : '' }}"
            href="{{ route('outpatienthistory') }}">Out Patient History</a>
    @endcan
</nav>
