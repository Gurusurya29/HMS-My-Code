<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Token Print</title>

    <style>
        table,
        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body>

    <div id="printdiv">
        <div style="font-size:22px; padding:20px; margin-top:5px; width:60%; text-align:left;">
            <table style="width:100%; font-weight:bold;">
                <tr>
                    <td style="width:10%;">
                        DATE
                    </td>
                    <td style="width:25%;">
                        {{ $patientvisit->created_at->format('d-m-Y h:i A') }}
                    </td>
                </tr>
                <tr>
                    <td style="width:10%;">
                        TOKEN
                    </td>
                    <td style="width:25%;">
                        {{ $patientvisit->token_id }}
                    </td>
                </tr>
                <tr>
                    <td style="width:10%;">
                        NAME
                    </td>
                    <td style="width:25%;">
                        {{ $patientvisit->patient->name }}
                    </td>
                </tr>
                <tr>
                    <td style="width:10%;">
                        UHID
                    </td>
                    <td style="width:25%;">
                        {{ $patientvisit->patient->uhid }}
                    </td>
                </tr>
                <tr>
                    <td style="width:10%;">
                        AGE
                    </td>
                    <td style="width: 10%;">
                        {{ $patientvisit->patient->age ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="width:10%;">SEXUALITY</td>
                    <td style="width: 10%;">
                        {{ $patientvisit->patient->gender ? config('archive.gender')[$patientvisit->patient->gender] : '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="width:10%;">MOBILE NO</td>
                    <td style="width: 20%;">
                        {{ $patientvisit->patient->phone }}</td>
                </tr>
            </table>
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
