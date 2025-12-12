<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('Inpatient-list')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'inpatientqueue' ? 'active' : '' }}"
            aria-current="page" href="{{ route('inpatientqueue') }}">In Patient Queue List</a>
    @endcan
    @can('Inpatient-visitentry')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'inpatientvisitentry' ? 'active' : '' }}"
            href="{{ route('inpatientvisitentry') }}">New Patient / Visit Entry</a>
    @endcan
    @can('Inpatient-history')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'inpatienthistory' ? 'active' : '' }}"
            href="{{ route('inpatienthistory') }}">In Patient History</a>
    @endcan
</nav>
