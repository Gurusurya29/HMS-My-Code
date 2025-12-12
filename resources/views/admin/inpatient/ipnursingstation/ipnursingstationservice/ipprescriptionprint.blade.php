<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prescription Print</title>

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
            padding: 10px;
            font-size: 22px;
        }

        table,
        th,
        td {
            border: 2px solid rgb(58, 57, 57);
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
                    : {{ $ipassessment->patient->uhid }}</div>
                <div> Patient Name </div>
                <div style="font-weight: normal;">
                    :
                    @if ($ipassessment->patient->salutation)
                    {{ config('archive.salutation')[$ipassessment->patient->salutation] }}.
                    @endif{{ $ipassessment->patient->name }}
                </div>
                <div> Address </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->patient->door_no ? $ipassessment->patient->door_no . ',' : '' }}
                    {{ $ipassessment->patient->area ? $ipassessment->patient->area . ',' : '' }}
                    {{ $ipassessment->patient->city ? $ipassessment->patient->city . ',' : '' }}
                    {{ $ipassessment->patient->pincode ? $ipassessment->patient->pincode . ',' : '' }}
                    {{ $ipassessment->patient->state_id ? $ipassessment->patient->state->name . ',' : '' }}
                    {{ $ipassessment->patient->country_id ? $ipassessment->patient->country->name . '.' : '' }}
                </div>
                <div>Consultant Doctor </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->patientvisit->doctor->name }}
                </div>
            </div>
            <div class="patientdetails_container">
                <div> Age/Gender </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->patient->age ?? '-' }}
                    /{{ $ipassessment->patient->gender ? config('archive.gender')[$ipassessment->patient->gender] : '-'
                    }}
                </div>
                <div> IP ID </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->uniqid }}</div>
                <div> DATE </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->created_at->format('d-m-Y h:i A') }}
                </div>
            </div>
        </div>
        <div class="border_bottom"></div>
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">R<sub
                style="font-size:20px;">x</sub>
            ADVICE:</div>
        <div style="font-size:16px;margin-top:5px;">
            <table style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word;">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;font-size:10px;">S.NO</th>
                        <th style="width: 20%; text-align: center;font-size:10px;">DRUG</th>
                        <th style="width: 20%; text-align: center;font-size:10px;">PREPARATION</th>
                        <th colspan="4" style="width: 40%; text-align: center;font-size:10px;">FREQUENCY</th>
                        <th style="width: 10%; text-align: center;font-size:10px;">COUNT</th>
                        <th style="width: 15%; text-align: center;font-size:10px;">DIRECTION</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3"></td>
                        <td style="border-right:1px solid black;font-size:9px;">
                            Morning
                        </td>
                        <td style="border-right:1px solid black;font-size:9px;">
                            Afternoon
                        </td>
                        <td style="border-right:1px solid black;font-size:9px;">
                            Evening
                        </td>
                        <td style="border-right:1px solid black;font-size:9px;">
                            Night
                        </td>
                        <td colspan="2">

                        </td>
                    </tr>
                    @foreach ($ipassessment->subprescriptionable->prescriptionlist as $key => $eachprescription)
                    <tr>
                        <td style="font-size:12px;">{{ $key + 1 }}</td>
                        <td style="font-size:12px;">{{ $eachprescription->drug_name }}</td>
                        </td>
                        <td style="font-size:12px;">
                            {{ $eachprescription->pharmacyproduct->pharmacycategoryname->name }}</td>
                        <td style="font-size:12px;">{{ $eachprescription->morning ? '1' : '' }}</td>
                        <td style="font-size:12px;">{{ $eachprescription->afternoon ? '1' : '' }}</td>
                        <td style="font-size:12px;">{{ $eachprescription->evening ? '1' : '' }}</td>
                        <td style="font-size:12px;">{{ $eachprescription->night ? '1' : '' }}</td>
                        <td style="font-size:12px;">{{ $eachprescription->count }}</td>
                        <td style="font-size:12px;">
                            @if ($eachprescription->before_food)
                            Before Food
                            @elseif ($eachprescription->after_food)
                            After Food
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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