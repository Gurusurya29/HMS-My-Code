<style type="text/css">
    /* basic positioning */
    .legend {
        list-style: none;
    }

    .legend li {
        float: left;
        margin-right: 10px;
    }

    .legend span {
        float: left;
        width: 12px;
        height: 12px;
        margin: 4px;
    }

    /* your colors */
    .legend .available {
        background-color: #38c172;
    }

    .legend .occupied {
        background-color: #e3342f;
    }

    .legend .housekeeping {
        background-color: #ffed4a;
    }

    .legend .maintenance {
        background-color: #FF9800;
    }

    .legend .blocked {
        background-color: #ad1457;
    }

</style>

<ul class="legend mt-2">
    <li><span class="available"></span> Available</li>
    <li><span class="occupied"></span> Occupied</li>
    <li><span class="housekeeping"></span> House Keeping</li>
    {{-- <li><span class="maintenance"></span> Maintenance</li> --}}
    <li><span class="blocked"></span> Blocked</li>
</ul>
<br>
