<aside class="text-white shadow-lg rounded" id="sidebar-wrapper">
    <div class="sidebar-brand">
        <div class="d-flex mt-md-0" style="height: 48px;">
            <span class="fs-5 ms-2 fw-bold fst-italic text-white">
                <i class="bi bi-hospital" style="font-size: 2rem; color: white;"></i>

            </span>
            <span class="fs-4 mt-2 ms-3 fw-bold text-white">
                HMS
            </span>
        </div>
    </div>
    <ul class="sidebar-nav">

        @can('Dashboard')
            <li>
                <a href="{{ route('admindashboard') }}" id="dashboard_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-speedometer me-4 fs-5"></i>Dashboard
                </a>
            </li>
        @endcan
        @can('Registration')
            <li>
                <a id="patientregistration_mainmenu"
                    class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#patientregistration-collapse" aria-expanded="false">
                    <i class="bi bi-app-indicator me-4 fs-5"></i>Registration
                </a>
                <div class="collapse" id="patientregistration-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                        @can('Patientregistration')
                            <li>
                                <a href="{{ route('patientregistration') }}" id="patientregistration_sidenav"
                                    class="text-white rounded">
                                    <i class="bi bi-person  me-4 fs-6"></i><small>New Patient Registration</small>
                                </a>
                            </li>
                        @endcan
                        @can('Patientmasterlist')
                            <li>
                                <a href="{{ route('patientmasterlist') }}" id="patientmasterlist_sidenav"
                                    class="text-white rounded">
                                    <i class="bi bi-person-fill me-4 fs-6"></i><small>Patient Master List</small></a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan
        @can('Billing')
            <li>
                <a id="patientbilling_mainmenu"
                    class="nav-link text-white border-0 fw-bold btn-toggle align-items-center collapsed"
                    data-bs-toggle="collapse" data-bs-target="#patientbilling-collapse" aria-expanded="false">
                    <i class="bi bi-receipt me-4 fs-5"></i>Billing
                </a>
                <div class="collapse" id="patientbilling-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-bold pb-1 small sidebar-drp">
                        @can('OP-Billing')
                            <li>
                                <a href="{{ route('opbilling') }}" id="outpatientbilling_sidenav" class="text-white rounded">
                                    <i class="bi bi-cash  me-4 fs-6"></i><small>Out Patient Billing</small>
                                </a>
                            </li>
                        @endcan
                        @can('IP-Billing')
                            <li>
                                <a href="{{ route('ipbilling') }}" id="inpatientbilling_sidenav" class="text-white rounded">
                                    <i class="bi bi-tablet-landscape me-4 fs-6"></i><small>In Patient Billing</small></a>
                            </li>
                        @endcan
                        @can('OT-Billing')
                            <li>
                                <a href="{{ route('otbilling') }}" id="operationtheatrebilling_sidenav"
                                    class="text-white rounded">
                                    <i class="bi bi-receipt-cutoff me-4 fs-6"></i><small>Operation Theatre Billing</small></a>
                            </li>
                        @endcan
                        @can('Receipt')
                            <li>
                                <a href="{{ route('receipthistory') }}" id="receipt_sidenav" class="text-white rounded">
                                    <i class="bi bi-receipt-cutoff me-4 fs-6"></i><small>Receipt</small></a>
                            </li>
                        @endcan
                        @can('Bill discount/cancel')
                            <li>
                                <a href="{{ route('billdiscounthistory') }}" id="billdiscount_sidenav"
                                    class="text-white rounded">
                                    <i class="bi bi-receipt-cutoff me-4 fs-6"></i><small>Bill Discount/Cancel</small></a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcan
        @can('Paymentvoucher')
            <li>
                <a href="{{ route('paymentvoucherhistory') }}" id="paymentvoucher_sidenav"
                    class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-collection me-4 fs-5"></i>Payment Voucher
                </a>
            </li>
        @endcan
        @can('Insurance')
            <li>
                <a href="{{ route('patientinsurancelist') }}" id="insurance_sidenav"
                    class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-bookmark-star me-4 fs-5"></i>Insurance
                </a>
            </li>
        @endcan
        @can('Outpatient')
            <li>
                <a href="{{ route('outpatientqueue') }}" id="outpatient_sidenav"
                    class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-person-workspace me-4 fs-5"></i>Out Patient <small> Clinical Care </small>
                </a>
            </li>
        @endcan
        @can('Inpatient')
            <li>
                <a href="{{ route('inpatientqueue') }}" id="inpatient_sidenav"
                    class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-thermometer-half me-4 fs-5"></i>In Patient
                </a>
            </li>
        @endcan
        @can('Operationtheatre')
            <li>
                <a href="{{ route('otcalendar') }}" id="ot_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-align-end me-4 fs-5"></i>Operation Theatre
                </a>
            </li>
        @endcan
        {{-- <li>
            <a href="{{ route('causality') }}" id="causality_sidenav" class="nav-link text-white border-0 fw-bold">
                <i class="bi bi-person-circle me-4 fs-5"></i>Causality
            </a>
        </li> --}}
        @can('Wardmanagement')
            <li>
                <a href="{{ route('wardavailability') }}" id="wardmanagement_sidenav"
                    class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-person-video2 me-4 fs-5"></i>Ward Management
                </a>
            </li>
        @endcan
        @can('Emr')
            <li>
                <a href="{{ route('emr') }}" id="emr_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-archive me-4 fs-5"></i>EMR
                </a>
            </li>
        @endcan
        @can('Humanresource')
            <li>
                <a href="{{ route('humanresource') }}" id="hr_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-file-earmark-person me-4 fs-5"></i>Human Resource
                </a>
            </li>
        @endcan
        @can('Facility')
            <li>
                <a href="{{ route('facility') }}" id="facility_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-hdd-network me-4 fs-5"></i>Facility
                </a>
            </li>
        @endcan
        @can('Reports')
            <li>
                <a href="{{ route('adminreports') }}" id="report_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-clipboard-data me-4 fs-5"></i>Reports
                </a>
            </li>
        @endcan
        @can('Settings')
            <li>
                <a href="{{ route('settings') }}" id="setting_sidenav" class="nav-link text-white border-0 fw-bold">
                    <i class="bi bi-sliders me-4 fs-5"></i>Settings
                </a>
            </li>
        @endcan
        <li>
            <a href="{{ route('adminlogout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="logout"
                class="nav-link text-white border-0 text-danger fw-bold">
                <i class="bi bi-power me-4 fs-5"></i>Logout
            </a>
        </li>
        <form id="logout-form" action="{{ route('adminlogout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </ul>
</aside>
