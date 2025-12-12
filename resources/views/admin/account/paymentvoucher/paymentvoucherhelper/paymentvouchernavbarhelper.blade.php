<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    @can('Paymentvoucher-history')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'paymentvoucherhistory' ? 'active' : '' }}"
            href="{{ route('paymentvoucherhistory') }}">Payment Voucher History </a>
    @endcan
    @can('Paymentvoucher-entry')
        <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'paymentvoucherentry' ? 'active' : '' }}"
            aria-current="page" href="{{ route('paymentvoucherentry') }}">Payment Voucher Entry</a>
    @endcan
</nav>
