<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Report</title>
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

            padding: 10px;
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
    @if ($scanpatient->scanpatientlist->where('is_resultupdated', true)->isNotEmpty())
        <div id="printdiv" style="position: relative;">
            <div>
                @include('admin.commonheader.commonprintheader')

                <div class="border_bottom"></div>
                <div style="text-align: center; font-weight: bold;font-size:18px;margin-top:5px;">Scan Report
                </div>
                <div>
                    <div style="border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
                        <div class="patient_details" style="font-weight: bold; font-size:14px;">
                            <div class="patientdetails_container">
                                <div>Scan Id </div>
                                <div style="font-weight: normal">
                                    : {{ $scanpatient->uniqid }}</div>

                                <div>Patient Name </div>
                                <div style="font-weight: normal">
                                    : @if ($scanpatient->patient->salutation)
                                        {{ config('archive.salutation')[$scanpatient->patient->salutation] }}.
                                    @endif{{ $scanpatient->patient->name }}</div>

                                <div> UHID </div>
                                <div style="font-weight: normal">
                                    : {{ $scanpatient->patient->uhid }}</div>
                                <div> Doctor </div>
                                <div style="font-weight: normal">
                                    : {{ $scanpatient->doctor->name }}</div>
                            </div>
                            <div class="patientdetails_container">
                                <div>Scan Date</div>
                                <div style="font-weight: normal;">:
                                    {{ $scanpatient->created_at->format('d-m-Y h:i A') }}</div>

                                <div> Type</div>
                                <div style="font-weight: normal">
                                    : {{ $scanpatient->subtype }}</div>

                                <div> Age/Gender </div>
                                <div style="font-weight: normal">
                                    :
                                    {{ $scanpatient->patient->age ?? '-' }}/{{ $scanpatient->patient->gender ? config('archive.gender')[$scanpatient->patient->gender] : '-' }}
                                </div>

                            </div>
                        </div>
                    </div>
                    @include('laboratory.scan.patientlist.scanprinthelper')
                </div>
            </div>
            <div style="position: absolute ; bottom: -70px; right: 70px;font-size:20px;">
                Doctor signature
            </div>
        </div>
    @endif
    <script>
        function printreceipt() {
            window.print();
            window.onafterprint = window.close;
        }
        window.onload = printreceipt();
    </script>
</body>

</html>
