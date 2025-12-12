<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('IP-services')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'ipnursingstationservice' ? 'active' : '' }}"
            aria-current="page" href="{{ route('ipnursingstationservice', $uuid) }}">IP Services</a>
    @endcan
    @can('IP-assesment')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'ipassesment' ? 'active' : '' }}"
            href="{{ route('ipassesment', $uuid) }}">IP Assesment</a>
    @endcan
    @can('IP-patienttransfer')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'ippatienttransfer' ? 'active' : '' }}"
            href="{{ route('ippatienttransfer', $uuid) }}">Patient Transfer</a>
    @endcan
    @can('IP-otschedule')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'ipscheduleotlist' ? 'active' : '' }}"
            href="{{ route('ipscheduleotlist', $uuid) }}">OT Schedule</a>
    @endcan
</nav>
