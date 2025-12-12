<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Entry Print</title>
</head>
<style>
    /* .header_container {
            display: grid;
            grid-template-columns: 30% 70%;
            align-items: center;

            padding: 10px;
        } */
    .header_container {
        display: grid;
        grid-template-columns: 25% 50% 25%;
        justify-content: space-between;
        gap: 20px;
        align-items: center;
    }

    .row {
        border: none;
    }

    .border_bottom {
        border-bottom: 1px solid rgb(75, 74, 74);
        margin: 10px 0;
    }

    .header_details {
        display: grid;
        justify-content: space-around;
        grid-template-columns: auto auto;
        font-size: 22px;
    }

    .data {
        border: none;
    }

    .label {
        width: 30%;
        font-weight: bold;
        font-size: 16px;
    }

    table,
    th,
    td {
        border: 1px solid rgb(107, 104, 104);
        border-collapse: collapse;
        padding: 5px;
    }

    .patient_details {
        display: grid;
        justify-content: space-between;
        grid-template-columns: 50% 50%;
        grid-gap: 10px;
        padding: 10px;
        font-weight: bold;
    }

    .patientdetails_container {
        display: grid;
        justify-content: space-between;
        grid-template-columns: 50% 50%;
        grid-gap: 10px;
        padding: 10px;
        font-weight: bold;
    }
</style>

<body>
    <div id="printdiv">
        @include('admin.commonheader.commonprintheader')
        <div class="border_bottom"></div>
        <div class="patient_details" style="font-weight: bold; font-size:16px;">
            <div class="patientdetails_container">
                <div> PRUCHASE ENTRY </div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->uniqid }}</div>
                <div> CONTACT NAME </div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->pharmpurchaseorder->supplier_contact_name }}
                </div>
                <div>TAX AMOUNT</div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->taxamt }}
                </div>
                <div>GRAND TOTAL</div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->grand_total }}
                </div>
            </div>
            <div class="patientdetails_container">
                <div> SUPPLIER NAME </div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->pharmpurchaseorder->supplier_companyname }}
                </div>
                <div> MOBILE</div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->pharmpurchaseorder->supplier_mobile_no }}</div>
                <div> TAXABLE AMOUNT </div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->taxableamt }}
                </div>
                <div> DATE </div>
                <div style="font-weight: normal;">
                    : {{ $purchaseentry->created_at->format('d-m-Y h:i A') }}
                </div>

            </div>
        </div>
        <div class="border_bottom"></div>
        <div>
            <table class="maintable" style="width:100%; text-align:center;padding: 5px;">
                <tr>
                    <th>PRODUCT NAME</th>
                    <th>ORDERED QUANTITY</th>
                    <th>RECIEVED QUANTITY</th>
                    <th>BALANCE QUANTITY</th>
                    <th>BATCH</th>
                    <th>EXPIRY DATE</th>
                    <th>RECIEVED QUANTITY</th>
                    <th>PURCHASE PRICE</th>
                    <th>SELLING PRICE</th>
                </tr>
                @foreach ($purchaseentry->pharmpurchaseorder->poitems as $item)
                    @php
                        $itemlist = $item->purchasebasedentryitem($purchaseentry->id);
                    @endphp
                    @if (count($itemlist) > 0)
                        <tr>
                            <td>{{ $item->pharmacyproduct_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->received_quantity }}</td>
                            <td> {{ $item->quantity > $item->received_quantity ? $item->quantity - $item->received_quantity : 0 }}
                            </td>
                            <td style="padding:2px 0;">
                                @foreach ($itemlist as $subindexvalue)
                                    <div
                                        style="{{ $loop->last ? '' : 'border-bottom: .2px solid rgb(107, 104, 104);' }} ">
                                        {{ $subindexvalue->batch }}
                                    </div>
                                @endforeach
                            </td>
                            <td style="padding:2px 0;">

                                @foreach ($itemlist as $subindexvalue)
                                    <div
                                        style="{{ $loop->last ? '' : 'border-bottom: .2px solid rgb(107, 104, 104);' }} ">
                                        {{ Carbon\Carbon::parse($subindexvalue->expiry_date)->format('d-m-Y') }}

                                    </div>
                                @endforeach

                            </td>
                            <td style="padding:2px 0;">

                                @foreach ($itemlist as $subindexvalue)
                                    <div
                                        style="{{ $loop->last ? '' : 'border-bottom: .2px solid rgb(107, 104, 104);' }} ">
                                        {{ $subindexvalue->received_quantity }}

                                    </div>
                                @endforeach

                            </td>
                            <td style="padding:2px 0;">

                                @foreach ($itemlist as $subindexvalue)
                                    <div
                                        style="{{ $loop->last ? '' : 'border-bottom: .2px solid rgb(107, 104, 104);' }} ">
                                        {{ $subindexvalue->purchase_price }}

                                    </div>
                                @endforeach

                            </td>
                            <td style="padding:2px 0;">

                                @foreach ($itemlist as $subindexvalue)
                                    <div
                                        style="{{ $loop->last ? '' : 'border-bottom: .2px solid rgb(107, 104, 104);' }} ">
                                        {{ $subindexvalue->selling_price }}

                                    </div>
                                @endforeach

                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <div class="border_bottom" style="margin-top:3%;"></div>
            @php
                $addtionaldata = $purchaseentry->nonpoitems();
                $count = $addtionaldata ? count($addtionaldata) : 0;
            @endphp
            @if ($count != 0)
                <div class="p-3">
                    <div>
                        <div>
                            <div>
                                <div style="font-size: 16px;font-weight:bold;">Additional
                                    Products
                                </div>
                            </div>
                        </div>
                    </div>
                    <table style="width:100%; text-align:center; margin-top:3%;">
                        <thead>
                            <tr>
                                <th>PRODUCT NAME
                                </th>
                                <th>BATCH
                                </th>
                                <th>EXPIRY DATE</th>
                                <th>QUANTITY
                                </th>
                                <th>PURCHASE PRICE
                                </th>
                                <th>SELLING PRICE
                                </th>
                            </tr>
                        </thead>
                        @foreach ($addtionaldata as $subindexvalue)
                            <tr>
                                <td>
                                    {{ $subindexvalue->pharmproduct->name }}
                                </td>
                                <td>
                                    {{ $subindexvalue->batch }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($subindexvalue->expiry_date)->format('m-d-Y') }}
                                </td>
                                </td>
                                <td>
                                    {{ $subindexvalue->received_quantity }}
                                </td>
                                <td>{{ $subindexvalue->purchase_price }}
                                </td>
                                <td>
                                    {{ $subindexvalue->selling_price }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
        <script>
            function printreceipt() {
                var printContents = document.getElementById('printdiv').innerHTML;
                var print = document.body.innerHTML = printContents;
                window.print();
                window.onafterprint = window.close;
            }
            window.onload = printreceipt();
        </script>
</body>

</html>
