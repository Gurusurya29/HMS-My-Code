<table style=" width: 100%;table-layout: fixed;  overflow-wrap: break-word;border-bottom:2px solid black;">
    <tbody>
        <tr>
            <td colspan="2" rowspan="3" style="width:60%">
                <div style="font-weight:600;font-size:18px;">EESWARI NURSING HOME</div>
                <div style="font-weight:normal;font-size:12px;">B 34, 11th Cross, Thillai Nagar, Trichy- 18.
                </div>
                <div>DL NO: TRT/3371/20.21.</div>
                <div style="margin-top:5%">
                    <div>Phone: 043 - 2742939, 2740531.</div>
                </div>
            </td>
            <td style="height:10px;width:25%;font-size:14px">
                <div>Invoice No </div>
                <div style="margin-top:3px;">{{ $salesentry->uniqid }}</div>
            </td>
            <td style="width:15%;font-size:14px">
                <div>Dated </div>
                <div style="margin-top:3px;">{{ $salesentry->created_at->format('d/m/Y') }}</div>
            </td>
        </tr>
        <tr style="border-top:2px solid black">
            <td rowspan="2">
            </td>
            <td rowspan="2">
            </td>
        </tr>
    </tbody>
</table>