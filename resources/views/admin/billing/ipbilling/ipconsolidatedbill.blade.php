<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IP Bill</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #printdiv {

            /* padding: 0; */
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
            grid-template-columns: 30% 70%;
            grid-gap: 10px;
            padding: 10px;
            font-weight: bold;
        }

        .text_align tr td {
            padding: 5px 10px;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 10px 0;
        }
    </style>
</head>

<body>
    @if ($bill_list->isNotEmpty())

    <div id="printdiv" style="overflow-x:auto;">
        <div>
            @include('admin.commonheader.commonprintheader')
            <div class="border_bottom"></div>
            <div style="text-align: center; font-weight: bold;font-size:18px;margin-top:5px;">IP CONSOLIDATED BILL
            </div>
            <div>
                <div style="border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
                    <div class="patient_details" style="font-weight: bold; font-size:14px;">
                        <div class="patientdetails_container">
                            <div>Bill No </div>
                            <div style="font-weight: normal">
                                : {{ $ipbilling->uniqid }}</div>
                            <div> UHID </div>
                            <div style="font-weight: normal">
                                : {{ $ipbilling->patient->uhid }}</div>

                            <div>Patient Name </div>
                            <div style="font-weight: normal">
                                : @if ($ipbilling->patient->salutation)
                                {{ config('archive.salutation')[$ipbilling->patient->salutation] }}.
                                @endif{{ $ipbilling->patient->name }}</div>

                            <div>Doctor Name </div>
                            <div style="font-weight: normal">
                                : {{ $ipbilling->patientvisit->doctor->name }}</div>

                        </div>
                        <div class="patientdetails_container">
                            <div>Bill Date</div>
                            <div style="font-weight: normal;">:
                                {{ $ipbilling->created_at->format('d-m-Y h:i A') }}</div>

                            <div> IP No</div>
                            <div style="font-weight: normal">
                                : {{ $ipbilling->inpatient->uniqid }}</div>

                            <div> Age/Gender </div>
                            <div style="font-weight: normal">
                                :
                                {{ $ipbilling->patient->age ?? '-' }}/{{ $ipbilling->patient->gender ?
                                config('archive.gender')[$ipbilling->patient->gender] : '-' }}
                            </div>

                        </div>
                    </div>
                </div>
                <div style="margin-top:15px; font-size:14px;">
                    <table style="border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    border: 1px solid black;">
                        <thead>
                            <tr style="border:1px solid black">
                                <th style="border:1px solid black;">
                                    S.No
                                </th>
                                <th style="border:1px solid black;">
                                    Services
                                </th>

                                <th style="border:1px solid black">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text_align">
                            @foreach ($bill_list as $key => $eachbill_list)
                            <tr>
                                <td style="
                            border:1px solid black">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td style="
                            border:1px solid black ;text-align:center;">
                                    {{ $key }}
                                </td>

                                <td style="
                                                    border:1px solid black; text-align:center;">
                                    {{ $eachbill_list->sum('final_amount') }}

                                </td>

                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" style="text-align: right;
                            border:1px solid black;font-weight:bold;">
                                    Sub Total</td>
                                <td style="text-align: center;
                            border:1px solid black;">
                                    {{ $ipbilling->sub_total }}
                                </td>
                            </tr>
                            @if ($ipbilling->discount != 0)
                            <tr>
                                <td colspan="2" style="text-align: right;
                            border:1px solid black;font-weight:bold;">
                                    Discount</td>
                                <td style="text-align: center;
                            border:1px solid black;">
                                    {{ $ipbilling->discount }}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="2" style="text-align: right;
                            border:1px solid black;font-weight:bold;">
                                    Total</td>
                                <td style="text-align: center;
                            border:1px solid black;">
                                    {{ $ipbilling->total }}
                                </td>
                            </tr>

                            @if ($ipbilling->billdiscount_type)
                            <tr>
                                <td colspan="2" style="border:1px solid black;font-weight:bold;">
                                    <div style="display: grid;
                                    grid-template-columns: auto auto">
                                        <div style="color:red; font-weight:bold; text-align: right; font-size:16px;">
                                            @if ($ipbilling->billdiscount_type == 2)
                                            Bill Cancelled
                                            @endif
                                        </div>
                                        <div style="text-align: right;">
                                            Bill
                                            {{ $ipbilling->billdiscount_type == 1 ? 'Discount' : 'Cancelled' }}
                                            Amount</div>
                                    </div>
                                </td>

                                <td style="text-align: center; border:1px solid black;">
                                    {{ $ipbilling->billdiscount_amount }}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="2" style="text-align: right;
                            border:1px solid black;font-weight:bold;">
                                    Net Value</td>
                                <td style="text-align: center;
                            border:1px solid black;">
                                    {{ $ipbilling->grand_total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
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