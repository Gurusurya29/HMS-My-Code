<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OP Bill</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #printdiv {
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
            font-weight: bold;
        }

        .patientdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 30% 70%;
            grid-gap: 5px;
            padding: 10px;
            font-weight: bold;
        }

        .text_align tr td {
            text-align: center;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 10px 0;
        }
    </style>
</head>

<body>
    @if ($opbillinglist->opbillingservicelist->isNotEmpty())

    <div id="printdiv" style="overflow-x:auto;">
        @include('admin.commonheader.commonprintheader')
        <div style="text-align: center; font-weight: bold;font-size:15px;">OP BILL</div>
        <div>
            <div style="border: 1px solid rgb(91, 90, 90); border-radius: 10px; margin-top:1px;">
                <div class="patient_details" style="font-weight: bold; font-size:13px;">
                    <div class="patientdetails_container">
                        <div>Bill No </div>
                        <div style="font-weight: normal">
                            : {{ $opbillinglist->uniqid }}</div>
                        <div> UHID </div>
                        <div style="font-weight: normal">
                            : {{ $opbillinglist->patient->uhid }}</div>

                        <div>Patient</div>
                        <div style="font-weight: normal">
                            : @if ($opbillinglist->patient->salutation)
                            {{ config('archive.salutation')[$opbillinglist->patient->salutation] }}.
                            @endif{{ $opbillinglist->patient->name }}</div>

                        <div>Doctor </div>
                        <div style="font-weight: normal">
                            :
                            {{ $opbillinglist->opbilling->patientvisit->doctor_id ?
                            $opbillinglist->opbilling->patientvisit->doctor->name : '-' }}
                        </div>
                    </div>
                    <div class="patientdetails_container">
                        <div>Bill Date</div>
                        <div style="font-weight: normal;">:
                            {{ $opbillinglist->created_at->format('d-m-Y h:i A') }}</div>

                        <div> Visit No</div>
                        <div style="font-weight: normal">
                            : {{ $opbillinglist->opbilling->patientvisit->uniqid }}</div>

                        <div> Age/Gender</div>
                        <div style="font-weight: normal">
                            :
                            {{ $opbillinglist->patient->age ?? '-' }}/{{ $opbillinglist->patient->gender ?
                            config('archive.gender')[$opbillinglist->patient->gender] : '-' }}
                        </div>

                    </div>
                </div>
            </div>
            <div style="margin-top:5px;">
                <table style="border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    font-size:13px;
                    border: 1px solid rgb(172, 171, 171);">
                    <thead>
                        <tr style="border: 1px solid rgb(172, 171, 171)">
                            <th style="padding:5px;">
                                S.No
                            </th>
                            <th style="padding:5px;">
                                Description
                            </th>
                            <th style="padding:5px;">
                                Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opbillinglist->opbillingservicelist as $key => $eachopbillingservicelist)
                        <tr
                            style="border-bottom: 1px solid rgb(207, 204, 204); border-left:1px solid rgb(172, 171, 171); border-right:1px solid rgb(172, 171, 171)">
                            <td style="text-align: center;padding:5px;">
                                {{ $key + 1 }}
                            </td>
                            <td style="text-align: center;padding:5px;">
                                {{ $eachopbillingservicelist->opservice_name }}
                            </td>
                            <td style="text-align: center;padding:5px;">
                                {{ $eachopbillingservicelist->final_amount }}
                            </td>
                        </tr>
                        @endforeach
                        <tr
                            style="border-bottom: 1px solid rgb(207, 204, 204); border-left:1px solid rgb(172, 171, 171); border-right:1px solid rgb(172, 171, 171)">
                            <td colspan="2" style="padding:5px; text-align: right;font-weight:bold;">
                                Sub Total</td>
                            <td style="padding:5px; text-align: center;">
                                {{ $opbillinglist->sub_total }}
                            </td>
                        </tr>
                        @if ($opbillinglist->discount != 0)
                        <tr
                            style="border-bottom: 1px solid rgb(207, 204, 204); border-left:1px solid rgb(172, 171, 171); border-right:1px solid rgb(172, 171, 171)">
                            <td colspan="2" style="padding:5px; text-align: right;font-weight:bold;">
                                Discount</td>
                            <td style="padding:5px; text-align: center;">
                                {{ $opbillinglist->discount }}
                            </td>
                        </tr>
                        @endif
                        <tr
                            style="border-bottom: 1px solid rgb(207, 204, 204); border-left:1px solid rgb(172, 171, 171); border-right:1px solid rgb(172, 171, 171)">
                            <td colspan="2" style="padding:5px; text-align: right;font-weight:bold;">
                                Total</td>
                            <td style="padding:5px; text-align: center;">
                                {{ $opbillinglist->total }}
                            </td>
                        </tr>

                        @if ($opbillinglist->billdiscount_type)
                        <tr
                            style="border-bottom: 1px solid rgb(207, 204, 204); border-left:1px solid rgb(172, 171, 171); border-right:1px solid rgb(172, 171, 171)">
                            <td colspan="2" style="padding:5px; font-weight:bold;">
                                <div style="display: grid;
                                    grid-template-columns: auto auto">
                                    <div style="color:red; font-weight:bold; text-align: right; font-size:16px;">
                                        @if ($opbillinglist->billdiscount_type == 2)
                                        Bill Cancelled
                                        @endif
                                    </div>
                                    <div style="text-align: right;">
                                        Bill
                                        {{ $opbillinglist->billdiscount_type == 1 ? 'Discount' : 'Cancelled' }}
                                        Amount</div>
                                </div>
                            </td>
                            <td style="padding:5px; text-align: center;">
                                {{ $opbillinglist->billdiscount_amount }}
                            </td>
                        </tr>
                        @endif
                        <tr
                            style="border-bottom: 1px solid rgb(207, 204, 204); border-left:1px solid rgb(172, 171, 171); border-right:1px solid rgb(172, 171, 171)">
                            <td colspan="2" style="padding:5px; text-align:right;font-weight:bold;">
                                Net Value
                            </td>
                            <td style="padding:5px; text-align: center; border-top: none;">
                                {{ $opbillinglist->grand_total }}
                            </td>
                        </tr>
                        @if ($opbillinglist->opbilling->patientvisit->doctorspecialization_id == 4)
                        <tr>
                            <td colspan="3"
                                style="padding:5px; text-align:center;border-top:1px solid rgb(172, 171, 171);">
                                Website: www.trskinclinic.com
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
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