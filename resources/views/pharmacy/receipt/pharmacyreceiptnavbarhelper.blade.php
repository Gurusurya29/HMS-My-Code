<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'receipt' ? 'active' : '' }}"
        aria-current="page" href="{{ route('pharmacy.pharmacyreceipt') }}">Receipt</a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'receipthistory' ? 'active' : '' }}"
        href="{{ route('pharmacy.pharmacyreceipthistory') }}">Receipt History </a>
</nav>
