<div style="margin-top:15px; font-size:14px;">
    <table style="border-collapse: collapse;
border-spacing: 0;
width: 100%;
border: 1px solid black;">
        <thead>
            <tr style="border:1px solid black; text-align: center;">
                {{-- <th style="width:10%;border:1px solid black;">
                    S.No
                </th> --}}
                <th style="border:1px solid black">
                    Result
                </th>
            </tr>
        </thead>
        <tbody class="text_align">
            @foreach ($scanpatient->scanpatientlist->where('is_resultupdated', true) as $key => $eachscanpatientlist)
                <tr>
                    {{-- <td style="border:1px solid black; text-align: center;">
                        {{ $loop->index + 1 }}
                    </td> --}}
                    <td style="border:1px solid black;">
                        <div style="text-align: center;font-weight: bold;font-size:16px;">
                            {{ $eachscanpatientlist->scaninvestigation_name }}</div>
                        <div style="font-size:14px;">{!! $eachscanpatientlist->result_note !!}</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
