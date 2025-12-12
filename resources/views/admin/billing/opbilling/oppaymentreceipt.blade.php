<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt Print</title>

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

        .header_details {
            display: grid;
            justify-content: space-around;
            grid-template-columns: auto auto;
            padding: 10px;
            font-size: 22px;
        }

        .patient_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            padding-left: 5px;
            font-weight: bold;
        }

        .paymentdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            grid-gap: 10px;
            padding: 25px;
            font-size: 22px;
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

        .payment_details {
            font-weight: normal;
            border-bottom: 3px dashed rgb(46, 45, 45);
        }

        .container_two {
            display: grid;
            justify-content: space-between;
            grid-template-columns: auto auto;
            grid-gap: 10px;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;

        }
    </style>
</head>

<body>

    <div id="printdiv">
        @include('admin.commonheader.commonprintheader')
        <div class="border_bottom"></div>
        <div style="text-align: center; font-weight: bold;font-size:14px;">PAYMENT RECEIPT</div>
        <div style="border: 2px solid rgb(58, 57, 57); border-radius: 10px;">
            <div class="patient_details" style="font-weight: bold; font-size:14px;">
                <div>
                    <p> Receipt No : <span style="font-weight: normal"> {{ $receipt->hms_uniqid }}</span></p>
                    <p> UHID : <span style="font-weight: normal"> {{ $receipt->patient->uhid }}</span></p>
                    <p> Patient Name : <span style="font-weight: normal">
                            @if ($receipt->patient->salutation)
                            {{ config('archive.salutation')[$receipt->patient->salutation] }}.
                            @endif{{ $receipt->patient->name }}
                        </span>
                    </p>
                </div>
                <div>
                    <p>Receipt Date : <span style="font-weight: normal;">{{ $receipt->created_at->format('d-m-Y h:i A')
                            }}</span>
                    </p>
                    <p> Age/Gender : <span style="font-weight: normal">
                            {{ $receipt->patient->age ?? '-' }}/{{ $receipt->patient->gender ?
                            config('archive.gender')[$receipt->patient->gender] : '-' }}</span>
                    </p>
                    <p> Payment Type : <span style="font-weight: normal">
                            {{ config('archive.payment_type')[$receipt->payment_type] }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div
            style="font-size:14px; padding:5px; border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
            <table style="width:100%; font-weight:bold;">
                <tr>
                    <td style="width: 20%; font-weight: normal">Received From</td>
                    <td style="width: 35%; border-bottom: 1px solid black; text-align:center;">
                        @if ($receipt->patient->salutation)
                        {{ config('archive.salutation')[$receipt->patient->salutation] }}.
                        @endif{{ $receipt->patient->name }}
                    </td>
                    <td style="width: 8%;font-weight: normal">of Rs.</td>
                    <td style="width: 15%; border-bottom: 1px solid black; text-align:center;">
                        {{ $receipt->received_amount }}
                    </td>
                    <td style="width: 5%;font-weight: normal">By</td>
                    <td style="width: 10%; border-bottom: 1px solid black; text-align:center;">
                        {{ config('archive.modeofpayment')[$receipt->modeofpayment] }}</td>
                </tr>
            </table>
            <table style="width:100%;font-weight:bold;">
                <tr>
                    <td style=" width:14%;padding-top:10px;font-weight: normal">(In Words)</td>
                    <td style="border-bottom: 1px solid black; text-align:center;">{{ $amount_in_words }}
                        Only</td>
                </tr>
            </table>
            {{-- <table style="font-weight:bold;">
                <tr>
                    <td style="width:5%;padding-top:10px;font-weight: normal">as</td>
                    <td style="width:15%;border-bottom: 1px solid black; text-align:center;">
                        {{ config('archive.payment_type')[$receipt->payment_type] }}
                    </td>
                    <td colspan="2"></td>
                </tr>
            </table> --}}
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