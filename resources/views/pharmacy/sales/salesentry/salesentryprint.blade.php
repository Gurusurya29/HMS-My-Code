<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Entry Print</title>

    <style>
        #printdiv {
            border: 2px solid black;
            padding: 0;
        }

        .header_container {
            display: grid;
            grid-template-columns: 70% 30%;

            padding: 10px;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
        }

        table,
        th,
        td {
            border: 1px solid rgb(173, 170, 170);
            border-collapse: collapse;
            padding: 5px;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        .patient_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            grid-gap: 10px;
            padding: 2px;
            font-weight: bold;
        }

        .patientdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 20% 80%;
            grid-gap: 20px;
            padding: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="printdiv">
        <div style="text-align: center; font-weight: bold;font-size:18px;">Tax Invoice</div>
        <div style="border: 1px solid rgb(173, 170, 170);">
            @include('pharmacy.sales.salesentry.salesentrycommonheader.salesentrycommonheader')
            <div class="patient_details" style="font-weight: bold; font-size:16px;">
                <div class="patientdetails_container">
                    <div>Buyer</div>
                    <div style="font-weight: normal;">
                    </div>
                    <div>{{ $salesentry->patient->name }} </div>
                    <div style="font-weight: normal;">
                    </div>
                </div>
                <div class="patientdetails_container">
                    <div> UHID </div>
                    <div style="font-weight: normal;">
                        : {{ $salesentry->patient->uhid }}
                    </div>
                </div>
            </div>
            <div>
                <table style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word; border-bottom:2px solid black;font-size
                    :14px;">
                    <thead>
                        <tr style="border-bottom:2px solid black;border-top:2px solid black;">
                            <th style="width:10%">Sl. No</th>
                            <th style="width:40%">ITEM</th>
                            <th style="width:10%">HSN Code</th>
                            <th style="width:10%">Qty</th>
                            <th style="width:10%">MRP</th>
                            <th style="width:10%">GST</th>
                            <th style="width:10%">DISC %</th>
                            <th style="width:10%">AMT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesentry->pharmsalesentryitem as $key => $value)
                        <tr>
                            <td style="height:20px;">{{ $key + 1 }}</td>
                            <td style="height:20px;text-align:left;">
                                <div>{{ $value->pharmproduct->name }}</div>
                                <div>Batch NO: {{ $value->batch }} <span style="margin-left:4px;">Expiry:
                                        {{ Carbon\Carbon::parse($value->expiry_date)->format('d-m-Y') }}</span>
                                </div>

                            </td>
                            <td style="height:20px;text-align:left;">
                                {{ $value->pharmproduct->hsn }}
                            </td>
                            <td style="height:20px;">
                                {{ $value->quantity }}
                            </td>
                            <td style="height:20px;">
                                {{ $value->selling_price }}
                            </td>
                            <td style="height:20px;">
                                {{ $value->cgst + $value->sgst }}
                            </td>
                            <td style="height:20px;">
                                {{ $value->disc }}
                            </td>
                            <td style="height:20px;">
                                {{ $value->total }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table
                    style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word; border:none;margin-top:1%;font-size:14px;">
                    <tbody>
                        <tr>
                            <td style="border:none;font-weight:bold; padding:2px">GST Rates</td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                Taxable Value
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                CGST
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                SGST
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                Total Dicount Amt
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->disc_amt }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->pharmsalesentryitem->avg('cgst') +
                                $salesentry->pharmsalesentryitem->avg('sgst') }}
                                %
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->taxableamt }}
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->cgst }}
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->sgst }}
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                Taxable Total
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->taxableamt }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                CGST
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->cgst }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                SGST
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                {{ $salesentry->pharmsalesentryitem->sum('sgstamt') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px"></td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                Total Invoice Value
                            </td>
                            <td style="border:none;font-weight:bold; padding:2px">
                                Rs.{{ $salesentry->grand_total }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-left:3%;">
                <div>Amount Payable(in words)</div>
                <div style="font-weight:bold; margin-top:1%;">{{ $amount_in_words }}</div>
            </div>
            <div style="margin-left:1%;">
                <div style="font-weight:bold; margin-top:2%;">Declaration :</div>
                <div style="width:75%; margin-top:1%;">We declare that this invoice shows the actual price of the
                    goods described and that
                    all particulars are true and correct.</div>
            </div>
            <div
                style="display:flex; justify-content: space-between; margin-right:5px; margin-top:3%;margin-bottom:1%;">
                <div>

                </div>
                <div>
                    This is a Computer Generated Invoice
                </div>
                <div>
                    Authorized Signatory
                </div>
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