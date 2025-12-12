<div style="margin-top:15px; font-size:14px;">
    <table
        style="border-collapse: collapse;
border-spacing: 0;
width: 100%;
border: 1px solid black; text-align: center;">
        <thead>
            <tr style="border:1px solid black">
                <th style="border:1px solid black;">
                    S.No
                </th>
                <th style="border:1px solid black;">
                    Lab Investigation
                </th>
                <th style="border:1px solid black;">
                    Test Method
                </th>
                <th style="border:1px solid black">
                    Result
                </th>
                <th style="border:1px solid black">
                    Units
                </th>
                <th style="border:1px solid black">
                    Reference Range
                </th>
            </tr>
        </thead>
        <tbody class="text_align">
            @foreach ($labpatient->labpatientlist->where('is_resultupdated', true) as $key => $eachlabpatientlist)
                <tr>
                    <td style="border:1px solid black;">
                        {{ $loop->index + 1 }}
                    </td>
                    <td style="border:1px solid black">
                        {{ $eachlabpatientlist->labinvestigation_name }}
                    </td>
                    <td style="border:1px solid black;">
                        {{ $eachlabpatientlist->testmethod }}
                    </td>
                    <td style="border:1px solid black;">
                        {{ $eachlabpatientlist->result_note }}
                    </td>
                    <td style="border:1px solid black;">
                        {{ $eachlabpatientlist->units }}
                    </td>
                    <td style="border:1px solid black;">
                        {{ $eachlabpatientlist->range }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
