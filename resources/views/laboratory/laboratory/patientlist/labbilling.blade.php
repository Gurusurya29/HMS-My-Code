<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LABORATROY BILL</title>
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
    @if ($labpatient?->labpatientlist->isNotEmpty())
        @if ($labpatient->labpatientlist->whereNotNull('is_movedtobill')->groupBy('labinvestigationgroup_name')->isNotEmpty())

            <div id="printdiv" style="overflow-x:auto;">
                <div>
                    @include('admin.commonheader.commonprintheader')

                    <div class="border_bottom"></div>
                    <div style="text-align: center; font-weight: bold;font-size:18px;margin-top:5px;">LABORATORY DETAILED
                        BILL</div>
                    <div>
                        <div style="border: 2px solid rgb(58, 57, 57); border-radius: 10px; margin-top:5px;">
                            <div class="patient_details" style="font-weight: bold; font-size:14px;">
                                <div class="patientdetails_container">
                                    <div>Bill No </div>
                                    <div style="font-weight: normal">
                                        : {{ $labpatient->uniqid }}</div>

                                    <div>Patient Name </div>
                                    <div style="font-weight: normal">
                                        : @if ($labpatient->patient->salutation)
                                            {{ config('archive.salutation')[$labpatient->patient->salutation] }}.
                                        @endif{{ $labpatient->patient->name }}</div>

                                    <div> UHID </div>
                                    <div style="font-weight: normal">
                                        : {{ $labpatient->patient->uhid }}</div>

                                    <div> Doctor </div>
                                    <div style="font-weight: normal">
                                        : {{ $labpatient->doctor->name }}</div>
                                </div>
                                <div class="patientdetails_container">
                                    <div>Bill Date</div>
                                    <div style="font-weight: normal;">:
                                        {{ $labpatient->created_at->format('d-m-Y h:i A') }}</div>

                                    <div> Phone</div>
                                    <div style="font-weight: normal">
                                        : {{ $labpatient->patient->phone }}</div>

                                    <div> Age/Gender </div>
                                    <div style="font-weight: normal">
                                        :
                                        {{ $labpatient->patient->age ?? '-' }}/{{ $labpatient->patient->gender ? config('archive.gender')[$labpatient->patient->gender] : '-' }}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="margin-top:15px; font-size:14px;">
                            <table
                                style="border-collapse: collapse; border-spacing: 0;width: 100%;border: 1px solid black;text-align:center;">
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
                                        <th style="border:1px solid black">
                                            Fee
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text_align">

                                    @foreach ($labpatient->labpatientlist->whereNotNull('is_movedtobill')->groupBy('labinvestigationgroup_name') as $key => $eachlabpatientlist)
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
                                            <td style="border:1px solid black;">
                                                @foreach ($eachlabpatientlist as $item)
                                                    <div style="margin: 4px 0">
                                                        {{ $item->fee }}
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="3"
                                            style="text-align: right;border:1px solid black;font-weight:bold;">
                                            <div>Total</div>
                                            <div>Discount(%)</div>
                                            <div>Grand Total</div>
                                        </td>
                                        <td style="border:1px solid black;">
                                            <div>
                                                {{ $labpatient->labpatientlist->where('is_movedtobill', true)->sum('fee') }}
                                            </div>
                                            <div>
                                                {{ $labpatient->discount_value }}({{ $labpatient->discount_percentage }}%)
                                            </div>
                                            <div>{{ $labpatient->grand_total }}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
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
