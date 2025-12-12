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

        .header_container {
            display: grid;
            grid-template-columns: 30% 70%;
            align-items: center;

            padding: 10px;
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
            grid-gap: 10px;
            padding: 10px;
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
            margin: 80px 5px 5px 5px;
            font-size: 25px;
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
        <div class="header_container">
            <div style="text-align:center;">
                @if (App::make('generalsetting')->logo)
                    <img style="width:30%;" alt="logo"
                        src="{{ url('storage/' . App::make('generalsetting')->logo) }}">
                @endif
            </div>
            <div style="text-align:center;">
                <h1 style="font-weight: bold;">{{ App::make('generalsetting')->companyfullname }}</h1>
                <span style="font-weight: 600;">
                    {{-- GSTIN. {{ App::make('generalsetting')->gstno }}
                    <br> --}}
                    {{ App::make('generalsetting')->address }}
                </span>
                <div>
                    {{ App::make('generalsetting')->phone }}, {{ App::make('generalsetting')->websitename }}
                </div>
            </div>
            {{-- <div style="justify-self: center;">
                <table style="font-size: 22px; ">
                    <tr>
                        <td style="font-weight:600;width:10%;">Phone</td>
                        <td>: {{ App::make('generalsetting')->phone }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600">Alt.Phone</td>
                        <td>: {{ App::make('generalsetting')->alternate_phone }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Website</td>
                        <td>: {{ App::make('generalsetting')->websitename }}</td>
                    </tr>
                </table>
            </div> --}}
        </div>
        <div class="border_bottom"></div>
        <div style="text-align: center; font-weight: bold;font-size:25px;">EXPENSE RECEIPT</div>
        <div style="border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
            <div class="patient_details" style="font-weight: bold; font-size:16px;">
                <div>
                    <p> Receipt No : <span style="font-weight: normal"> {{ $expenseentry->uniqid }}</span></p>
                    <p> Party Name : <span style="font-weight: normal"> {{ $expenseentry->party_name }}</span></p>
                    <p> Direct / Indirect : <span style="font-weight: normal">
                            {{ config('pharmacyarchive.expense_type')[$expenseentry->expense_type] }}</span>
                    </p>
                </div>
                <div>
                    <p>Receipt Date:<span
                            style="font-weight: normal;">{{ $expenseentry->created_at->format('d-m-Y h:i A') }}</span>
                    </p>
                    <p> Payment Towards : <span style="font-weight: normal">
                            {{ config('pharmacyarchive.payment_towards')[$expenseentry->payment_towards] }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div
            style="font-size:22px; padding:20px; border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
            <table style="width:100%; font-weight:bold;">
                <tr>
                    <td style="width: 20%; font-weight: normal">Payment To</td>
                    <td style=" border-bottom: 1px solid black; text-align:center;">
                        {{ $expenseentry->party_name }}
                    </td>
                    <td style="width: 8%;font-weight: normal">of Rs.</td>
                    <td style="width: 15%; border-bottom: 1px solid black; text-align:center;">
                        {{ $expenseentry->expense_value }}
                    </td>
                    <td style="width: 5%;font-weight: normal">By</td>
                    <td style="width: 10%; border-bottom: 1px solid black; text-align:center;">
                        {{ config('pharmacyarchive.payment_mode')[$expenseentry->payment_mode] }}</td>
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
