<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'investigationpaymentvoucherhistory' ? 'active' : '' }}"
        href="{{ route('investigationpaymentvoucherhistory') }}">Payment Voucher History </a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'investigationpaymentvoucherentry' ? 'active' : '' }}"
        aria-current="page" href="{{ route('investigationpaymentvoucherentry') }}">Payment Voucher Entry</a>
</nav>
