<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'pharmacypaymentvoucherhistory' ? 'active' : '' }}"
        href="{{ route('pharmacy.pharmacypaymentvoucherhistory') }}">Payment Voucher History </a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'pharmacypaymentvoucherentry' ? 'active' : '' }}"
        aria-current="page" href="{{ route('pharmacy.pharmacypaymentvoucherentry') }}">Payment Voucher Entry</a>
</nav>
