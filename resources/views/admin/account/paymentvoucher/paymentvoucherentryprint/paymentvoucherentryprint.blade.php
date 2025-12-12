<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher Print</title>

    <style>
        #printdiv {
            border: 2px solid black;
            padding: 0;
        }

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

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 10px 0;
        }

        .patient_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            grid-gap: 5px;
            margin-left: 10px;
            font-weight: bold;
        }

        .patientdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 30% 70%;
            grid-gap: 5px;
            padding: 5px;
            font-weight: bold;
        }

        .footer_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            margin: 40px 5px 5px 5px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div id="printdiv">
        @include('admin.commonheader.commonprintheader')
        <div class="border_bottom"></div>
        <div style="text-align: center; font-weight: bold;font-size:14px;">PAYMENT VOUCHER</div>
        <div style="border: 1px solid rgb(58, 57, 57); border-radius: 10px; margin-top:2px;">
            <div class="patient_details" style="font-weight: bold; font-size:14px;">
                <div class="patientdetails_container">
                    <div>VOUCHER NO</div>
                    <div style="font-weight: normal">
                        :
                        {{ $paymentvoucher->paymentvoucher_uniqid }}

                    </div>

                    <div>
                        @if ($paymentvoucher->payment_to == 1)
                            PATIENT
                        @elseif ($paymentvoucher->payment_to == 2)
                            EMPLOYEE
                        @elseif ($paymentvoucher->payment_to == 3)
                            COMPANY
                        @else
                            OTHER
                        @endif
                    </div>
                    <div style="font-weight: normal">
                        @if ($paymentvoucher->payment_to == 1)
                            :
                            @if ($paymentvoucher->paymentable->salutation)
                                {{ config('archive.salutation')[$paymentvoucher->paymentable->salutation] }}.
                            @endif
                            {{ $paymentvoucher->paymentable->name }}
                        @elseif ($paymentvoucher->payment_to == 2)
                            : {{ $paymentvoucher->paymentable->name }}
                        @elseif ($paymentvoucher->payment_to == 3)
                            : {{ $paymentvoucher->paymentable->company_name }}
                        @else
                            : {{ $paymentvoucher->others_name }}
                        @endif
                    </div>
                    @if ($paymentvoucher->payment_type)
                        <div>
                            PAYMENT TYPE
                        </div>
                        <div style="font-weight: normal;">
                            :
                            @if ($paymentvoucher->payment_to == 3)
                                {{ $paymentvoucher->payment_type
                                    ? config('archive.receipt_type_supplier')[$paymentvoucher->payment_type - 1]['subtype']
                                    : '' }}
                            @else
                                {{ $paymentvoucher->payment_type
                                    ? config('archive.receipt_type')[$paymentvoucher->payment_type - 1]['subtype']
                                    : '' }}
                            @endif
                        </div>
                    @endif
                </div>
                <div class="patientdetails_container">
                    <div>DATE</div>
                    <div style="font-weight: normal;">:
                        : {{ $paymentvoucher->created_at->format('d-m-Y h:i A') }}
                    </div>
                    @if ($paymentvoucher->payment_to == 1)
                        <div>
                            UHID
                        </div>
                    @elseif ($paymentvoucher->payment_to == 2)
                        <div>
                            EMPLOYEE ID
                        </div>
                    @elseif ($paymentvoucher->payment_to == 3)
                        <div>
                            COMPANY ID
                        </div>
                    @endif

                    @if ($paymentvoucher->payment_to == 1)
                        <div style="font-weight: normal">
                            : {{ $paymentvoucher->paymentable->uhid }}
                        </div>
                    @elseif ($paymentvoucher->payment_to == 2)
                        <div style="font-weight: normal">
                            : {{ $paymentvoucher->paymentable->uniqid }}
                        </div>
                    @elseif ($paymentvoucher->payment_to == 3)
                        <div style="font-weight: normal">
                            : {{ $paymentvoucher->paymentable->uniqid }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div
            style="font-size:14px; padding:5px; border: 1px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
            <table style="width:100%; font-weight:bold;text-align:center;">
                <tr>
                    <td style="width: 10%; font-weight: bold">
                        {{ $paymentvoucher->payment_reason ? config('archive.payment_reason')[$paymentvoucher->payment_reason] : '' }}
                    <td style="width: 15%; font-weight: normal">Payment to</td>
                    <td style="width: 35%; border-bottom: 1px solid black; text-align:center;">
                        @if ($paymentvoucher->payment_to == 1)
                            @if ($paymentvoucher->paymentable->salutation)
                                {{ config('archive.salutation')[$paymentvoucher->paymentable->salutation] }}.
                            @endif
                            {{ $paymentvoucher->paymentable->name }}
                        @elseif ($paymentvoucher->payment_to == 2)
                            {{ $paymentvoucher->paymentable->name }}
                        @elseif ($paymentvoucher->payment_to == 3)
                            {{ $paymentvoucher->paymentable->company_name }}
                        @else
                            {{ $paymentvoucher->others_name }}
                        @endif
                    </td>
                    <td style="width: 10%;font-weight: normal;">of Rs.</td>
                    <td style="width: 15%; border-bottom: 1px solid black; text-align:center;">
                        {{ $paymentvoucher->paid_amount }}
                    </td>
                    <td style="width: 5%;font-weight: normal">By</td>
                    <td style="width: 10%; border-bottom: 1px solid black; text-align:center;">
                        {{ $paymentvoucher->modeofpayment ? config('archive.modeofpayment')[$paymentvoucher->modeofpayment] : '' }}
                    </td>
                </tr>
            </table>
            <table style="width:100%;font-weight:bold;">
                <tr>
                    <td style=" width:14%;padding-top:10px;font-weight: normal">(In Words)</td>
                    <td style="border-bottom: 1px solid black; text-align:center;">{{ $amount_in_words }}
                        Only</td>
                </tr>
            </table>
        </div>
        <div class="footer_container">
            <div style="text-align:start;">
                Receiver Name
            </div>
            <div style="text-align:end;">
                Receiver Signature
            </div>
        </div>
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
