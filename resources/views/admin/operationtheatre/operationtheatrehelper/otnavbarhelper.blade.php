<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('OT-Calendar')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'otcalendar' ? 'active' : '' }}"
            aria-current="page" href="{{ route('otcalendar') }}">OT Calendar</a>
    @endcan
    @can('OT-Schedule')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'otschedulelist' ? 'active' : '' }}"
            aria-current="page" href="{{ route('otschedulelist') }}">OT Schedule</a>
    @endcan
    @can('OT-history')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'othistory' ? 'active' : '' }}"
            aria-current="page" href="{{ route('othistory') }}">OT History</a>
    @endcan
</nav>
