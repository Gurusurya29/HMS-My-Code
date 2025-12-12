<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>X-ray Report</title>
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
    @if ($xraypatient->xraypatientlist->where('is_resultupdated', true)->isNotEmpty())
        <div id="printdiv" style="position: relative;">
            <div>
                @include('admin.commonheader.commonprintheader')

                <div class="border_bottom"></div>
                <div style="text-align: center; font-weight: bold;font-size:18px;margin-top:5px;">X-Ray Report
                </div>
                <div>
                    <div style="border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
                        <div class="patient_details" style="font-weight: bold; font-size:14px;">
                            <div class="patientdetails_container">
                                <div>X-ray Id </div>
                                <div style="font-weight: normal">
                                    : {{ $xraypatient->uniqid }}</div>

                                <div>Patient Name </div>
                                <div style="font-weight: normal">
                                    : @if ($xraypatient->patient->salutation)
                                        {{ config('archive.salutation')[$xraypatient->patient->salutation] }}.
                                    @endif{{ $xraypatient->patient->name }}</div>

                                <div> UHID </div>
                                <div style="font-weight: normal">
                                    : {{ $xraypatient->patient->uhid }}</div>
                                <div> Doctor </div>
                                <div style="font-weight: normal">
                                    : {{ $xraypatient->doctor->name }}</div>
                            </div>
                            <div class="patientdetails_container">
                                <div>Lab Date</div>
                                <div style="font-weight: normal;">:
                                    {{ $xraypatient->created_at->format('d-m-Y h:i A') }}</div>

                                <div> Type</div>
                                <div style="font-weight: normal">
                                    : {{ $xraypatient->subtype }}</div>

                                <div> Age/Gender </div>
                                <div style="font-weight: normal">
                                    :
                                    {{ $xraypatient->patient->age ?? '-' }}/{{ $xraypatient->patient->gender ? config('archive.gender')[$xraypatient->patient->gender] : '-' }}
                                </div>

                            </div>
                        </div>
                    </div>
                    @include('laboratory.xray.patientlist.xrayprinthelper')
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
