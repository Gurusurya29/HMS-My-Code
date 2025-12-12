<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'receipthistory' ? 'active' : '' }}"
        href="{{ route('receipthistory') }}">Receipt History </a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'receipt' ? 'active' : '' }}"
        aria-current="page" href="{{ route('receipt') }}">Receipt</a>
</nav>
