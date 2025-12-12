<div style="margin-top:15px; font-size:14px;">
    <table style="border-collapse: collapse;
border-spacing: 0;
width: 100%;
border: 1px solid black;">
        <thead>
            <tr style="border:1px solid black; text-align:center;">
                <th style="border:1px solid black;">
                    Lab Investigation
                </th>
                <th style="border:1px solid black;">
                    Test Method
                </th>
                <th style="border:1px solid black">
                    Result
                </th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($xraypatient->xraypatientlist->where('is_resultupdated', true) as $key => $eachxraypatientlist)
                <tr>
                    <td style="border:1px solid black; text-align:center;">
                        {{ $eachxraypatientlist->xrayinvestigation_name }}
                    </td>
                    <td style="border:1px solid black; text-align:center;">
                        {{ $eachxraypatientlist->testmethod }}
                    </td>
                    <td style="border:1px solid black;">
                        {!! $eachxraypatientlist->result_note !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
