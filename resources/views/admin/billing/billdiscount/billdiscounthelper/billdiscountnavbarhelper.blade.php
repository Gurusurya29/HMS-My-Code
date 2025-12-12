<nav class="nav nav-pills flex-column flex-sm-row shadow-sm rounded-pill bg-white">
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'billdiscounthistory' ? 'active' : '' }}"
        href="{{ route('billdiscounthistory') }}">Bill Discount/Cancel History </a>
    <a class="flex-sm-fill text-sm-center nav-link rounded-pill {{ $name == 'billdiscount' ? 'active' : '' }}"
        aria-current="page" href="{{ route('billdiscount') }}">Bill Discount/Cancel</a>
</nav>
