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
            border: 2px solid rgb(58, 57, 57);
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

        .generalexam_details {
            display: grid;
            justify-content: space-between;
            grid-template-columns: 1fr 1fr 1fr;
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
        <div class="patient_details" style="font-weight: bold; font-size:16px; padding:10px;">
            <div>
                <p> UHID : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->patient->uhid }}</span></p>
                <p> Patient Name : <span style="font-weight: normal; margin-left:5px;">
                        @if ($outpatient->patient->salutation)
                            {{ config('archive.salutation')[$outpatient->patient->salutation] }}.
                        @endif{{ $outpatient->patient->name }}
                    </span>
                </p>
            </div>
            <div>
                <p> Age/Gender : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->patient->age ?? '-' }}
                        /{{ $outpatient->patient->gender ? config('archive.gender')[$outpatient->patient->gender] : '-' }}
                    </span>
                </p>
            </div>
        </div>
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
                <tr>
                    <td class="row label">LAB INVESTIGATION </td>
                    <td class="row "> :
                        {{ $outpatient->specialable->labinvestigation->pluck('name')->implode(' ,') }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row "> : {{ $outpatient->specialable->labinvestigation_note }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">SCAN INVESTIGATION </td>
                    <td class="row "> :
                        {{ $outpatient->specialable->scaninvestigation->pluck('name')->implode(' ,') }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row "> : {{ $outpatient->specialable->scaninvestigation_note }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">X-RAY INVESTIGATION </td>
                    <td class="row "> :
                        {{ $outpatient->specialable->xrayinvestigation->pluck('name')->implode(' ,') }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">NOTES</td>
                    <td class="row "> : {{ $outpatient->specialable->xrayinvestigation_note }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="prescription" style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">R<sub
                style="font-size:20px;">x</sub>
            ADVICE:</div>
        <div style="font-size:16px;margin-top:5px;">
            @if ($outpatient->prescriptionable)
                <table style="text-align:center; width: 100%;table-layout: fixed;  overflow-wrap: break-word;">
                    <thead>
                        <tr>
                            <th style="width: 30%; text-align: left">DRUG</th>
                            <th style="width: 10%; text-align: left">MORNING</th>
                            <th style="width: 10%; text-align: left">AFTERNOON</th>
                            <th style="width: 10%; text-align: left">EVENING</th>
                            <th style="width: 10%; text-align: left">NIGHT</th>
                            <th style="width: 10%; text-align: left">BF</th>
                            <th style="width: 10%; text-align: left">AF</th>
                            <th style="width: 10%; text-align: left">COUNT</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outpatient->prescriptionable->prescriptionlist as $eachprescription)
                            <tr>
                                <td>{{ $eachprescription->drug_name }}</td>
                                <td>{{ $eachprescription->morning }}</td>
                                <td>{{ $eachprescription->afternoon }}</td>
                                <td>{{ $eachprescription->evening ? '1' : '0' }}</td>
                                <td>{{ $eachprescription->night ? '1' : '0' }}</td>
                                <td>{{ $eachprescription->before_food ? '1' : '0' }}
                                </td>
                                <td>{{ $eachprescription->after_food ? '1' : '0' }}
                                </td>
                                <td>{{ $eachprescription->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PRESCRIPTION NOTES:</div>
            <p style="margin-left: 7%">{{ $outpatient->specialable->prescription_note }}</p>
        </div>
        <div style="text-align: center; font-weight: bold;font-size:20px; margin-top3%">GENERAL EXAMINATION</div>
        <div class="generalexam_details" style="font-weight: bold; font-size:16px; padding:10px;">
            <div>
                <p> PALLOR : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->specialable->is_pallor ? 'YES' : 'NO' }}</span></p>
            </div>
            <div>
                <p> CYANOSIS : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->specialable->is_cyanosis ? 'YES' : 'NO' }}</span>
                </p>
            </div>
            <div>
                <p> ICTERUS : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->specialable->is_icterus ? 'YES' : 'NO' }}</span>
                </p>
            </div>
            <div>
                <p> CLUBBING : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->specialable->is_clubbing ? 'YES' : 'NO' }}</span>
                </p>
            </div>
            <div>
                <p> PEDALEDEMA : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->specialable->is_pedaledema ? 'YES' : 'NO' }}</span>
                </p>
            </div>
            <div>
                <p> ANASARCA : <span style="font-weight: normal; margin-left:5px;">
                        {{ $outpatient->specialable->is_anasarca ? 'YES' : 'NO' }}</span>
                </p>
            </div>
        </div>
        <div style="text-align: center; font-weight: bold;font-size:20px; margin-top3%">FUNCTIONAL ASSESSMENT</div>
        <p style="font-weight: bold;font-size:16px;">ABILITY TO PERFORM ROUTINE ACTIVITIES
            <span
                style="margin-left:10px;font-weight: normal;">{{ ($outpatient->specialable->functional_assesment === 1
                        ? 'YES'
                        : $outpatient->specialable->functional_assesment === 0)
                    ? 'NO'
                    : '-' }}</span>
        </p>
        <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">ABDOMINAL EXAMINATION :</div>
        <p style="margin-left: 7%">{{ $outpatient->specialable->abdominalexamination_note }}</p>
        <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">NERVOUS SYSTEM EXAMINATION :
        </div>
        <p style="margin-left: 7%">{{ $outpatient->specialable->nervoussystemexamination_note }}</p>
        <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PER RECTAL EXAMINATION :</div>
        <p style="margin-left: 7%">{{ $outpatient->specialable->perrectalexamination_note }}</p>
        <div style="text-align: left; font-weight: bold;font-size:16px; margin-top:3%">PER VAGINAL EXAMINATION :</div>
        <p style="margin-left: 7%">{{ $outpatient->specialable->pervaginalexamination_note }}</p>
        <table style="width:100%; margin-top:3%;margin-bottom:3%;" class="data">
            <tbody>
                <tr>
                    <td class="row label">PAST HISTORY :</td>
                    <td class="row ">
                        {{ $outpatient->specialable->pasthistory_note }}</td>
                </tr>
                <tr>
                    <td class="row label">NUTRITIONAL SCREENING :</td>
                    <td class="row ">
                        {{ $outpatient->specialable->nutritionalscreening_note }}</td>
                </tr>
                <tr>
                    <td class="row label">PLAN OF CARE :</td>
                    <td class="row ">
                        {{ $outpatient->specialable->planofcare_note }}</td>
                </tr>
                <tr>
                    <td class="row label">DIET ADVICE</td>
                    <td class="row ">{{ $outpatient->specialable->dietadvice_note }}</td>
                </tr>
                <tr>
                    <td class="row label">NEXT VISIT :</td>
                    <td class="row ">
                        {{ $outpatient->specialable->nextvisit_date }}
                    </td>
                </tr>
                <tr>
                    <td class="row label">DOCTOR NOTE</td>
                    <td class="row ">
                        {{ $outpatient->specialable->doctor_note }}
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
