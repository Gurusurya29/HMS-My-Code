<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discharge summary Print</title>

    <style>
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

        .row {
            border: none;
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

        .data {
            border: none;
        }

        .label {
            width: 30%;
            font-weight: bold;
            font-size: 16px;
        }

        table,
        th,
        td {
            border: 1px solid rgb(101, 101, 101);
            border-collapse: collapse;
            padding: 5px;
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

        /* @media print {
            @page {
                size: A4;
                margin-top: 20%;
            }
        } */
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
                    : {{ $inpatient->patient->uhid }}</div>
                <div> Patient Name </div>
                <div style="font-weight: normal;">
                    :
                    @if ($inpatient->patient->salutation)
                        {{ config('archive.salutation')[$inpatient->patient->salutation] }}.
                    @endif{{ $inpatient->patient->name }}
                </div>
                <div> Address </div>
                <div style="font-weight: normal;">
                    : {{ $inpatient->patient->door_no ? $inpatient->patient->door_no . ',' : '' }}
                    {{ $inpatient->patient->area ? $inpatient->patient->area . ',' : '' }}
                    {{ $inpatient->patient->city ? $inpatient->patient->city . ',' : '' }}
                    {{ $inpatient->patient->pincode ? $inpatient->patient->pincode . ',' : '' }}
                    {{ $inpatient->patient->state_id ? $inpatient->patient->state->name . ',' : '' }}
                    {{ $inpatient->patient->country_id ? $inpatient->patient->country->name . '.' : '' }}
                </div>
                <div>Consultant Doctor </div>
                <div style="font-weight: normal;">
                    : {{ $inpatient->patientvisit->doctor->name }}
                </div>
                <div> WARD </div>
                <div style="font-weight: normal;">
                    : {{ $inpatient->ipadmission->wardtype->name }} -
                    {{ $inpatient->ipadmission->bedorroomnumber->name }}
                </div>
            </div>
            <div class="patientdetails_container">
                <div> Age/Gender </div>
                <div style="font-weight: normal;">
                    : {{ $inpatient->patient->age ?? '-' }}
                    / {{ $inpatient->patient->gender ? config('archive.gender')[$inpatient->patient->gender] : '-' }}
                </div>
                <div> IP ID </div>
                <div style="font-weight: normal;">
                    : {{ $inpatient->uniqid }}</div>
                <div> D.O.A </div>
                <div style="font-weight: normal;">
                    : {{ $inpatient->ipadmission->created_at->format('d-m-Y h:i A') }}
                </div>
                <div> D.O.S </div>
                <div style="font-weight: normal;">
                    :
                    @if ($inpatient->otsurgerypreop->isNotEmpty())
                        @foreach ($inpatient->otsurgerypreop as $key => $eachdate)
                            @if ($key == 0)
                                {{ Carbon\Carbon::parse($eachdate->patientsent_date)->format('d-m-Y') }}
                                {{ Carbon\Carbon::parse($eachdate->patientsent_time)->format('h:i:s A') }}
                            @else
                                ,
                                {{ Carbon\Carbon::parse($eachdate->patientsent_date)->format('d-m-Y') }}
                                {{ Carbon\Carbon::parse($eachdate->patientsent_time)->format('h:i:s A') }}
                            @endif
                        @endforeach
                    @endif
                </div>
                <div> D.O.D </div>
                <div style="font-weight: normal;">
                    :
                    {{ $inpatient->dsspecialable->discharge_date ? date('d-m-Y', strtotime($inpatient->dsspecialable->discharge_date)) : '-' }}
                </div>
            </div>
        </div>
        <hr>
        <div style="text-align: center; font-weight: bold;font-size:25px;">DISCHARGE SUMMARY</div>
        <p style="font-weight: bold; font-size:16px;"> DISCHARGE APPROVED BY : <span
                style="font-weight: normal; margin-left:5px;">
                {{ $inpatient->dsspecialable->doctor->name }}</span></p>
        <p style="font-weight: bold; font-size:16px;"> DISCHARGE INITIATE NOTE : <span
                style="font-weight: normal; margin-left:5px;">
                {{ $inpatient->dsspecialable->dischargeinitiate_note }}
            </span>
        </p>
        @if ($inpatient->dsspecialable->principaldiagnosis)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PRINCIPAL DIAGNOSIS:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->principaldiagnosis !!}</p>
        @endif
        <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>TREATMENT</u></div>
        @if ($inpatient->dsspecialable->riskfactor)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">RISK FACTOR:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->riskfactor !!}</p>
        @endif
        @if ($inpatient->dsspecialable->cheifcomplaint)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">CHIEF COMPLAINT:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->cheifcomplaint !!}</p>
        @endif
        @if ($inpatient->dsspecialable->historyofpresentillness)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">HISTORY OF PRESENT ILLNESS:
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->historyofpresentillness !!}</p>
        @endif
        @if ($inpatient->dsspecialable->historyofpastillness)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">HISTORY OF PAST ILLNESS:
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->historyofpastillness !!}</p>
        @endif
        @if ($inpatient->dsspecialable->others)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">OTHERS:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->others !!}</p>
        @endif
        @if ($inpatient->dsspecialable->physicalexamination)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PHYSICAL EXAMINATION:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->physicalexamination !!}</p>
        @endif
        @if ($inpatient->dsspecialable->hospitalizationcourse)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">HOSPITALIZATION COURSE:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->hospitalizationcourse !!}</p>
        @endif
        @if ($inpatient->dsspecialable->operativesummary)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">OPERATIVE SUMMARY:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->operativesummary !!}</p>
        @endif
        @if ($inpatient->dsspecialable->conditionatdischarge)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">CONDITION AT DISCHARGE:</div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->conditionatdischarge !!}</p>
        @endif
        @if ($inpatient->dsspecialable?->subprescriptionable?->prescriptionlist->isNotEmpty())
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
                        @foreach ($inpatient->dsspecialable?->subprescriptionable?->prescriptionlist as $key => $eachprescription)
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
                <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">NOTES:</div>
                <p style="margin-left: 7%">{{ $inpatient->dsspecialable->prescription_note }}</p>
            </div>
        @endif
        @if ($inpatient->dsspecialable->specialinstruction)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">SPECIAL INSTRUCTION TO
                PATIENT:
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->specialinstruction !!}</p>
        @endif
        @if ($inpatient->dsspecialable->discharge_date)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">DISCHARGE DATE:
            </div>
            <p style="margin-left: 7%">
                {{ $inpatient->dsspecialable->discharge_date ? date('d-m-Y', strtotime($inpatient->dsspecialable->discharge_date)) : '-' }}
            </p>
        @endif
        @if ($inpatient->dsspecialable->followupvisit)
            @php
                $followupvisit;
                $arr = [];
                foreach (json_decode($inpatient->dsspecialable->followupvisit) as $key => $value) {
                    array_push($arr, [
                        'scheduledate' => $value->scheduledate ? date('d-m-Y', strtotime(date('d-m-Y', strtotime($value->scheduledate)))) : '',
                        'department' => $value->department,
                        'additionalnote' => $value->additionalnote,
                    ]);
                }
                $followupvisit = $arr;
            @endphp
            @if ($followupvisit[0]['scheduledate'] != '')
                <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">FOLLOW UP VISITS</div>
                <table style="width:100%; margin-top:3%;margin-bottom:3%;text-align:center" class="data">
                    <thead>
                        <th>
                            SCHEDULE DATE
                        </th>
                        <th>
                            DEPARTMENT
                        </th>
                        <th>
                            ADDITIONAL NOTE
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($followupvisit as $eachfollowupvisit)
                            <tr>
                                <td style="width:20%;">{{ $eachfollowupvisit['scheduledate'] }}</td>
                                <td style="width:20%;">
                                    {{ $eachfollowupvisit['department'] }}</td>
                                <td style="width:60%;">{{ $eachfollowupvisit['additionalnote'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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
