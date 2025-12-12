<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Return Print</title>

    <style>
        #printdiv {
            border: 2px solid black;
            padding: 0;
        }

        /* .header_container {
            display: grid;
            grid-template-columns: 30% 70%;
            align-items: center;
            padding: 5px;
        } */
        .header_container {
            display: grid;
            grid-template-columns: 25% 50% 25%;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 10px 0;
        }

        table,
        th,
        td {
            border: 1px solid rgb(107, 107, 107);
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div id="printdiv">
        @include('admin.commonheader.commonprintheader')
        <div class="border_bottom"></div>
        <div style="text-align: center; font-weight: bold;font-size:25px;">PURCHASE RETURN</div>
        <div>
            <table style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word;margin-top:3%">
                <thead>
                    <tr>
                        <th style="width:30%">ITEM</th>
                        <th style="width:20%">BATCH</th>
                        <th style="width:20%">EXPIRY DATE</th>
                        <th style="width:20%">RETURN QUANTITY</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchasereturn->purchasereturnitem as $value)
                    <tr>
                        <td>
                            {{ $value->pharmacyproduct->name }}
                        </td>
                        <td>
                            {{ $value->pharmpurchaseentryitem->batch }}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($value->pharmpurchaseentryitem->expiry_date)->format('d-m-Y') }}
                        </td>
                        <td>
                            {{ $value->return_quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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