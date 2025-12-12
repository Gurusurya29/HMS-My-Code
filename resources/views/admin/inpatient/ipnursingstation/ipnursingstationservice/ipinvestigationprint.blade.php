<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Investigation Print</title>

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
            </div>
            <div class="patientdetails_container">
                <div> Age/Gender </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->patient->age ?? '-' }}
                    /{{ $ipassessment->patient->gender ? config('archive.gender')[$ipassessment->patient->gender] : '-'
                    }}

                </div>
                <div>ASSESSMENT ID </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->uniqid }}</div>
                <div> DATE </div>
                <div style="font-weight: normal;">
                    : {{ $ipassessment->created_at->format('d-m-Y h:i A') }}
                </div>
            </div>
        </div>
        <hr>
        @if ($labpatient && $labpatient->labpatientlist->count() > 0)
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">
            LABORATORY</div>
        <div style="margin-top:15px; font-size:14px;">
            <table
                style="border-collapse: collapse; border-spacing: 0;width: 100%;border: 1px solid black;text-align:center">
                <thead>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black;">
                            S.No
                        </th>
                        <th style="border:1px solid black;">
                            Investigation Group
                        </th>
                        <th style="border:1px solid black">
                            Investigation Name
                        </th>
                    </tr>
                </thead>
                <tbody class="text_align">
                    @foreach ($labpatient->labpatientlist->groupBy('labinvestigationgroup_name') as $key =>
                    $eachlabpatientlist)
                    <tr>
                        <td style="border:1px solid black; text-align:center;">
                            {{ $loop->index + 1 }}
                        </td>
                        <td style="border:1px solid black">
                            {{ $key }}
                        </td>
                        <td style="border:1px solid black">
                            @foreach ($eachlabpatientlist as $item)
                            <div style="margin: 4px 0">
                                {{ $item->labinvestigation_name }}
                            </div>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($scanpatient && $scanpatient->scanpatientlist->count() > 0)
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">SCAN
        </div>
        <div style="margin-top:15px; font-size:14px;">
            <table
                style="border-collapse: collapse; border-spacing: 0;width: 100%;border: 1px solid black;text-align:center">
                <thead>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black;">
                            S.No
                        </th>
                        <th style="border:1px solid black;">
                            Investigation Group
                        </th>
                        <th style="border:1px solid black">
                            Investigation Name
                        </th>
                    </tr>
                </thead>
                <tbody class="text_align">
                    @foreach ($scanpatient->scanpatientlist->groupBy('scaninvestigationgroup_name') as $key =>
                    $eachscanpatientlist)
                    <tr>
                        <td style="border:1px solid black; text-align:center;">
                            {{ $loop->index + 1 }}
                        </td>
                        <td style="border:1px solid black">
                            {{ $key }}
                        </td>
                        <td style="border:1px solid black">
                            @foreach ($eachscanpatientlist as $item)
                            <div style="margin: 4px 0">
                                {{ $item->scaninvestigation_name }}
                            </div>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif


        @if ($xraypatient && $xraypatient->xraypatientlist->count() > 0)
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">X-RAY
        </div>
        <div style="margin-top:15px; font-size:14px;">
            <table
                style="border-collapse: collapse; border-spacing: 0;width: 100%;border: 1px solid black;text-align:center">
                <thead>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black;">
                            S.No
                        </th>
                        <th style="border:1px solid black;">
                            Investigation Group
                        </th>
                        <th style="border:1px solid black">
                            Investigation Name
                        </th>
                    </tr>
                </thead>
                <tbody class="text_align">
                    @foreach ($xraypatient->xraypatientlist->groupBy('xrayinvestigationgroup_name') as $key =>
                    $eachxraypatientlist)
                    <tr>
                        <td style="border:1px solid black; text-align:center;">
                            {{ $loop->index + 1 }}
                        </td>
                        <td style="border:1px solid black">
                            {{ $key }}
                        </td>
                        <td style="border:1px solid black">
                            @foreach ($eachxraypatientlist as $item)
                            <div style="margin: 4px 0">
                                {{ $item->xrayinvestigation_name }}
                            </div>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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