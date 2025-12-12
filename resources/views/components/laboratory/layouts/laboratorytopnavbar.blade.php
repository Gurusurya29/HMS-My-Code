<nav class="navbar navbar-expand-lg navbar-light p-0 theme_bg_color mb-0 pb-0">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#laboratorytopmenu"
            aria-controls="laboratorytopmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="laboratorytopmenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto gap-4">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="homenav"
                        href="{{ route('investigationdashboard') }}">Home</a>
                </li>
                @if (auth()->guard('laboratory')->user()->access_lab)
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" id="laboratorynav"
                            href="{{ route('laboratorypatientlist') }}">Laboratory</a>
                    </li>
                @endif
                @if (auth()->guard('laboratory')->user()->access_xray)
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" id="xraynav"
                            href="{{ route('xraypatientlist') }}">X-Ray</a>
                    </li>
                @endif
                @if (auth()->guard('laboratory')->user()->access_scan)
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" id="scannav"
                            href="{{ route('scanpatientlist') }}">Scan</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="receiptnav"
                        href="{{ route('investigationreceipt') }}">Receipt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="paymentvoucher_nav"
                        href="{{ route('investigationpaymentvoucherhistory') }}">Payment Voucher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="reportnav"
                        href="{{ route('investigationreport') }}">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" id="settingnav"
                        href="{{ route('laboratorysettings') }}">Settings</a>
                </li>
            </ul>
            <div class="d-flex">
                <div class="px-2 mt-1 text-white"><i class="bi bi-person-circle"></i>
                    {{ auth()->guard('laboratory')->user()->name }}</div>
                <a class="btn btn-sm btn-warning" href="{{ route('postlaboratorylogout') }}" type="submit">Logout</a>
            </div>
        </div>
    </div>
</nav>
