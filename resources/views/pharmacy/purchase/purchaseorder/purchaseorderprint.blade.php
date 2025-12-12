<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Order Print</title>

    <style>
        #printdiv {
            border: 2px solid black;
            padding: 0;
        }

        .header_container {
            display: grid;
            grid-template-columns: 20% 55% 25%;
            align-items: center;
            column-gap: 5px;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 10px 0;
        }

        table,
        th,
        td {
            border: 1px solid rgb(128, 126, 126);
            border-collapse: collapse;
            padding: 5px;
        }

        .supplier_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            grid-gap: 10px;
            padding: 10px;
            font-weight: bold;
        }

        .supplierdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 35% 65%;
            grid-gap: 10px;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="printdiv">
        <div style="border: 1px solid black;">
            @include('pharmacy.purchase.purchaseorder.purchaseordercommonheader.purchaseordercommonheader')
            <div>
                <div class="supplier_details" style="font-weight: bold; font-size:16px;">
                    <div class="supplierdetails_container">
                        <div>Supplier Name</div>
                        <div style="font-weight: normal;">
                            : {{ $purchaseorder->supplier_companyname }}
                        </div>
                        <div> Supplier ID </div>
                        <div style="font-weight: normal;">
                            : {{ $purchaseorder->supplier?->uniqid }}
                        </div>
                        <div> Address </div>
                        <div style="font-weight: normal;">
                            : {{ $purchaseorder->supplier?->address }}
                        </div>
                    </div>
                    <div class="supplierdetails_container">
                        <div>Contact Person</div>
                        <div style="font-weight: normal;">
                            : {{ $purchaseorder->supplier_contact_name }}
                        </div>
                        <div>Mobile</div>
                        <div style="font-weight: normal;">
                            : {{ $purchaseorder->supplier_mobile_no }}
                        </div>
                        <div>GSTIN NO</div>
                        <div style="font-weight: normal;">
                            : {{ $purchaseorder->supplier?->gstin }}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <table style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word;">
                    <thead>
                        <tr>
                            <th style="width:10%">Sl.NO</th>
                            <th style="width:30%">ITEM</th>
                            <th style="width:10%">QTY</th>
                            <th style="width:10%">PRICE (INR)</th>
                            <th style="width:10%">GST %</th>
                            <th style="width:10%">TAXES</th>
                            <th style="width:10%">TOTAL (INR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseorder->showpoitems() as $key => $value)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $value->pharmacyproduct_name }}
                                </td>
                                <td>
                                    {{ $value->quantity }}
                                </td>
                                <td>
                                    {{ $value->price }}
                                </td>
                                <td>
                                    {{ $value->sgst + $value->cgst }}
                                </td>
                                <td>
                                    {{ $value->sgst_amt + $value->cgst_amt }}
                                </td>
                                <td>
                                    {{ $value->total }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"
                                style="border-right-style:none; font-size:16px;padding:1px;font-weight:bold">
                                IN WORD: {{ $amount_in_words }}
                            </td>
                            <td
                                style="border:none;border-left:1px solid rgb(173, 170, 170); font-size:16px;font-weight:bold">
                                Grand Total
                            </td>
                            <td style="border:none;">{{ $purchaseorder->grand_total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="padding-top:10%;padding-bottom:1%;text-align:right;margin-right:2%;">
                Authorized Signatory
            </div>
        </div>
    </div>
    <script>
        function printpurchaseorder() {
            var printContents = document.getElementById('printdiv').innerHTML;
            var print = document.body.innerHTML = printContents;
            window.print();
            window.onafterprint = window.close;
        }
        window.onload = printpurchaseorder();
    </script>
</body>

</html>
