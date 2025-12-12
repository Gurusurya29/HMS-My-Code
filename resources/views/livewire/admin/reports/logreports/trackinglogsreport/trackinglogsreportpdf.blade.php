<div>
    <div style="text-align:center;">
        <h3>Tracking Logs Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">S.NO</th>
                <th style="border: 1px solid;">CREATED AT</th>
                <th style="border: 1px solid;">UNIQID</th>
                <th style="border: 1px solid;">NAME</th>
                <th style="border: 1px solid;">DETAILS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trackinglogs as $key => $item)
                <tr style="text-align: center;">
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                    <td style="border: 1px solid;">
                        {{ $item->trackable->uniqid }}
                    </td>
                    <td style="border: 1px solid;">
                        {{ $item->trackable->name }}
                        ({{ ucwords(strtolower($item->trackable->usertype)) }})
                    </td>
                    <td style="border: 1px solid;"> {{ $item->trackmsg }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
