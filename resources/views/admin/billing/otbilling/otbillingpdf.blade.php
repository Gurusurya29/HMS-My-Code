<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT Bill</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

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

        .patient_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            grid-gap: 10px;
            padding: 5px;
            font-weight: bold;
        }

        .patientdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 25% 75%;
            grid-gap: 10px;
            padding: 5px;
            font-weight: bold;
        }

        .text_align tr td {
            padding: 5px 10px;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 10px 0;
        }

        .datatable {
            display: grid;
            grid-template-columns: 10% 45% 15% 15% 15%;
            height: 5px;
            grid-row-gap: 10px;
        }

        /* .datatable>div {
            border-right: 1px solid black;
            padding: 4px;
        } */
    </style>
</head>

<body style="border:1px solid black; height:97vh;">
    @if ($otbilling->otbillingservicelist->isNotEmpty())
    <div id="printdiv" style="overflow-x:auto;">
        @include('admin.commonheader.commonprintheader')
        <div class="patient_details" style="font-weight: bold; font-size:13px; border-top:2px solid black;">
            <div class="patientdetails_container">
                <div>IP Number</div>
                <div style="font-weight: normal">
                    {{ $otbilling->inpatient->uniqid }}
                </div>

                <div> UHID </div>
                <div style="font-weight: normal">
                    : {{ $otbilling->patient->uhid }}</div>

                <div>Patient</div>
                <div style="font-weight: normal">
                    : @if ($otbilling->patient->salutation)
                    {{ config('archive.salutation')[$otbilling->patient->salutation] }}.
                    @endif{{ $otbilling->patient->name }}</div>
                <div>
                    Bed No
                </div>
                <div style="font-weight: normal">
                    : {{ $otbilling->otschedule->bedorroomnumber->name }}
                </div>
                <div>
                    Surgery Date
                </div>
                <div style="font-weight: normal">
                    :
                    @if ($otbilling->otschedule->otsurgerypreop)
                    {{ Carbon\Carbon::parse($otbilling->otschedule->otsurgerypreop?->patientsent_date)->format('d/m/Y')
                    }}
                    @endif
                </div>
            </div>
            <div class="patientdetails_container">
                <div>Bill No </div>
                <div style="font-weight: normal">
                    : {{ $otbilling->uniqid }}</div>
                <div>Bill Date</div>
                <div style="font-weight: normal;">:
                    {{ $otbilling->created_at->format('d-m-Y h:i A') }}</div>
                <div> Age/Gender </div>
                <div style="font-weight: normal">
                    :
                    {{ $otbilling->patient->age ?? '-' }}/{{ $otbilling->patient->gender ?
                    config('archive.gender')[$otbilling->patient->gender] : '-' }}
                </div>
                <div>Doctor </div>
                <div style="font-weight: normal">
                    : {{ $otbilling->patientvisit->doctor->name }}</div>
                <div> Duration </div>
                <div style="font-weight: normal">
                    :
                    @if ($otbilling->otschedule->otsurgerypostop)
                    {{
                    Carbon\Carbon::parse($otbilling->otschedule->otsurgerypostop?->surgeryend_time)->diffInHours(Carbon\Carbon::parse($otbilling->otschedule->otsurgerypostop->surgerystart_time))
                    }}
                    Hrs
                    @endif
                </div>

            </div>
        </div>
        <div style="font-size:14px;border-top:2px solid black;">
            <table style="border-collapse: collapse;
                    border-spacing: 0;
                    table:100%;
                    width: 100%;
                    border: 1px solid black;border-bottom:none;">
                <thead>
                    <tr style="border:1px solid black; height:10%;">
                        <th style="border:1px solid black;">
                            S.No
                        </th>
                        <th style="border:1px solid black">
                            Charges
                        </th>
                        <th style="border:1px solid black">
                            Qty
                        </th>
                        <th style="border:1px solid black">
                            Rate
                        </th>
                        <th style="border:1px solid black">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody class="text_align">
                    @foreach ($otbilling->otbillingservicelist as $key => $eachotbillingservicelist)
                    <tr>
                        <td style="
                            border:1px solid black;text-align: center;">
                            {{ $key + 1 }}
                        </td>
                        <td style="
                            border:1px solid black">
                            {{ $eachotbillingservicelist->otservice_name }}
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachotbillingservicelist->otservice_fee }}
                        </td>
                        <td style="text-align: center;
                                    border:1px solid black">
                            {{ $eachotbillingservicelist->quantity }}
                        </td>
                        <td style="text-align: center;
                                    border:1px solid black">
                            {{ $eachotbillingservicelist->final_amount }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight:bold;
                            border:1px solid black">
                            Sub Total
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $otbilling->sub_total }}
                        </td>
                    </tr>
                    @if ($otbilling->discount != 0)
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight:bold;
                            border:1px solid black">
                            Discount
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $otbilling->discount }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight:bold;
                            border:1px solid black">
                            Total
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $otbilling->total }}
                        </td>
                    </tr>
                    @if ($otbilling->billdiscount_type)
                    <tr>
                        <td colspan="4" style="font-weight:bold;
                            border:1px solid black">
                            <div style="display: grid;
                                    grid-template-columns: auto auto">
                                <div style="color:red; font-weight:bold; text-align: right; font-size:16px;">
                                    @if ($otbilling->billdiscount_type == 2)
                                    Bill Cancelled
                                    @endif
                                </div>
                                <div style="text-align: right;">
                                    Bill {{ $otbilling->billdiscount_type == 1 ? 'Discount' : 'Cancelled' }}
                                    Amount</div>
                            </div>
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $otbilling->billdiscount_amount }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight:bold;
                            border:1px solid black">
                            Net Value
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $otbilling->grand_total }}
                        </td>
                    </tr>
                </tbody>
            </table>
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