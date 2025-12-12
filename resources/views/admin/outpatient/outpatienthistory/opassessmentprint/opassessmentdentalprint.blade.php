<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Outpatient Assesment Print</title>

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

        .row {
            border: none;
        }

        .border_bottom {
            border-bottom: 1px solid rgb(75, 74, 74);
            margin: 5px 0;
        }

        .data {
            border: none;
        }

        .label {
            width: 35%;
            font-weight: bold;
            font-size: 16px;
        }

        table,
        th,
        td {
            border: 1px solid rgb(101, 101, 101);
            border-collapse: collapse;
            padding: 7px;
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
            grid-template-columns: 40% 60%;
            grid-gap: 10px;
            padding: 10px;
            font-weight: bold;
        }

        @media print {
            .assessment {
                page-break-before: always;
            }
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
                <div> Address </div>
                <div style="font-weight: normal;">
                    : {{ $outpatient->patient->door_no ? $outpatient->patient->door_no . ',' : '' }}
                    {{ $outpatient->patient->area ? $outpatient->patient->area . ',' : '' }}
                    {{ $outpatient->patient->city ? $outpatient->patient->city . ',' : '' }}
                    {{ $outpatient->patient->pincode ? $outpatient->patient->pincode . ',' : '' }}
                    {{ $outpatient->patient->state_id ? $outpatient->patient->state->name . ',' : '' }}
                    {{ $outpatient->patient->country_id ? $outpatient->patient->country->name . '.' : '' }}
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
        <div style="text-align: center; font-weight: bold;font-size:20px; margin-top:3%">PATIENT VISIT DETAILS</div>
        <table style="width:100%; margin-top:1%;margin-bottom:3%;" class="data">
            <tbody>
                <tr>
                    <td class="row label">CURRENT COMPLAINTS </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->currentcomplaints->pluck('name')->implode(' ,') }}</td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row ">: {{ $outpatient->specialable->currentcomplaint_note }}</td>
                </tr>
                <tr>
                    <td class="row label">ALLERGY </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->allergymaster->pluck('name')->implode(' ,') }}</td>
                </tr>
                <tr>
                    <td class="row label">TEMPERATURE </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->temperature }}</td>
                </tr>
                <tr>
                    <td class="row label">BLOOD PRESSURE </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->bloodpressure }}</td>
                </tr>
                <tr>
                    <td class="row label">HEIGHT </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->height }}</td>
                </tr>
                <tr>
                    <td class="row label">WEIGHT </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->weight }}</td>
                </tr>
                <tr>
                    <td class="row label">PULSE RATE </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->pulserate }}</td>
                </tr>
                <tr>
                    <td class="row label">SpO2 </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->spo_two }}</td>
                </tr>
                <tr>
                    <td class="row label">PAIN SCALE (1-10) </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->painscaleone
                            ? config('archive.pain_scale')[$outpatient->patientvisit->painscaleone]
                            : '' }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">CHARACTER</td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->character }}</td>
                </tr>
                <tr>
                    <td class="row label">ALCOHOL </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->alcohol ? ($outpatient->patientvisit->alcohol ? 'Yes' : 'No') : '' }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">SMOKING </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->smoking ? ($outpatient->patientvisit->smoking ? 'Yes' : 'No') : '' }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">TOBACCO </td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->tobacco ? ($outpatient->patientvisit->tobacco ? 'Yes' : 'No') : '' }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">OTHERS</td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->others }}</td>
                </tr>
                <tr>
                    <td class="row label">ADDITIONAL NOTE</td>
                    <td class="row ">:
                        {{ $outpatient->patientvisit->visit_note }}</td>
                </tr>
            </tbody>
        </table>
        <div class="assessment" style="text-align: center; font-weight: bold;font-size:20px;">OP ASSESSMENT DETAILS
        </div>
        <table style="width:100%; margin-top:1%;margin-bottom:3%;" class="data">
            <tbody>
                <tr>
                    <td class="row label">DOCTOR</td>
                    <td class="row "> : {{ $outpatient->doctor?->name }}</td>
                </tr>
                <tr>
                    <td class="row label">CURRENT COMPLAINTS</td>
                    <td class="row "> :
                        {{ $outpatient->specialable->currentcomplaints->pluck('name')->implode(' ,') }}</td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row "> : {{ $outpatient->specialable->currentcomplaint_note }}</td>
                </tr>
                <tr>
                    <td class="row label">PHYSICAL & GENERAL EXAM </td>
                    <td class="row "> :
                        {{ $outpatient->specialable->physicalexam->pluck('name')->implode(' ,') }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row "> : {{ $outpatient->specialable->physicalexam_note }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">DIAGNOSIS </td>
                    <td class="row "> :
                        {{ $outpatient->specialable->diagnosismaster->pluck('name')->implode(' ,') }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row "> : {{ $outpatient->specialable->diagnosis_note }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">R<sub
                style="font-size:20px;">x</sub>
            ADVICE:</div>
        <div style="font-size:16px;margin-top:5px;">
            @if ($outpatient->prescriptionable?->prescriptionlist->isNotEmpty())
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
                        @foreach ($outpatient->prescriptionable->prescriptionlist as $key => $eachprescription)
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
            @endif
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PRESCRIPTION NOTES:</div>
            <p style="margin-left: 7%">{{ $outpatient->specialable->prescription_note }}</p>
        </div>
        <table style="width:100%; margin-top:3%;margin-bottom:3%;" class="data">
            <tbody>
                <tr>
                    <td class="row label">DOCTOR NOTE</td>
                    <td class="row "> : {{ $outpatient->specialable->doctor_note }}
                    </td>
                </tr>
            </tbody>
        </table>
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
