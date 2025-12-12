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


        /* body {
            border: #81D4FA 2px solid;
            background-color: #03a9f400;
            text-align: left;
            padding-left: 20px;
            padding-right: 15px;
            height: auto;
            width: auto;
        } */
    </style>
</head>

<body>
    <div id="printdiv">
        @include('admin.commonheader.commonprintheader')
        <hr>
        <div style="text-align: center; font-weight: bold;font-size:25px;">DISCHARGE SUMMARY</div>
        <div class="border_bottom"></div>
        <div style="text-align:left; font-weight: bold;font-size:20px;">PATIENT INFORMATION</div>
        <div class="border_bottom"></div>
        <div class="patient_details" style="font-weight: bold; font-size:16px;">
            <div class="patientdetails_container">
                <div> UHID No</div>
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
                <div> Ward </div>
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
                <div> I.P No </div>
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
        <div class="border_bottom"></div>
        <p style="font-weight: bold; font-size:16px;"> DISCHARGE APPROVED BY : <span
                style="font-weight: normal; margin-left:5px;">
                {{ $inpatient->dsspecialable->doctor->name }}</span></p>
        <p style="font-weight: bold; font-size:16px;"> DISCHARGE INITIATE NOTE : <span
                style="font-weight: normal; margin-left:5px;">
                {{ $inpatient->dsspecialable->dischargeinitiate_note }}
            </span>
        </p>
        @if ($inpatient->dsspecialable->primary_consultants)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>PRIMARY CONSULTANTS</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->primary_consultants !!}</p>
        @endif
        @if ($inpatient->dsspecialable->consultant)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>CONSULTANTS</u></div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->consultant !!}</p>
        @endif
        @if ($inpatient->dsspecialable->diagnosis)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>DIAGNOSIS</u></div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->diagnosis !!}</p>
        @endif
        <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>TREATMENT</u></div>
        @if ($inpatient->dsspecialable->drug_allergy)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>DRUG ALLERGY</u></div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->drug_allergy !!}</p>
        @endif
        @if ($inpatient->dsspecialable->procedures)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>PROCEDURES</u></div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->procedures !!}</p>
        @endif
        @if ($inpatient->dsspecialable->historyofpastillness)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>PAST HISTORY</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->historyofpastillness !!}</p>
        @endif
        @if ($inpatient->dsspecialable->generalexamination)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>GENERAL EXAMINATION</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->generalexamination !!}</p>
        @endif
        @if ($inpatient->dsspecialable->localexamination)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>LOCAL EXAMINATION</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->localexamination !!}</p>
        @endif
        @if ($inpatient->dsspecialable->investigations)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>INVESTIGATIONS</u></div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->investigations !!}</p>
        @endif
        @if ($inpatient->dsspecialable->courseduringstay)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>COURSE DURING STAY</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->courseduringstay !!}</p>
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
            <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">
                <u>ADVICE MEDICATION</u>
            </div>
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
                <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PRESCRIPTION NOTES:</div>
                <p style="margin-left: 7%">{{ $inpatient->dsspecialable->prescription_note }}</p>
            </div>
        @endif
        @if ($inpatient->dsspecialable->patientowndrug)
            @php
                $patientowndrug;
                $arr1 = [];
                foreach (json_decode($inpatient->dsspecialable->patientowndrug) as $key => $value) {
                    array_push($arr1, [
                        'drug_name' => $value->drug_name,
                        'duration' => $value->duration,
                        'morning' => $value->morning ? 1 : 0,
                        'afternoon' => $value->afternoon ? 1 : 0,
                        'evening' => $value->evening ? 1 : 0,
                        'night' => $value->night ? 1 : 0,
                        'before_food' => $value->before_food ? 1 : 0,
                        'after_food' => $value->after_food ? 1 : 0,
                    ]);
                }
                $patientowndrug = $arr1;
            @endphp
            @if ($patientowndrug[0]['drug_name'] != '')
                <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><U>PATIENT OWN DRUGS</U>
                </div>
                <table
                    style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word; margin-top:3%;"
                    class="data">
                    <thead>
                        <th style="width:30%;">DRUG NAME</th>
                        <th style="width:10%;">DURATION</th>
                        <th style="width:10%;">MORNING</th>
                        <th style="width:10%;">AFTERNOON</th>
                        <th style="width:10%;">EVENING</th>
                        <th style="width:10%;">NIGHT</th>
                        <th style="width:10%;">BF</th>
                        <th style="width:10%;">AF</th>
                    </thead>
                    <tbody>
                        @foreach ($patientowndrug as $eachpatientowndrug)
                            <tr>
                                <td>{{ $eachpatientowndrug['drug_name'] }}</td>
                                <td>
                                    {{ $eachpatientowndrug['duration'] }}</td>
                                <td>{{ $eachpatientowndrug['morning'] }}</td>
                                <td>
                                    {{ $eachpatientowndrug['afternoon'] }}</td>
                                <td>{{ $eachpatientowndrug['evening'] }}</td>
                                <td>{{ $eachpatientowndrug['night'] }}</td>
                                <td>{{ $eachpatientowndrug['before_food'] }}</td>
                                <td>{{ $eachpatientowndrug['after_food'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
        @if ($inpatient->dsspecialable->physioadvice)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>PHYSIO ADVICE</u></div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->physioadvice !!}</p>
        @endif
        @if ($inpatient->dsspecialable->adviceondischarge)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>ADVICE ON DISCHARGE</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->adviceondischarge !!}</p>
        @endif
        @if ($inpatient->dsspecialable->others)
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>OTHERS</u>
            </div>
            <p style="margin-left: 7%">{!! $inpatient->dsspecialable->others !!}</p>
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
                <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%"><u>FOLLOW UP VISIT</u>
                </div>
                <table style="width:100%; margin-top:3%;margin-bottom:3%; text-align:center" class="data">
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
        <div>
            <table style="width:100%;table-layout: fixed;padding:5px;border:none;">
                <tbody>
                    <td style="width:50%;text-align:left;border:none;">
                        WRITTEN BY :<span style="font-weight:600;">
                            {{ $inpatient->dsspecialable->written_by }}</span>
                    </td>
                    <td style="width:50%;text-align:right;border:none;">
                        CHECKED BY : <span style="font-weight:600;">{{ $inpatient->dsspecialable->checked_by }}</span>
                    </td>
                </tbody>
            </table>
        </div>
        <div style="margin:0;padding:0;">
            <div>
                <p>
                    <span style="margin-top:5%;"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg></span> Please bring the discharge summary without fail on review or for any queries
                </p>
                <p>
                    <span style="margin-top:5%;"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg> </span> on
                </p>
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
