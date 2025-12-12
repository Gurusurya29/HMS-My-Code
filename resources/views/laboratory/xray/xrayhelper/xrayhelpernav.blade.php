<nav class="nav nav-pills flex-column flex-sm-row shadow rounded-pill bg-white mt-0 pt-0 mb-2">
    {{-- <a href="{{ route('xrayhomepage') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'xrayhomepage' ? 'active' : '' }}">Laboratory
        Homepage</a> --}}
    <a href="{{ route('xraypatientlist') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientlist' ? 'active' : '' }}">Patient
        List</a>
    <a href="{{ route('xraypatientwalkin') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'walkin' ? 'active' : '' }}">Walk
        in</a>
    <a href="{{ route('xraypatienthistory') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'history' ? 'active' : '' }}">Patient
        History</a>
</nav>
