<nav class="nav nav-pills flex-column flex-sm-row shadow rounded-pill bg-white mt-0 pt-0 mb-2">
    {{-- <a href="{{ route('scanhomepage') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'scanhomepage' ? 'active' : '' }}">Laboratory
        Homepage</a> --}}
    <a href="{{ route('scanpatientlist') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientlist' ? 'active' : '' }}">Patient
        List</a>
    <a href="{{ route('scanpatientwalkin') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'walkin' ? 'active' : '' }}">Walk
        in</a>
    <a href="{{ route('scanpatienthistory') }}"
        class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'history' ? 'active' : '' }}">Patient
        History</a>
</nav>
