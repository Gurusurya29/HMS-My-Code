<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'receipt' ? 'active' : '' }}"
        aria-current="page" href="{{ route('investigationreceipt') }}">Receipt</a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'receipthistory' ? 'active' : '' }}"
        href="{{ route('investigationreceipthistory') }}">Receipt History </a>
</nav>
