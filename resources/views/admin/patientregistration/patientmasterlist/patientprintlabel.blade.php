<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Label Print</title>

    <style>
        td {
            width: 50%;
        }

        table,
        th,
        td {
            padding: 5px;
            border-collapse: collapse;
            border: 2px solid rgb(58, 57, 57);
        }
    </style>
</head>

<body>

    <div id="printdiv">
        <div style="font-size:22px; padding:20px; margin-top:5px; width:60%; text-align:left;">
            <table style="width:100%; font-weight:bold;">
                <tr>
                    <td style="border: 2px solid rgb(58, 57, 57);">
                        NAME
                    </td>
                    <td style="width:50%;">
                        {{ $patient->name }}
                    </td>
                </tr>
                <tr>
                    <td style="border: 2px solid rgb(58, 57, 57);">
                        UHID
                    </td>
                    <td style="width:50%%;">
                        {{ $patient->uhid }}
                    </td>
                </tr>
                <tr>
                    <td style="border: 2px solid rgb(58, 57, 57);">
                        AGE
                    </td>
                    <td style="width:50%%;">
                        {{ $patient->age ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="border: 2px solid rgb(58, 57, 57);">SEXUALITY</td>
                    <td style="width:50%%;">
                        {{ $patient->gender ? config('archive.gender')[$patient->gender] : '-' }}</td>
                </tr>
                <tr>
                    <td style="border: 2px solid rgb(58, 57, 57);">MOBILE NO</td>
                    <td style="width:50%%;">
                        {{ $patient->phone }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: normal;color: #000; text-align:center;">
                        @php
                            $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                        @endphp
                        <p> {!! $generator->getBarcode($patient->uhid, $generator::TYPE_CODE_128, 2, 70) !!} </p>
                    </td>
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
