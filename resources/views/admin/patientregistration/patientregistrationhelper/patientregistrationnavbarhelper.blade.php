<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('Patientvisitentry')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientregistration' ? 'active' : '' }}"
            aria-current="page" href="{{ route('patientregistration') }}">Patient
            Visit Entry</a>
    @endcan
    {{-- <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patienttodayvisit' ? 'active' : '' }}"
        href="{{ route('patienttodayvisit') }}">Today
        Patient List</a> --}}
    {{-- <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientlist' ? 'active' : '' }}"
        href="{{ route('patientlist') }}">Patient List</a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientappointment' ? 'active' : '' }}"
        href="{{ route('patientappointment') }}">Appointment</a> --}}
    @can('Patientvisithistory')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'patientvisithistory' ? 'active' : '' }}"
            href="{{ route('patientvisithistory') }}">Patient
            Visit History </a>
    @endcan
    @can('Inpatientlist')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'inpatientlist' ? 'active' : '' }}"
            href="{{ route('inpatientlist') }}">In Patient
            List</a>
    @endcan
</nav>
