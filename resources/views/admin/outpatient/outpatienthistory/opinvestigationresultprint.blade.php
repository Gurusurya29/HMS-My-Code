<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Investigation Result Print</title>

    <style>
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
            font-size: 22px;
        }

        table,
        th,
        td {
            border: 1px solid rgb(58, 57, 57);
            border-collapse: collapse;
            padding: 5px;
        }

        .patient_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 50% 50%;
            grid-gap: 10px;
            font-weight: bold;
        }

        .patientdetails_container {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 40% 60%;
            grid-gap: 10px;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div id="printdiv">
        @include('admin.commonheader.commonprintheader')
        <div class="border_bottom"></div>
        <div class="patient_details" style="font-weight: bold; font-size:16px;">
            <div class="patientdetails_container">
                <div> UHID </div>
                <div style="font-weight: normal;">
                    : {{ $outpatient->patient->uhid }}</div>
                <div> Patient Name </div>
                <div style="font-weight: normal;">
                    :
                    @if ($outpatient->patient->salutation)
                    {{ config('archive.salutation')[$outpatient->patient->salutation] }}.
                    @endif{{ $outpatient->patient->name }}
                </div>
                <div>Consultant Doctor </div>
                <div style="font-weight: normal;">
                    : {{ $outpatient->patientvisit->doctor->name }}
                </div>
            </div>
            <div class="patientdetails_container">
                <div> Age/Gender </div>
                <div style="font-weight: normal;">
                    : {{ $outpatient->patient->age ?? '-' }}
                    /{{ $outpatient->patient->gender ? config('archive.gender')[$outpatient->patient->gender] : '-' }}
                </div>
                <div> OP ID </div>
                <div style="font-weight: normal;">
                    : {{ $outpatient->uniqid }}</div>
                <div> DATE </div>
                <div style="font-weight: normal;">
                    : {{ $outpatient->created_at->format('d-m-Y h:i A') }}
                </div>
            </div>
        </div>
        <hr>
        @if ($labpatient && $labpatient->labpatientlist->count() > 0)
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">
            LABORATORY</div>
        @include('laboratory.laboratory.patientlist.labprinthelper')
        @endif

        @if ($scanpatient && $scanpatient->scanpatientlist->count() > 0)
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">SCAN
        </div>
        @include('laboratory.scan.patientlist.scanprinthelper')
        @endif


        @if ($xraypatient && $xraypatient->xraypatientlist->count() > 0)
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">X-RAY
        </div>
        @include('laboratory.xray.patientlist.xrayprinthelper')
        @endif


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